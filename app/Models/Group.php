<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    // add guarded 
    protected $guarded = [];

    // relation between Group & Template  
    public function template() {
        return $this->hasMany(Template::class);
    }
    
}
