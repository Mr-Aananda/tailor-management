<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdvancedSalary extends Model
{
    use HasFactory;
    // add guarded
    protected $fillable =  [
        'employee_id',
    ];

    protected $appends = ['total_installment_paid'];

    /**
     * get all account from bank
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->BelongsTo(Employee::class);
    }

    /**
     * get all account from bank
     * @return HasMany
     */
    public function advancedSalaryDetails(): HasMany
    {
        return $this->HasMany(AdvancedSalaryDetails::class);
    }

    public function getTotalInstallmentPaidAttribute()
    {
        return $this->advancedSalaryDetails->sum('total_paid');
    }
}
