<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Agency extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getTaxCertificateAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function getContractAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function hasContract(): bool
    {
        return strlen($this->getRawOriginal('contract'));
    }

    public function hasTaxCertificate(): bool
    {
        return strlen($this->getRawOriginal('tax_certificate'));
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
