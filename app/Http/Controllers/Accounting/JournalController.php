<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Template;
use App\Models\Journal;
use App\Models\JournalDetail;
use App\Models\Depreciation;

class JournalController extends Controller {
    
    // paginate
    private $paginate = 25;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get all groups
        $groups = Group::all();

        // get all journal 
        $records = Journal::query()
            ->with('journalDetails.account', 'template', 'contact', 'user');

        // search 
        if(request()->search) {
            $where = [];

            foreach (request()->filter as $key => $value) {
                if($key == 'group_id' && $value != null) {
                    $where[] = ['group_id', '=', $value];
                }

                if($key == 'from') {
                    if($value != null) {
                        $where[] = ['entry_date', '>=', date($value)];
                    }
                }

                if($key == 'to') {
                    if($value != null) {
                        $where[] = ['entry_date', '<=', date($value)];
                    }
                }
            }

            // query
            $records = $records->where($where);
        }

        // query 
        $records = $records->orderBy("id", "desc")->paginate($this->paginate);

        // view 
        return view('accounting.journal.index', compact('groups', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // get all groups 
        $groups = Group::all();

        // get all employee contact  
        $contacts = Contact::all();

        // view 
        return view('accounting.journal.create', compact('groups', 'contacts'));
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
            'entry_date'            => 'required|date',
            'group_id'              => 'required|integer',
            'template_id'           => 'required|integer',
            // debit
            'debit_amount'          => 'required|array|min:1',
            'debit_amount.*'        => 'required|numeric',
            // credit
            'credit_amount'         => 'required|array|min:1',
            'credit_amount.*'       => 'required|numeric',
            // depreciation 
            'depreciationYear'      => 'nullable|integer',
            'depreciationAmount'    => 'nullable|numeric',

            'contact_id'            => 'required|integer',
            'note'                  => 'nullable|string',
        ],[
            'group_id.required'         => 'The group field is required.',
            'template_id.required'      => 'The template field is required.',
            'debit_amount.*.required'   => 'The :attribute field is required.',
            'debit_amount.*.numeric'    => 'The :attribute field is not valid.',
            'credit_amount.*.required'  => 'The :attribute field is required.',
            'credit_amount.*.numeric'   => 'The :attribute field is not valid.',
            'contact_id.required'       => 'The spender field is required.',
        ]);

        // insert journal 
        $journal = Journal::create([
            'entry_date' => $request->entry_date,
            'user_id' => Auth::id(),
            'group_id' => $request->group_id,
            'template_id' => $request->template_id,
            'contact_id' => $request->contact_id,
            'note' => $request->note
        ]);

        // insert journal details 
        foreach ($request->debit_account as $key => $debit_account_id) {
            $pair_key = uniqid() . rand();

            JournalDetail::create([
                'journal_id' => $journal->id,
                'account_id' => $debit_account_id,
                'amount' => $request->debit_amount[$key],
                'is_debit' => true,
                'is_credit' => false,
                'pair_key' => $pair_key
            ]);

            JournalDetail::create([
                'journal_id' => $journal->id,
                'account_id' => $request->credit_account[$key],
                'amount' => $request->credit_amount[$key],
                'is_debit' => false,
                'is_credit' => true,
                'pair_key' => $pair_key
            ]);
        }

        // depreciations 
        if ($request->has('depreciationYear')) { 
            Depreciation::create([
                'journal_id' => $journal->id,
                'years' => $request->depreciationYear,
                'amount' => $request->depreciationAmount,
            ]);
        }

