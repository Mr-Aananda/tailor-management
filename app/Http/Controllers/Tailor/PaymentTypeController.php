<?php

namespace App\Http\Controllers\tailor;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentTypes = PaymentType::withCount('paymentDetails')->paginate($this->paginate);
        return view('tailor.payment-type.index', compact('paymentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tailor.payment-type.create');
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
            'name'         => 'required|string',
            'description'       => 'nullable'
        ]);
        //Insert
        PaymentType::create($data);
        // view
        return redirect()->back()->withSuccess('Payment type create successfully.');
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
        $paymentType = PaymentType::findOrFail($id);
        // view
        return view('tailor.payment-type.edit', compact('paymentType'));
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
        $paymentType = PaymentType::findOrFail($id);
        // validation
        $data = $request->validate([
            'name'              => 'required|string',
            'description'            => 'nullable'
        ]);
        // update
        $paymentType->update($data);

        // view with message
        return redirect()->route('payment-type.index')->with('success', 'Payment type has been updated successfully.');
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
        $paymentType = PaymentType::findOrFail($id);

        // view
        if ($paymentType->delete()) {
            return redirect()->route('payment-type.index')->withSuccess('Payment type deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }
}
