<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function statuses(): HasMany
    {
        return $this->hasMany(EmailTemplateApplicationStatus::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(EmailTemplateAttachment::class);
    }
}
