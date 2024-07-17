<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum ApplicationStatusEnum: string
{
    use EnumTrait;

    /**
     * Ilk basvuru durumu
     * 1. adim
     */
    case PENDING = 'pending';

    /**
     * Basvuru icinde eksik veya hatali bilgi oldugunda
     * 1. adimda gelcek
     */
    case MISSING_DOCUMENT = 'missing.document';

    /**
     * Basvuru reddedildiginde
     * 1. adimda gelcek
     */
    case REJECTED = 'rejected';

    /**
     * Başvuru ön kabul aldı ve mali onay bekleniyor
     */
    case SENT_PRE_APPROVAL_LETTER = 'sent.pre-approval.letter';

    /**
     * Mali onay icin dekont yuklendikten sonra bu statuye sahip olmali
     */
    case PENDING_FINANCIAL_APPROVAL = 'pending.financial.approval';

    /**
     * Odeme yapildiktan sonra resmi davetiyenin gonderilmesinde
     */
    case OFFICIAL_LETTER_SENT = 'official.letter.sent';

    /**
     * Datatable icerisinde islemler alaninda kullaniliyor
     *
     * @param string $value
     * @return string
     */
    public static function getStep(string $value): string
    {
        return match($value) {
            self::PENDING->value,
            self::MISSING_DOCUMENT->value => 'stepOne',

            self::PENDING_FINANCIAL_APPROVAL->value,
            self::SENT_PRE_APPROVAL_LETTER->value => 'stepTwo',

            self::OFFICIAL_LETTER_SENT->value,
            self::REJECTED->value => 'none'
        };
    }
}
