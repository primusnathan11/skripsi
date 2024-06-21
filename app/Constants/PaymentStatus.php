<?php

namespace App\Constants;

class PaymentStatus
{
    // Waiting
    public const REQUEST = 'request';

    // Done Status
    public const SUCCESS = 'success';
    public const SETTLEMENT = 'settlement';

    // Pending Status
    public const PENDING = 'pending';

    // Fail Status
    public const DENY = 'deny';
    public const CANCEL = 'cancel';
    public const EXPIRE = 'expire';
}
