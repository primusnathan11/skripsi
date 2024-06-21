<?php

namespace App\Repositories\UserTree;

use LaravelEasyRepository\Repository;

interface UserTreeRepository extends Repository
{
    /**
     * delete data using transaction id
     *
     * @param string $trID
     * @return boolean
     */
    public function deleteByTransactionID(string $trID): bool;
}
