<?php

namespace App\Http\Controllers\Accounting\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\JournalDetail;

class TrialBalanceController extends Controller {
    
    private $paginate = 25;

    public function index() {
        $records = [];
        $accounts = Account::all();

        foreach ($accounts as $account) {
            $debit_amount = JournalDetail::where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            $records[] = [
                'account_id' => $account->id,
                'account_name' => $account->name,
                'opening_balance' => $account->opening_balance,
                'debit_amount' => $debit_amount,
                'credit_amount' => $credit_amount,
            ];
        }

         // search 
         if(request()->search) {
            if (request()->account_id != null) {
                $records = [];
                
                // get the account details 
                $account = Account::findOrFail(request()->account_id);

                // get debit balance
                $debit_amount = JournalDetail::where([
                    ['account_id', '=', request()->account_id],
                    ['is_debit', '=', 1]
                ])->sum('amount');

                // get credit balance
                $credit_amount = JournalDetail::where([
                    ['account_id', '=', request()->account_id],
                    ['is_credit', '=', 1]
                ])->sum('amount');

                $records[] = [
                    'account_id' => $account->id,
                    'account_name' => $account->name,
                    'opening_balance' => $account->opening_balance,
                    'debit_amount' => $debit_amount,
                    'credit_amount' => $credit_amount,
                ];
            }
         }

        return view('accounting.reports.trial-balance', compact('accounts', 'records'));
    }

}
