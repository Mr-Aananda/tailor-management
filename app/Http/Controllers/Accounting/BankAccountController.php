<?php

namespace App\Http\Controllers\accounting;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get all bank
        $banks = Bank::all();

        // go to bank account view
        if(request()->bankId != null) {
            $bank = Bank::findOrFail(request()->bankId);
            return view('accounting.bank.account.create', compact('bank'));
        }
        
        // get all banks
        $records = BankAccount::with('bank')->paginate($this->paginate);

        if (request()->search) {
            $where = [];

            foreach (request()->filter as $key => $value) {
                if($value != null) {
                    if($key == 'bank_id') {
                        $where[] = [$key, '=', $value];
                    } else {
                        $where[] = [$key, 'LIKE', "%" . $value . "%"];
                    }
                }
            }

            // query
            $records = BankAccount::where($where)->with('bank')->paginate($this->paginate);
        }

        // view 
        return view('accounting.bank.account.index', compact('banks', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $banks = Bank::all();
        return view('accounting.bank.account.create', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // validation 
        $data = $request->validate([
            'bank_id' => 'required|integer',
            'account_name' => 'required|string',
            'account_number' => 'required|string',
            'branch' => 'required|string',
            'balance' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        // insert
        BankAccount::create($data);

        // view with message
        return redirect()->back()->withSuccess('Bank account has been create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $record = BankAccount::findOrFail($id);
        return view("accounting.bank.account.show", compact("record"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the specified resource
        $record = BankAccount::with(["bank"])->findOrFail($id);
        // view
        return view('accounting.bank.account.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // get the specified resource
        $record = BankAccount::findOrFail($id);

        // validation
        $data = $request->validate([

            'bank_id' => 'required|integer',
            'account_name' => 'required|string',
            'account_number' => 'required|string',
            'branch' => 'required|string',
            'balance' => 'nullable|numeric',
            'note' => 'nullable|string',

        ]);

        // update
        $record->update($data);

        // view with message
        return redirect()->route('bankAccount.index')->with('success', 'Bank account has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // delete
        $record = BankAccount::findOrFail($id);

        // view
        if ($record->delete()) {
            return redirect()->route('bankAccount.index')->withSuccess('Bank account deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete bank.');
        }
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash() {
        // get all banks
        $banks = Bank::all();

        // get all accounts
        $records = BankAccount::onlyTrashed()->paginate($this->paginate);

        // search
        if (request()->search) {
            $where = [];

            foreach (request()->filter as $key => $value) {
                if($value != null) {
                    if($key == 'bank_id') {
                        $where[] = [$key, '=', $value];
                    } else {
                        $where[] = [$key, 'LIKE', "%" . $value . "%"];
                    }
                }
            }

            // query
            $records = BankAccount::onlyTrashed()->where($where)->with('bank')->paginate($this->paginate);
        }

        // view
        return view('accounting.bank.account.trash', compact('banks', 'records'));
    }

    /**
     *
     */
    public function restoreOrDelete(Request $request)
    {
        if ($request->bankAccounts != null) {
            if ($request->restore) {
                foreach ($request->bankAccounts as $bankAccount) {
                    BankAccount::withTrashed()->find($bankAccount)->restore();
                }

                // view
                return redirect()->back()->withSuccess('Accounts restored successfully.');
            } else {
                foreach ($request->bankAccounts as $bankAccount) {
                    BankAccount::withTrashed()->find($bankAccount)->forceDelete();
                }

                // view
                return redirect()->back()->withSuccess('Accounts deleted permanently.');
            }
        }

        return back()->withErrors('No account(s) has been selected.');
    }

    /**
     *
     */
    public function restore($id)
    {
        // restore by id
        BankAccount::withTrashed()->find($id)->restore();

        // view
        return redirect()->back()->withSuccess('Account restore successfully.');
    }

    /**
     *
     */
    public function permanentDelete($id)
    {
        // Permanent delete by id
        BankAccount::withTrashed()->find($id)->forceDelete();

        // view
        return redirect()->back()->withSuccess('Account deleted permanently.');
    }
}
