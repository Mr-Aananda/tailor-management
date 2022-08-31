<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Group;
use App\Models\Template;
use App\Models\TemplateDetails;

class TemplateController extends Controller {

    private $paginate = 25;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get group
        $groups = Group::all();

        // paginate
        $records = Template::with('group', 'journal')->paginate($this->paginate);

        // search 
        if(request()->search) {
            $where = [];

            foreach (request()->filter as $key => $value) {
                if($key == 'group_id' && $value != null) {
                    $where[] = ['group_id', '=', $value];
                }

                if($key == 'particular' && $value != null) {
                    $where[] = ['particular', 'LIKE', "%" . $value . "%"];
                }
            }

            $records = Template::where($where)->with('group')->paginate($this->paginate);
        }

        // view
        return view('accounting.template.index', compact('groups', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // get groups & accounts
        $accounts = Account::all();
        $groups = Group::all();

        // view 
        return view('accounting.template.create', compact('accounts', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // return $request->all();

        // validation 
        $data = $request->validate([
            'particular'        => 'required|string',
            'group_id'          => 'required|integer',
            "debit_accounts"    => "required|array|min:1",
            'debit_accounts.*'  => 'required|integer|distinct',
            'is_depreciable'    => 'required|boolean',
            'description'       => 'nullable|string'
        ],[
            'is_depreciable.required' => 'The depreciable field is required.',
            'group_id.required' => 'The group field is required.'
        ]);

        $template = Template::create([
            'particular'        => $request->particular,
            'group_id'          => $request->group_id,
            'is_depreciable'    => $request->is_depreciable,
            'description'       => $request->description,
        ]);

        // return $request->all();

        foreach ($request->debit_accounts as $key => $debit_account) {
            // debit 
            $details = new TemplateDetails();
            $details->template_id = $template->id;
            $details->account_id = $debit_account;
            $details->is_debitable = true;
            $details->is_creditable = false;
            $details->save();

            // credit 
            $details = new TemplateDetails();
            $details->template_id = $template->id;
            $details->account_id = $request->credit_accounts[$key];
            $details->is_debitable = false;
            $details->is_creditable = true;
            $details->save();
        }

        // view
        return redirect()->back()->withSuccess('Template has been created successfully.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $record = Template::findOrFail($id);
        return view("accounting.template.show", compact("record"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $details = [];

        // get groups & accounts
        $accounts = Account::all();
        $groups = Group::all();

        // get specified resource
        $record = Template::findOrFail($id);
        $debitAccounts = array_values($record->templateDetails->where('is_debitable', 1)->toArray()); 
        $creditAccounts = array_values($record->templateDetails->where('is_creditable', 1)->toArray());
        
        foreach ($debitAccounts as $key => $debitAccount) {
            $details[] = [$debitAccount, $creditAccounts[$key]];
        }

        // view with message 
        return view('accounting.template.edit', compact('accounts', 'groups', 'record', 'details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // return $request->all();

        // get the specified resource
        $template = Template::findOrFail($id);

        // validation 
        $request->validate([
            'particular'        => 'required|string',
            'group_id'          => 'required|integer',
            "debit_accounts"    => "required|array|min:1",
            'debit_accounts.*'  => 'required|integer',
            "credit_accounts"   => "required|array|min:1",
            'credit_accounts.*' => 'required|integer',
            'is_depreciable'    => 'required|boolean',
            'description'       => 'nullable|string'
        ],[
            'is_depreciable.required' => 'The depreciable field is required.',
            'group_id.required' => 'The group field is required.'
        ]);

        // update 
        $template->update([
            'particular'        => $request->particular,
            'group_id'          => $request->group_id,
            'is_depreciable'    => $request->is_depreciable,
            'description'       => $request->description,
        ]);

        // remove all the details
        foreach ($template->templateDetails as $details) {
            TemplateDetails::findOrFail($details->id)->delete();
        }

        // insert new details 
        foreach ($request->debit_accounts as $key => $debit_account) {
            // debit 
            $details = new TemplateDetails();
            $details->template_id = $id;
            $details->account_id = $debit_account;
            $details->is_debitable = true;
            $details->is_creditable = false;
            $details->save();

            // credit 
            $details = new TemplateDetails();
            $details->template_id = $id;
            $details->account_id = $request->credit_accounts[$key];
            $details->is_debitable = false;
            $details->is_creditable = true;
            $details->save();
        }

        // view with message
        return redirect()->route('template.index')->with('success','Template has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // delete
        $template = Template::findOrFail($id);

        // view 
        if ($template->delete()) {
            return redirect()->route('template.index')->withSuccess('Template has been deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete template.');
        }
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash() {
        // get group
        $groups = Group::all();

        // get all accounts
        $records = Template::onlyTrashed()->paginate($this->paginate);

        // search 
        if(request()->search) {
            $where = [];

            foreach (request()->filter as $key => $value) {
                if($key == 'group_id' && $value != null) {
                    $where[] = ['group_id', '=', $value];
                }

                if($key == 'particular' && $value != null) {
                    $where[] = ['particular', 'LIKE', "%" . $value . "%"];
                }
            }

            $records = Template::onlyTrashed()->where($where)->paginate($this->paginate);
        }

        // view
        return view('accounting.template.trash', compact('groups', 'records'));
    }

    /**
     * 
     */
    public function restoreOrDelete(Request $request) {
        $message = "";

        if($request->templates != null) {
            foreach ($request->templates as $template) {
                if($request->restore) {
                    Template::withTrashed()->find($template)->restore();
                    $message = 'Templates has been restored successfully.';
                } else {
                    Template::withTrashed()->find($template)->forceDelete();
                    $message = 'Templates has been deleted permanently.';
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
        Template::withTrashed()->find($id)->restore();

        // view
        return redirect()->back()->withSuccess('Template has been restore successfully.');
    }

    /**
     * 
     */
    public function permanentDelete($id) {
        // Permanent delete by id
        Template::withTrashed()->find($id)->forceDelete();

        // view 
        return redirect()->back()->withSuccess('Template has been deleted permanently.');
    }
    
    public function getTemplatesByGroupId(Request $request) { 
        $templates = Template::where('group_id', $request->group_id)->get();
        return response($templates, 200);
    }

    public function getTemplateDetailsByTemplateId(Request $request) { 
        $details = [];
        
        $debitAccounts = TemplateDetails::where([
            ['template_id', $request->template_id],
            ['is_debitable', 1],
        ])->with('account')->get();

        $creditAccounts = TemplateDetails::where([
            ['template_id', $request->template_id],
            ['is_creditable', 1],
        ])->with('account')->get();

        foreach ($debitAccounts as $key => $debitAccount) {
            $details[] = [
                $debitAccount, 
                $creditAccounts[$key]
            ];
        }

        return response($details, 200);
    }

}
