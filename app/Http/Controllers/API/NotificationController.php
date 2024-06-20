<?php

namespace App\Http\Controllers\API;

use App\Constants\ErrorMessage;
use App\Constants\ResponseMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Transaction\TransactionService;

class NotificationController extends Controller
{
    protected $transactionSvc;
    public function __construct(TransactionService $service)
    {
        $this->transactionSvc = $service;
    }

    public function payment(Request $request)
    {
        $request = $request->toArray();
        Log::info("callback midtrans payment start", $request);
        if (!$this->transactionSvc->callbackPayment($request)) {
            Log::info("callback midtrans payment done with error");
            return response()->json([
                'message' => ResponseMessage::ERROR_SERVER
            ], 500);
        }
        Log::info("callback midtrans payment done");
        return response()->json([
            'message' => ResponseMessage::SUCCESS
        ], 200);
    }
}
