<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static advance_payment()
 * @method static static retention_payment()
 * @method static static installment_payment()
 */
final class PaymentType extends Enum
{
    const advance_payment =   'Advance Payment';
    const retention_payment =   'Retention Payment';
    const installment_payment = 'Installment Payment';
}

