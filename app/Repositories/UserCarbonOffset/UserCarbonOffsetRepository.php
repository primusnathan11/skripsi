<?php

namespace App\Repositories\UserCarbonOffset;

use LaravelEasyRepository\Repository;

interface UserCarbonOffsetRepository extends Repository
{
    /**
     * delete data using transaction id
     *
     * @param string $trID
     * @return boolean
     */
    public function deleteByTransactionID(string $trID): bool;
}
