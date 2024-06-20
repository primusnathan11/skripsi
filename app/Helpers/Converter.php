<?php

namespace App\Helpers;

use App\Constants\PaymentStatus;

class Converter
{
    public static function paymentStatusMidtransToInternal(string $status)
    {
        switch ($status) {
            case "capture":
                return PaymentStatus::SUCCESS;
            case "settlement":
                return PaymentStatus::SUCCESS;
            case "pending":
                return PaymentStatus::PENDING;
            case "deny":
                return PaymentStatus::DENY;
            case "cancel":
                return PaymentStatus::CANCEL;
            case "expire":
                return PaymentStatus::EXPIRE;
            default:
                return "undifined";
                break;
        }
    }
}
