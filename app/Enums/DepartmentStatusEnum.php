<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum DepartmentStatusEnum: string
{
    use EnumTrait;

    case ACTIVE = 'active';

    case INACTIVE = 'inactive';
}
