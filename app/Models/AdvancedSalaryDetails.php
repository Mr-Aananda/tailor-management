<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdvancedSalaryDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'advanced_salary_id',
        'amount',
        'installment',
        'cash_id',
        'payment_type',
        'note',
        'is_paid',
        'date',
    ];

    protected $appends = ['total_paid', 'total_due'];

    /**
     * get all account from bank
     * @return BelongsTo
     */
    public function advancedSalary(): BelongsTo
    {
        return $this->BelongsTo(AdvancedSalary::class);
    }

    /**
     * get all account from bank
     * @return HasMany
     */
    public function advancedSalaryPaidDetails(): HasMany
    {
        return $this->HasMany(AdvancedSalaryPaidDetails::class);
    }

    public function scopeUnpaid($query)
    {
        return $query->where('is_paid', 0);
    }

    public function getTotalPaidAttribute()
    {
        return $this->advancedSalaryPaidDetails->sum('installment_pay');
    }

    public function getTotalDueAttribute()
    {
        return $this->amount - $this->advancedSalaryPaidDetails->sum('installment_pay');
    }
}
