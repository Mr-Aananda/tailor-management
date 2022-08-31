<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use HasFactory, SoftDeletes;
    // add guarded
    protected $guarded = [];

    /**
     * Get related subcategories
     *
     * @return HasMany
     */
    public function expenseSubcategories(): HasMany
    {
        return $this->hasMany(ExpenseSubCategory::class);
    }
}
