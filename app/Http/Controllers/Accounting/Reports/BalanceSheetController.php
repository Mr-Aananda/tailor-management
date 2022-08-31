<?php

namespace App\Http\Controllers\Accounting\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\JournalDetail;

class BalanceSheetController extends Controller {
    
    // render per page 
    private $paginate = 25;

    public function index() {
        $startYear = 2018;
        $balanceSheetYear = date('Y');
        $balanceSheetAssets = [];
        $balanceSheetLiabilities = [];
        $balanceSheetOwnersEquities = [];

        // search 
        if(request()->search) {
            if (request()->balanceSheetYear != null) {
                $balanceSheetYear = request()->balanceSheetYear;
            }
            
        }

        /**
         * A = L + OE
         * 
         */
        
        // get Assets (A) accounts. id is 1.
        $assets_accounts = Account::where('element_id', 1)->get();

        foreach ($assets_accounts as $account) {
            $debit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            $balanceSheetAssets[] = [
                'account_id' => $account->id,
                'account_name' => $account->name,
                'opening_balance' => $account->opening_balance,
                'debit_amount' => $debit_amount,
                'credit_amount' => $credit_amount,
            ];
            
        }

        // get Liabilities (L) accounts. id is 2.
        $liabilities_accounts = Account::where('element_id', 2)->get();
        
        foreach ($liabilities_accounts as $account) {
            $debit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            $balanceSheetLiabilities[] = [
                'account_id' => $account->id,
                'account_name' => $account->name,
                'opening_balance' => $account->opening_balance,
                'debit_amount' => $debit_amount,
                'credit_amount' => $credit_amount,
            ];
            
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
            $debit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            // $balanceSheetCapital[] = [
            $balanceSheetOwnersEquities[] = [
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
            $debit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            // $balanceSheetRevenue[] = [
            $balanceSheetOwnersEquities[] = [
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
            $debit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            // $balanceSheetExpense[] = [
            $balanceSheetOwnersEquities[] = [
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
            $debit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_debit', '=', 1]
            ])->sum('amount');

            $credit_amount = JournalDetail::whereYear('created_at', $balanceSheetYear)->where([
                ['account_id', '=', $account->id],
                ['is_credit', '=', 1]
            ])->sum('amount');

            // $balanceSheetDrawings[] = [
            $balanceSheetOwnersEquities[] = [
                'account_id' => $account->id,
                'account_name' => $account->name,
                'opening_balance' => $account->opening_balance,
                'debit_amount' => $debit_amount,
                'credit_amount' => $credit_amount,
            ];
        }

        return view('accounting.reports.balance-sheet', compact('startYear', 'balanceSheetYear', 'balanceSheetAssets', 'balanceSheetLiabilities', 'balanceSheetOwnersEquities'));
    }

}
