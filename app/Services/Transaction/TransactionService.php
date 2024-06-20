<?php

namespace App\Services\Transaction;

use LaravelEasyRepository\BaseService;

interface TransactionService extends BaseService
{
    /**
     * do a adopt transaction
     *
     * @param array $data
     * @var string $data['product_id'] required
     * @var string $data['product_name']
     * @var float $data['total'] required
     * @return boolean
     */
    public function doAdopt(array $data): bool;

    /**
     * Undocumented function
     *
     * @param array $data
     * @return boolean
     */
    public function doPlanting(array $data): bool;

    /**
     * handle callback from payment
     *
     * @param array $data
     * @return boolean
     */
    public function callbackPayment(array $data): bool;
}
