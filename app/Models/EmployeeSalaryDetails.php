<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_salary_id',
        'purpose',
        'dtls_amount',
        'type',
    ];
}
