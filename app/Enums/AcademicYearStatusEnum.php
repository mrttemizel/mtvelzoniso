<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum AcademicYearStatusEnum: string
{
    use EnumTrait;

    case ACTIVE = 'active';

    case INACTIVE = 'inactive';
}
