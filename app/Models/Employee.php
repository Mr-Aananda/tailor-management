<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;
    // add guarded
    protected $guarded = [];

    /**
     * get all account from bank
     * @return HasOne
     */
    public function advancedSalaries(): HasOne
    {
        return $this->HasOne(AdvancedSalary::class);
    }

    /**
     * get all account from bank
     * @return HasMany
     */
    public function employeeSalaries(): HasMany
    {
        return $this->hasMany(EmployeeSalary::class);
    }
}
