<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalDetail extends Model
{
    use HasFactory;

    // add guarded 
    protected $guarded = [];

    /**
     * with pair row details using paire_key 
     * 
     * join with self(journal_details)
     * get pair row using pair_key and not the same id
     * set alias for pair row id  
     * 
     */
    public function scopeWithPair($query) {
        return $query->addSelect([
            "journal_details.*",
        ])->join('journal_details as jd', function($join) {
            $join->on('journal_details.pair_key', '=', 'jd.pair_key')
                ->whereColumn('journal_details.id', '!=', 'jd.id')
                ->limit(1);
        })->addSelect('jd.id as pair_id')
        ->with('pair');
    }
    
    /**
     * get pair account name 
     * 
     * get pair row 
     * get pair account name 
     * set alias for account name 
     */
    public function scopeAddPairAccountColumns($query, $pairAccountColumns = ['name'], $journalDetailsColumns = ["journal_details.*"]) {
        $query =  $query->addSelect($journalDetailsColumns)
        ->join('journal_details as jd', function($join){
            $join->on('journal_details.pair_key', '=', 'jd.pair_key')
                ->whereColumn('journal_details.id', '!=', 'jd.id')
                ->limit(1);
        })
        ->join('accounts as pair_accounts', function($join){
            $join->on('jd.account_id', '=', 'pair_accounts.id')
                ->limit(1);
        });

        foreach ($pairAccountColumns as $column_name) {
            $query->addSelect("pair_accounts.$column_name as pair_account_$column_name");
        }
        
        return $query;
    }

    /**
     * get journal entry date
     * 
     * add Journal model with foreign key
     * and casts entry_date to date format 
     */
    public function scopeAddJournalEntryDate($query) {
        return $query->addSelect([
            'journal_entry_date' => Journal::select('entry_date')
            ->whereColumn('journal_details.journal_id', 'journals.id')
            ->limit(1)
        ])
        ->withCasts([
            'journal_entry_date' => 'date'
        ]);
    }

    // relation between Journal & Template 
    public function account() {
        return $this->belongsTo(Account::class);
    }

    // relation between Journal & Template 
    public function journal() {
        return $this->belongsTo(Journal::class);
    }

    // relation between Journal & Template 
    public function pair() {
        return $this->belongsTo(JournalDetail::class, 'pair_id');
    }

}
