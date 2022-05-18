<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static pending()
 * @method static static ongoing()
 * @method static static complete()
 * @method static static onhold()
 */
final class ProjectStatus extends Enum
{
    const pending =   'Pending';
    const ongoing =   'Ongoing';
    const complete = 'Complete';
    const onhold = 'Onhold';
}


