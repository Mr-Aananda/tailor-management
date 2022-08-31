<?php

namespace App\Http\Controllers\Accounting\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\JournalDetail;

class OwnersEquityController extends Controller {

    public function index() {
        $startYear = 2018;
        $ownersEquityYear = date('Y');
        $ownersEquityDetails = [];

        // search 
        if(request()->search) {
            if (request()->ownersEquityYear != null) {
                $ownersEquityYear = request()->ownersEquityYear;
            }
            
        }

        /**
         * get Owners Equity (OE)
         * Formula: Owners Equity = ((Capital + Revenue) - Expense) - Owner's withdraw 
         * Formula: OE = C + (Re - Ex - D)
         * 
         */

         // get Capital (C) accounts. id is 3.
        $capital_accounts = Account::where('element_id', 3)->get();

        foreach ($capital_accounts as $account) {
            $debit_amount = JournalDetail::whereYear('created_at', $ownersEquityYear)->where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::whereYear('created_at', $ownersEquityYear)->where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            $ownersEquityDetails[] = [
                'account_id' => $account->id,
                'account_name' => $account->name,
                'opening_balance' => $account->opening_balance,
                'debit_amount' => $debit_amount,
                'credit_amount' => $credit_amount,
            ];
        }

        // get Revenue (Re) accounts. id is 4.
        $revenue_accounts = Account::where('element_id', 4)->get();

        foreach ($revenue_accounts as $account) {
            $debit_amount = JournalDetail::whereYear('created_at', $ownersEquityYear)->where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::whereYear('created_at', $ownersEquityYear)->where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            $ownersEquityDetails[] = [
                'account_id' => $account->id,
                'account_name' => $account->name,
                'opening_balance' => $account->opening_balance,
                'debit_amount' => $debit_amount,
                'credit_amount' => $credit_amount,
            ];
        }

        // get Expense (Ex) accounts. id is 5.
        $expense_accounts = Account::where('element_id', 5)->get();

        foreach ($expense_accounts as $account) {
            $debit_amount = JournalDetail::whereYear('created_at', $ownersEquityYear)->where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::whereYear('created_at', $ownersEquityYear)->where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            $ownersEquityDetails[] = [
                'account_id' => $account->id,
                'account_name' => $account->name,
                'opening_balance' => $account->opening_balance,
                'debit_amount' => $debit_amount,
                'credit_amount' => $credit_amount,
            ];
        }

        // get Drawings (D) accounts. id is 6.
        $drawings_accounts = Account::where('element_id', 6)->get();

        foreach ($drawings_accounts as $account) {
            $debit_amount = JournalDetail::whereYear('created_at', $ownersEquityYear)->where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::whereYear('created_at', $ownersEquityYear)->where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            $ownersEquityDetails[] = [
                'account_id' => $account->id,
                'account_name' => $account->name,
                'opening_balance' => $account->opening_balance,
                'debit_amount' => $debit_amount,
                'credit_amount' => $credit_amount,
            ];
        }

        return view('accounting.reports.owners-quity', compact('startYear', 'ownersEquityYear','ownersEquityDetails'));

    }

}
