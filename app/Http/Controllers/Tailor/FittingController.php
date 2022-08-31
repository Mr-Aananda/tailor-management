<?php

namespace App\Http\Controllers\tailor;

use App\Http\Controllers\Controller;
use App\Models\Fitting;
use Illuminate\Http\Request;

class FittingController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fittings = Fitting::withCount('orderDetails')->paginate($this->paginate);
        return view('tailor.fitting.index', compact('fittings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tailor.fitting.create');
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
            'fitting_name'         => 'required|string',
            'description'       => 'nullable'
        ]);
        //Insert
        Fitting::create($data);
        // view
        return redirect()->back()->withSuccess('Fitting create successfully.');
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
        $fitting = Fitting::findOrFail($id);
        // view
        return view('tailor.fitting.edit', compact('fitting'));
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
        $fitting = Fitting::findOrFail($id);

        // validation
        $data = $request->validate([
            'fitting_name'              => 'required|string',
            'description'            => 'nullable'
        ]);
        // update
        $fitting->update($data);

        // view with message
        return redirect()->route('fitting.index')->with('success', 'Fitting has been updated successfully.');
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
        $fitting = Fitting::findOrFail($id);

        // view
        if ($fitting->delete()) {
            return redirect()->route('fitting.index')->withSuccess('Fitting deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }
}
