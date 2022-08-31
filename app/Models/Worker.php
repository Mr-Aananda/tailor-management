<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use HasFactory, SoftDeletes;
    // add guarded
    protected $guarded = ['item_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Distributions(): HasMany
    {
        return $this->HasMany(Distribution::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items(): BelongsToMany
    {
        return $this->BelongsToMany(Item::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workerSalaries(): HasMany
    {
        return $this->HasMany(WorkerSalary::class);
    }
}


