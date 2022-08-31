<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    // address table 
    protected $table = 'contact_details';

    // add guarded 
    protected $guarded = [];
    
}
