<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum AgencyStatusEnum: string
{
    use EnumTrait;

    case ACTIVE = 'active';

    case INACTIVE = 'inactive';
}
