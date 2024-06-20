<?php

namespace App\Repositories\UserTree;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\UserTree;

class UserTreeRepositoryImplement extends Eloquent implements UserTreeRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(UserTree $model)
    {
        $this->model = $model;
    }

    public function deleteByTransactionID(string $trID): bool
    {
        return $this->model->where('transaction_id', $trID)->delete();
    }
}
