<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    // fillable
    protected $fillable = ['name', 'element_id', 'is_debit', 'is_credit', 'description'];

    // relation between account & element 
    public function element() {
        return $this->belongsTo(Element::class);
    }

    // relation between Account & JournalDetails 
    public function journalDetails() {
        return $this->hasMany(JournalDetail::class);
    }
}
