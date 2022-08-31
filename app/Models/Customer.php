<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    // add guarded
    protected $guarded = [];

    /**
     * get all account from bank
     * @return BelongsToMany
     */
    public function customerOrders(): BelongsToMany
    {
        return $this->BelongsToMany(CustomerOrder::class);
    }
}
