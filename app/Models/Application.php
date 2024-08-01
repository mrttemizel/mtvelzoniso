<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Application extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'date_of_birth' => 'date',
        'year_of_graduation' => 'date'
    ];

    public function isSameAgency($agencyId): bool
    {
        return $this->agency_id == $agencyId;
    }

    public function hasPassportPhoto(): bool
    {
        return ! is_null($this->getRawOriginal('passport_photo'));
    }

    public function hasOfficialTranscript(): bool
    {
        return ! is_null($this->getRawOriginal('official_transcript'));
    }

    public function hasPaymentFile(): bool
    {
        return ! is_null($this->getRawOriginal('payment_file'));
    }

    public function hasSchoolDiploma(): bool
    {
        return ! is_null($this->getRawOriginal('school_diploma'));
    }

    public function hasAdditionalDocument(): bool
    {
        return ! is_null($this->getRawOriginal('additional_document'));
    }

    public function getPaymentFileAtAttribute($value): string
    {
        if (is_null($value)) {
            return '';
        }

        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getPassportPhotoAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function getSchoolDiplomaAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function getAdditionalDocumentAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function getOfficialTranscriptAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function getOfficialExamAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function getPaymentFileAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
