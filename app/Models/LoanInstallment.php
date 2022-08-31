<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanInstallment extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'date',
        'amount',
        'adjustment',
        'note',
        'cash_id',
        'payment_type',
    ];

    /* ==== Mutator Start ==== */

    public function setAdjustmentAttribute($value)
    {
        $this->attributes['adjustment'] = $value ?? 0;
    }

    /* ==== Mutator End ==== */

    /**
     * Get associated loan
     *
     * @return BelongsTo
     */
    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

}
