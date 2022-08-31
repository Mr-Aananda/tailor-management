<?php

namespace App\Http\Controllers\accounting;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $records = Bank::with('bankAccounts')->paginate($this->paginate);

        if (request()->search) {
            $where[] = ['name', 'LIKE', "%" . request()->name . "%"];
            $records = Bank::where($where)->with('bankAccounts')->paginate($this->paginate);
        }

        return view('accounting.bank.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('accounting.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $data = $request->validate([
            'name'              => 'required|string',
            'description'       => 'nullable'
        ]);
        // insert
        Bank::create($data);
        // view
        return redirect()->back()->withSuccess('Account create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Bank::with('bankAccounts')->findOrFail($id);

        return view("accounting.bank.show", compact("record"));
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
        $record = Bank::findOrFail($id);
        // view
        return view('accounting.bank.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get the specified resource
        $record = Bank::findOrFail($id);

        // validation
        $data = $request->validate([
            'name'              => 'required|string',
            'description'       => 'nullable'
        ], [
            // 'name.required'     => 'custom message',
        ]);

        // update
        $record->update($data);

        // view with message
        return redirect()->route('bank.index')->with('success', 'Bank details has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $record = Bank::findOrFail($id);

        // view
        if ($record->delete()) {
            return redirect()->route('bank.index')->withSuccess('Bank deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete bank.');
        }
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        // get all accounts
        $records = Bank::onlyTrashed()->paginate($this->paginate);

        // search
        if (request()->search) {
            $where[] = ['name', 'LIKE', "%" . request()->name . "%"];
            $records = Bank::onlyTrashed()->where($where)->paginate($this->paginate);
        }

        // view
        return view('accounting.bank.trash', compact('records'));
    }

    /**
     *
     */
    public function restoreOrDelete(Request $request)
    {
        if ($request->banks != null) {
            if ($request->restore) {
                foreach ($request->banks as $bank) {
                    Bank::withTrashed()->find($bank)->restore();
                }

                // view
                return redirect()->back()->withSuccess('Accounts restored successfully.');
            } else {
                foreach ($request->banks as $bank) {
                    Bank::withTrashed()->find($bank)->forceDelete();
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
        Bank::withTrashed()->find($id)->restore();

        // view
        return redirect()->back()->withSuccess('Account restore successfully.');
    }

    /**
     *
     */
    public function permanentDelete($id)
    {
        // Permanent delete by id
        Bank::withTrashed()->find($id)->forceDelete();

        // view
        return redirect()->back()->withSuccess('Account deleted permanently.');
    }
}
