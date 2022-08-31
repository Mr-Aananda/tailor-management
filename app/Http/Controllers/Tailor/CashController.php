<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use Illuminate\Http\Request;

class CashController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashes = Cash::paginate($this->paginate);
        return view('tailor.cash.index', compact('cashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tailor.cash.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $data = $request->validate([
            'cash_name'         => 'required|string',
            'balance' => 'required|numeric',
            'description'       => 'nullable'
        ]);
        //Insert
        Cash::create($data);
        // view
        return redirect()->back()->withSuccess('Cash create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $cash = Cash::findOrFail($id);
        // view
        return view('tailor.cash.edit', compact('cash'));
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
        $cash = Cash::findOrFail($id);

        // validation
        $data = $request->validate([
            'cash_name'         => 'required|string',
            'balance' => 'required|numeric',
            'description'       => 'nullable'
        ]);
        // update
        $cash->update($data);

        // view with message
        return redirect()->route('cash.index')->with('success', 'Cash has been updated successfully.');
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
        $cash = Cash::findOrFail($id);

        // view
        if ($cash->delete()) {
            return redirect()->route('cash.index')->withSuccess('Cash deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete cash.');
        }
    }
}
