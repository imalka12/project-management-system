<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static cash()
 * @method static static cheque()
 * @method static static bank_transfer()
 */
final class PaymentMethod extends Enum
{
    const cash = 'Cash';
    const cheque = 'Cheque';
    const bank_transfer = 'Bank Transfer';
}
