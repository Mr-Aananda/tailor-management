<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller {

    private $paginate = 25;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get all groups
        $records = Group::paginate($this->paginate);

        // search 
        if(request()->search) {
            $where[] = ['name', 'LIKE', "%" . request()->name . "%"];
            $records = Group::where($where)->paginate($this->paginate);
        }

        // view
        return view('accounting.group.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('accounting.group.create');
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
            'name'              => 'required|string',
            'description'       => 'nullable'
        ]);

        // insert 
        Group::create($data);

        // view
        return redirect()->back()->withSuccess('Group create successfully.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $record = Group::findOrFail($id);
        return view("accounting.group.show", compact("record"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // get the specified resource
        $record = Group::findOrFail($id);

        // view 
        return view('accounting.group.edit', compact('record'));
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
        $group = Group::findOrFail($id);

        // validation
        $data = $request->validate([
            'name'              => 'required|string',
            'description'       => 'nullable'
        ], [
            // 'name.required'     => 'custom message',
        ]);

        // update 
        $group->update($data);

        // view with message
        return redirect()->route('group.index')->with('success','Group details has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // delete
        $group = Group::findOrFail($id);

        // view 
        if ($group->delete()) {
            return redirect()->route('group.index')->withSuccess('Group has been deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete group.');
        }
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash() {
        // get all accounts
        $records = Group::onlyTrashed()->paginate($this->paginate);

        // search 
        if(request()->search) {
            $where[] = ['name', 'LIKE', "%" . request()->name . "%"];
            $records = Group::onlyTrashed()->where($where)->paginate($this->paginate);
        }

        // view
        return view('accounting.group.trash', compact('records'));
    }

    /**
     * 
     */
    public function restoreOrDelete(Request $request) {
        if($request->groups != null) {
            if($request->restore) {
                foreach ($request->groups as $group) {
                    Group::withTrashed()->find($group)->restore();
                }

                // view 
                return redirect()->back()->withSuccess('Groups has been restored successfully.');
            } else {
                foreach ($request->groups as $group) {
                    Group::withTrashed()->find($group)->forceDelete();
                }

                // view
                return redirect()->back()->withSuccess('Group has been deleted permanently.');
            }
        }

        return back()->withErrors('No group(s) has been selected.');
    }

    /**
     * 
     */
    public function restore($id) {
        // restore by id
        Group::withTrashed()->find($id)->restore();

        // view
        return redirect()->back()->withSuccess('Group has been restore successfully.');
    }

    /**
     * 
     */
    public function permanentDelete($id) {
        // Permanent delete by id
        Group::withTrashed()->find($id)->forceDelete();

        // view 
        return redirect()->back()->withSuccess('Group has been deleted permanently.');
    }
}
