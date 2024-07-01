<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Application extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];

    public function hasPassportPhoto(): bool
    {
        return ! is_null($this->getRawOriginal('passport_photo'));
    }

    public function hasOfficialTranscript(): bool
    {
        return ! is_null($this->getRawOriginal('official_transcript'));
    }

    public function hasDocumentFile(): bool
    {
        return ! is_null($this->getRawOriginal('document_file'));
    }

    public function hasPaymentFile(): bool
    {
        return ! is_null($this->getRawOriginal('payment_file'));
    }

    public function getPassportPhotoAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function getOfficialTranscriptAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function getDocumentFileAttribute($value): string
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

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function schoolCountry(): BelongsTo
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
}
