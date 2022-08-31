<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    // add guarded 
    protected $guarded = [];

    // relation between Contact & Phone 
    public function phones() {
        return $this->hasMany(Phone::class);
    }

    // relation between Contact & Address 
    public function addresses() {
        return $this->hasMany(Address::class);
    }
}
