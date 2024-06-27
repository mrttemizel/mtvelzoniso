<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum ApplicationStepEnum: string
{
    use EnumTrait;

    case STEP_ONE = 'step.one';

    case STEP_TWO = 'step.two';

    case STEP_FINISH = 'step.finish';
}
