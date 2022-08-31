<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateDetails extends Model
{
    use HasFactory;

    // add guarded 
    protected $guarded = [];

    // relation between Template & Group 
    public function account() {
        return $this->belongsTo(Account::class);
    }
    
}
