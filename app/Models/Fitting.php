<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fitting extends Model
{
    use HasFactory, SoftDeletes;
    // add guarded
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderDetails(): HasOne
    {
        return $this->HasOne(OrderDetails::class);
    }
}
