<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Design extends Model
{
    use HasFactory, SoftDeletes;
    // add guarded
    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orderDetails(): BelongsToMany
    {
        return $this->BelongsToMany(OrderDetails::class, 'design_order_detail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items(): BelongsToMany
    {
        return $this->BelongsToMany(Item::class);
    }

}
