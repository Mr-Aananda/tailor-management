<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    // add guarded
    protected $guarded = [];

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return Storage::url($this->image);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderDetails(): HasOne
    {
        return $this->HasOne(OrderDetails::class);
    }
}
