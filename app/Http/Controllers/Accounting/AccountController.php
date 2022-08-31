<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Element;

class AccountController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get default data
        $elements = Element::all();
        $records = Account::with('element')->paginate($this->paginate);

        // search
        if (request()->search) {
            $where = [];
            
            // search by name 
            if (request()->name != null) {
                $where[] = ['name', 'LIKE', "%" . request()->name . "%"];
            }

            // search by element 
            if (request()->account_element != null) {
                $where[] = ['element_id', '=', request()->account_element];
            }

            // get data
            $records = Account::with('element')->where($where)->paginate($this->paginate);
        }

        // view
        return view('accounting.account.index', compact('elements', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $elements = Element::all();
        return view('accounting.account.create', compact('elements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // get element details
        $element = Element::findOrFail($request->element_id);

        // validation
        $data = $request->validate([
            'name'              => 'required|string',
            'element_id'        => 'required|integer',
            'description'       => 'nullable'
        ]);

        // set additional data
        $data['is_debit'] = $element->is_debit;
        $data['is_credit'] = $element->is_credit;

        // insert
        Account::create($data);

        // view
        return redirect()->back()->withSuccess('Account create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $record = Account::findOrFail($id);
        return view("accounting.account.show", compact("record"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // get all the elements
        $elements = Element::all();

        // get the specified resource
        $record = Account::findOrFail($id);

        // view
        return view('accounting.account.edit', compact('elements', 'record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // get element details
        $element = Element::findOrFail($request->element_id);
        
        // get the specified resource
        $account = Account::findOrFail($id);

        // validation
        $data = $request->validate([
            'name'              => 'required|string',
            'element_id'        => 'required|integer',
            'description'       => 'nullable'
        ], [
            // 'name.required'     => 'custom message',
        ]);

        // set additional data
        $data['is_debit'] = $element->is_debit;
        $data['is_credit'] = $element->is_credit;

        // update
        $account->update($data);

        // view with message
        return redirect()->route('accounts.index')->with('success', 'Account details has been updated successfully.');
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
        $account = Account::findOrFail($id);

        // view
        if ($account->delete()) {
            return redirect()->route('accounts.index')->withSuccess('Account deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete account.');
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
        $records = Account::onlyTrashed()->paginate($this->paginate);

        // search
        if (request()->search) {
            $where[] = ['name', 'LIKE', "%" . request()->name . "%"];
            $records = Account::onlyTrashed()->where($where)->paginate($this->paginate);
        }

        // view
        return view('accounting.account.trash', compact('records'));
    }

    /**
     *
     */
    public function restoreOrDelete(Request $request)
    {
        if ($request->accounts != null) {
            if ($request->restore) {
                foreach ($request->accounts as $account) {
                    Account::withTrashed()->find($account)->restore();
                }

                // view
                return redirect()->back()->withSuccess('Accounts restored successfully.');
            } else {
                foreach ($request->accounts as $account) {
                    Account::withTrashed()->find($account)->forceDelete();
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
        Account::withTrashed()->find($id)->restore();

        // view
        return redirect()->back()->withSuccess('Account restore successfully.');
    }

    /**
     *
     */
    public function permanentDelete($id)
    {
        // Permanent delete by id
        Account::withTrashed()->find($id)->forceDelete();

        // view
        return redirect()->back()->withSuccess('Account deleted permanently.');
    }
}
