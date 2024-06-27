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
     * Basvuru gecerli oldugunda
     * 1. adim
     */
    case APPROVED = 'approved';

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
     * YOK taninirlik belgesi istendiginde
     * 1. adimda gelcek
     */
    case PENDING_RECOGNITION_CERTIFICATE = 'pending.recognition.certificate';

    /**
     * Odeme Istendigi zaman
     * 2. adimda gelcek
     */
    case PENDING_PAYMENT = 'pending.payment';


    /**
     * Odeme onaylandiginda
     */
    case APPROVAL_PAYMENT = 'approval.payment';

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
            self::APPROVED->value,
            self::MISSING_DOCUMENT->value,
            self::PENDING_RECOGNITION_CERTIFICATE->value => 'stepOne',

            self::PENDING_PAYMENT->value => 'stepTwo',

            self::OFFICIAL_LETTER_SENT->value,
            self::REJECTED->value => 'none'
        };
    }
}
