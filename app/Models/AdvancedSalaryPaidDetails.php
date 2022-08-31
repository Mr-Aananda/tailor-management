<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancedSalaryPaidDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'advanced_salary_details_id',
        'installment_pay',
    ];
}
