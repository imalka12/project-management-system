<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static admin()
 * @method static static general_user()
 */
final class UserType extends Enum
{
    const admin = 'Admin';
    const general_user = 'General User';
}
