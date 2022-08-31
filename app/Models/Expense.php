<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    // add guarded
    protected $guarded = [];


    /**
     * Get related subcategories
     *
     * @return BelongsTo
     */
    public function expenseSubCategory(): BelongsTo
    {
        return $this->belongsTo(ExpenseSubCategory::class);
    }
}
