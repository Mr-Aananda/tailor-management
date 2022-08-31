<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use HasFactory, SoftDeletes;

    // add guarded 
    protected $guarded = [];

    // relation between Journal & JournalDetails 
    public function journalDetails() {
        return $this->hasMany(JournalDetail::class);
    }

    // relation between Journal & Depreciation 
    public function depreciation() {
        return $this->hasOne(Depreciation::class);
    }

    // relation between Journal & Template 
    public function template() {
        return $this->belongsTo(Template::class);
    }

    // relation between Journal & Contact 
    public function contact() {
        return $this->belongsTo(Contact::class);
    }

    // relation between Journal & User 
    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
