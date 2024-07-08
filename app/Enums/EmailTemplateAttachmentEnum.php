<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum EmailTemplateAttachmentEnum: string
{
    use EnumTrait;

    case PRE_LETTER = 'pre.letter';
}
