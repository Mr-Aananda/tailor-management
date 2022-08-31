<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmployeeSalary extends Model
{
    use HasFactory;
    // add guarded
    protected $fillable = [
        'employee_id',
        'salary_month',
        'given_date',
        'cash_id',
        'payment_type',
    ];
    protected $dates = ['salary_month'];

    /**
     * get all account from bank
     * @return HasMany
     */
    public function employeeSalaryDetails(): HasMany
    {
        return $this->HasMany(EmployeeSalaryDetails::class);
    }

    /**
     * get all account from bank
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->BelongsTo(Employee::class);
    }
}
