<?php

namespace App\Vendor\Midtrans;

use Illuminate\Support\Facades\Log;
use Midtrans\Config;

class Snap
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$is3ds = true;
        Config::$isSanitized = true;
        Config::$overrideNotifUrl = url('api/notifications/payment');
        if (env("APP_ENV") == 'production') {
            Config::$isProduction = true;
        }
    }

    public function getToken($param)
    {
        Log::info('request token to midtrans', $param);
        return \Midtrans\Snap::getSnapToken($param);
    }
}