        // view with message 
        return redirect()->back()->withSuccess('Journal has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $record = Journal::findOrFail($id);
        return view('accounting.journal.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $details = [];

        // get groups & contacts 
        $groups = Group::all();
        $contacts = Contact::all();

        // get specified resource
        $record = Journal::findOrFail($id);

        if($record->journalDetails != null) {
            foreach ($record->journalDetails as $key => $value) {
                if($value->is_debit) {
                    $details['debit_amount'][] = $value->amount;
                } else {
                    $details['credit_amount'][] = $value->amount;
                }
                
            }
        } else {
            $details['debit_amount'] = '';
            $details['credit_amount'] = '';
        }

        // view 
        return view('accounting.journal.edit', compact('groups', 'contacts', 'record', 'details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // get specified resource
        $journal = Journal::findOrFail($id);

        // validation 
        $data = $request->validate([
            'entry_date'            => 'required|date',
            'group_id'              => 'required|integer',
            'template_id'           => 'required|integer',
            // debit
            'debit_amount'          => 'required|array|min:1',
            'debit_amount.*'        => 'required|numeric',
            // credit
            'credit_amount'         => 'required|array|min:1',
            'credit_amount.*'       => 'required|numeric',
            // depreciation 
            'depreciationYear'      => 'nullable|integer',
            'depreciationAmount'    => 'nullable|numeric',
            'contact_id'            => 'required|integer',
            'note'                  => 'nullable|string',
        ],[
            'group_id.required'         => 'The group field is required.',
            'template_id.required'      => 'The template field is required.',
            'debit_amount.*.required'   => 'The :attribute field is required.',
            'debit_amount.*.numeric'    => 'The :attribute field is not valid.',
            'credit_amount.*.required'  => 'The :attribute field is required.',
            'credit_amount.*.numeric'   => 'The :attribute field is not valid.',
            'contact_id.required'       => 'The spender field is required.',
        ]);

        // update journal 
        $journal->update([
            'entry_date' => $request->entry_date,
            'user_id' => Auth::id(),
            'group_id' => $request->group_id,
            'template_id' => $request->template_id,
            'contact_id' => $request->contact_id,
            'note' => $request->note
        ]);

        // remove all the details
        foreach ($journal->journalDetails as $details) {
            JournalDetail::findOrFail($details->id)->delete();
        }

        // insert journal details 
        foreach ($request->debit_account as $key => $debit_account_id) {
            $pair_key = uniqid() . rand();

            JournalDetail::create([
                'journal_id' => $journal->id,
                'account_id' => $debit_account_id,
                'amount' => $request->debit_amount[$key],
                'is_debit' => true,
                'is_credit' => false,
                'pair_key' => $pair_key
            ]);

            JournalDetail::create([
                'journal_id' => $journal->id,
                'account_id' => $request->credit_account[$key],
                'amount' => $request->credit_amount[$key],
                'is_debit' => false,
                'is_credit' => true,
                'pair_key' => $pair_key
            ]);
        }

        // update depreciations 
        if ($request->has('depreciationYear')) { 
            $depreciation = Depreciation::findOrFail($journal->depreciation->id);

            $depreciation->update([
                'years' => $request->depreciationYear,
                'amount' => $request->depreciationAmount,
            ]);
        }

        // view + message 
        return redirect()->back()->withSuccess("Journal & it's details has been updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // delete
        $journal = Journal::findOrFail($id);

        // view 
        if ($journal->delete()) {
            return redirect()->route('journal.index')->withSuccess('Journal has been deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete journal.');
        }
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash() {
        // get all groups
        $groups = Group::all();

        // get all journal 
        $records = Journal::onlyTrashed()->with('template', 'contact', 'user');

        // search 
        if(request()->search) {
            $where = [];

            foreach (request()->filter as $key => $value) {
                if($key == 'group_id' && $value != null) {
                    $where[] = ['group_id', '=', $value];
                }

                if($key == 'from') {
                    if($value != null) {
                        $where[] = ['entry_date', '>=', date($value)];
                    }
                }

                if($key == 'to') {
                    if($value != null) {
                        $where[] = ['entry_date', '<=', date($value)];
                    }
                }
            }

            // query 
            $records = $records->where($where);
        }

        // query 
        $records = $records->orderBy("id", "desc")->paginate($this->paginate);

        // view
        return view('accounting.journal.trash', compact('groups', 'records'));
    }

    /**
     * 
     */
    public function restoreOrDelete(Request $request) {
        $message = "";

        if($request->journals != null) {
            foreach ($request->journals as $journal) {
                if($request->restore) {
                    Journal::withTrashed()->find($journal)->restore();
                    $message = 'Journals has been restored successfully.';
                } else {
                    Journal::withTrashed()->find($journal)->forceDelete();
                    $message = 'Journals has been deleted permanently.';
                }
            }

            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withErrors('No record(s) has been selected.');
    }

    /**
     * 
     */
    public function restore($id) {
        // restore by id
        Journal::withTrashed()->find($id)->restore();

        // view
        return redirect()->back()->withSuccess('Journal has been restore successfully.');
    }

    /**
     * 
     */
    public function permanentDelete($id) {
        // Permanent delete by id
        Journal::withTrashed()->find($id)->forceDelete();

        // view 
        return redirect()->back()->withSuccess('Journal has been deleted permanently.');
    }

}
