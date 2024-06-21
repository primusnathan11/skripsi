<?php

namespace App\Repositories\Donation;

use LaravelEasyRepository\Repository;
use Ramsey\Uuid\Type\Integer;

interface DonationRepository extends Repository
{
    /**
     * Get Project using user_id
     *
     * @param Integer $user_id
     * @param int $donate
     * @return bool
     */
    public function sumCollection($donation_id, $donate);
}
