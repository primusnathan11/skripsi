<?php

namespace App\Repositories\Transaction;

use LaravelEasyRepository\Repository;

interface TransactionRepository extends Repository
{
    /**
     * find transaction by order_id
     *
     * @param string $orderID
     * @return object
     */
    public function findByOrderID(string $orderID): object;
}
