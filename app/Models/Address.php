<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // address table 
    protected $table = 'contact_addresses';

    // add guarded 
    protected $guarded = [];
    
}
