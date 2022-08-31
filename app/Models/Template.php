<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes;

    // add guarded 
    protected $guarded = [];

    // relation between Template & Group 
    public function group() {
        return $this->belongsTo(Group::class);
    }

    // relation between Template & TemplateDetails 
    public function templateDetails() {
        return $this->hasMany(TemplateDetails::class);
    }

    // relation between Template & TemplateDetails 
    public function journal() {
        return $this->hasMany(Journal::class);
    }
    
}
