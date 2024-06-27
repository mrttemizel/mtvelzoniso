<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum UserStatusEnum: string
{
    use EnumTrait;

    case ACTIVE = 'active';

    case INACTIVE = 'inactive';
}
