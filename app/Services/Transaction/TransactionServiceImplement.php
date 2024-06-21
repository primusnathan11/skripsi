<?php

namespace App\Services\Transaction;

use App\Constants\PaymentStatus;
use App\Helpers\Converter;
use App\Repositories\Donation\DonationRepository;
use LaravelEasyRepository\Service;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Tree\TreeRepository;
use App\Repositories\UserCarbonOffset\UserCarbonOffsetRepository;
use App\Repositories\UserTree\UserTreeRepository;
use App\Vendor\Midtrans\Snap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Throwable;

class TransactionServiceImplement extends Service implements TransactionService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected
        $mainRepository,
        $treeRepository,
        $userTreeRepository,
        $userCarbonOffsetRepository,
        $donateRepository,
        $user,
        $midtrans;

    public $basicPrice = 200000,
        $basicOffset = 1000,
        $errorMessage = '',
        $data = [];

    public function __construct(
        TransactionRepository $mainRepository,
        TreeRepository $treeRepository,
        UserTreeRepository $userTreeRepository,
        UserCarbonOffsetRepository $userCarbonOffsetRepository,
        DonationRepository $donateRepository,
        Snap $midtrans
    ) {
        $this->mainRepository = $mainRepository;
        $this->treeRepository = $treeRepository;
        $this->userTreeRepository = $userTreeRepository;
        $this->userCarbonOffsetRepository = $userCarbonOffsetRepository;
        $this->donateRepository = $donateRepository;
        $this->midtrans = $midtrans;
        $this->user = auth('api')->user();
    }

    private function genrateOrderCode($type)
    {
        $user_id = auth('api')->user()->id;

        $code = "";

        switch ($type) {
            case 'adopt':
                $code .= "ADOPT";
                break;
            case 'planting':
                $code .= "PLANT";
                break;
            default:
                $code .= "ADOPT";
        }

        return $code .= "-" . date('YmdHis') . '-' . $user_id . '-' . rand(100000, 999999);
    }

    public function doAdopt(array $data): bool
    {
        $trID = Uuid::uuid4()->toString();
        $orderID = $this->genrateOrderCode('adopt');
        $now = date('Y-m-d');
        $getOffset = ($data['total'] / $this->basicPrice) * $this->basicOffset;
        $getAvailableTree = $this->treeRepository->getAvailableTreeFromOffset($getOffset);

        $this->data['transaction'] = [
            'id' => $trID,
            'order_code' => $orderID,
            'user_id' => $this->user->id,
            'date' => $now,
            'tree_type_id' => $data['product_id'],
            'total' => $data['total'],
            'grand_total' => $data['total'],
            'status' => PaymentStatus::REQUEST
        ];

        $this->data['user_carbon_offset'] = [
            'user_id' => $this->user->id,
            'transaction_id' => $trID,
            'offset_date' => $now,
            'total_offset' => $getOffset
        ];

        $this->data['user_tree'] = [];

        foreach ($getAvailableTree as $availTree) {
            $this->data['user_tree'] = [
                'user_id' => $this->user->id,
                'tree_id' => $availTree['tree_id'],
                'transaction_id' => $trID,
                'date_adopted' => $now,
                'user_tree_sequestration' => $availTree['user_tree_sequestration'],
            ];
        }

        DB::beginTransaction();
        try {
            $this->mainRepository->create($this->data['transaction']);
            $this->userCarbonOffsetRepository->create($this->data['user_carbon_offset']);
            $this->userTreeRepository->create($this->data['user_tree']);
        } catch (Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage(), $this->data);
            return false;
        }
        DB::commit();

        $this->data['token'] = $this->midtrans->getToken([
            'transaction_details' => [
                'order_id' => $orderID,
                'gross_amount' => $data['total']
            ],
            'customer_details' => [
                'first_name' => $this->user->name,
                'last_name' => '',
                'email' => $this->user->email,
                'phone' => $this->user->phone,
            ]
        ]);

        return true;
    }

    public function doPlanting(array $data): bool
    {
        return false;
    }

    public function callbackPayment(array $data): bool
    {
        $orderID = $data['order_id'];
        $tr = $this->mainRepository->findByOrderID($orderID);

        $paymentFails = [PaymentStatus::DENY, PaymentStatus::EXPIRE, PaymentStatus::CANCEL];
        $updateTransaction = [
            'payment_method' => $data['payment_type'],
            'payment_detail' => json_encode($data),
            'status' => Converter::paymentStatusMidtransToInternal($data['transaction_status'])
        ];

        DB::beginTransaction();
        // check if payment fail
        if (in_array($data['transaction_status'], $paymentFails)) {
            if (!$this->userTreeRepository->deleteByTransactionID($tr->id)) {
                DB::rollBack();
                return false;
            }
            if (!$this->userCarbonOffsetRepository->deleteByTransactionID($tr->id)) {
                DB::rollBack();
                return false;
            }
        }

        if ($tr->type == 'donate' && in_array($data['transaction_status'], [PaymentStatus::SUCCESS, PaymentStatus::SETTLEMENT]) && $tr->status != 'success') {
            if (!$this->donateRepository->sumCollection($tr->donate_id, $tr->grand_total)) {
                DB::rollBack();
                return false;
            }
        }

        if (!$this->mainRepository->update($tr->id, $updateTransaction)) {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }
}
