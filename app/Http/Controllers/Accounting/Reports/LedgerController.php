<?php

namespace App\Http\Controllers\Accounting\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Journal;
use App\Models\JournalDetail;

class LedgerController extends Controller {
    private $paginate = 25;

    public function index() {
        // get accounts 
        $records = [];
        $accounts = Account::all();
        $ledgerAccount = [];

        // search 
        if(request()->search) {
            /* $records = JournalDetail::query()
            ->addSelect([
                "journal_details.id",
                "journal_details.journal_id",
                "journal_details.account_id",
                "journal_details.amount",
                "journal_details.is_debit",
                "journal_details.is_credit",
                "journal_details.pair_key",
                "journal_details.created_at",
                "journal_details.updated_at",
            ])
                ->where('journal_details.account_id', request()->account_id)
                ->join('journal_details as jd', function($join){
                    $join->on('journal_details.pair_key', '=', 'jd.pair_key')
                    ->whereColumn('journal_details.id', '!=', 'jd.id')
                    ->limit(1);
                })
                
                ->addSelect('jd.id as pair_id')
                ->addSelect('jd.account_id as pair_account_id')
                ->with('pair')
                ->get(); */

            /* $records = JournalDetail::query()
                ->where('journal_details.account_id', request()->account_id)
                ->withPair()
                ->with('pair.account')
                ->paginate($this->paginate); */

                
            /* $records = JournalDetail::query()
                ->where('journal_details.account_id', request()->account_id)
                ->addSelect([
                    "journal_details.*",
                ])->join('journal_details as jd', function($join){
                    $join->on('journal_details.pair_key', '=', 'jd.pair_key')
                        ->whereColumn('journal_details.id', '!=', 'jd.id')
                        ->limit(1);
                })
                ->join('accounts as pair_accounts', function($join){
                    $join->on('jd.account_id', '=', 'pair_accounts.id')
                        ->limit(1);
                })
                ->addSelect('pair_accounts.name as pair_account_name')
                ->get(); */

            if (request()->account_id != null) {
                // get account details
                $ledgerAccount = Account::findOrFail(request()->account_id);
                
                // get ledger reports
                $records = JournalDetail::query()
                    ->where('journal_details.account_id', request()->account_id)
                    ->addPairAccountColumns(['id', 'name'])
                    ->addJournalEntryDate()
                    ->orderBy("id", "asc")
                    ->paginate($this->paginate)
                    ->withQueryString();
            }
        }

        // return $records;

        return view('accounting.reports.ledger', compact('accounts', 'ledgerAccount', 'records'));
    }
    
}
