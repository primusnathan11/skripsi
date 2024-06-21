<?php

namespace App\Repositories\Donation;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Donation;
use App\Repositories\Donation\DonationRepository;
use Illuminate\Support\Facades\DB;

class DonationRepositoryImplement extends Eloquent implements DonationRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Donation $model)
    {
        $this->model = $model;
    }

    public function sumCollection($donation_id, $donation_val)
    {
        // get donation
        $donation = $this->model->where('id', $donation_id)->first();
        $updateDonate['collected'] = $donation->collected + $donation_val;

        $this->update($donation_id, $updateDonate);

        return true;
    }
}
