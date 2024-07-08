<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];

    public function getAnnualFeeAttribute($value): string
    {
        if (is_null($value)) {
            return '';
        }

        return '$' . number_format($value, 2);
    }

    public function getDiscountedFeeAttribute($value): string
    {
        if (is_null($value)) {
            return '';
        }

        return '$' . number_format($value, 2);
    }
}
