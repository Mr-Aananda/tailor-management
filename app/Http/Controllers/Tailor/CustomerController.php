<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers_query= Customer::query();

        if (request('customer_name')) {
            $customers_query->where('customer_name', 'like', '%' . request('customer_name') . '%');
        }
        $customers = $customers_query->paginate($this->paginate);
        return view('tailor.customer.index', compact('customers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tailor.customer.create');
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
            'customer_name'         => 'required|string',
            'mobile_no'       => 'required',
            'balance'       => 'nullable|min:0',
            'address'       => 'nullable'
        ]);



        if ($request->balance_status) {
            $data['balance'] = $request->balance ?? 0;
        }else{
            $data['balance'] = -1 * $request->balance ?? 0;
        }

        //Insert
        Customer::create($data);
        // view
        return redirect()->back()->withSuccess('Customer create successfully.');
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
        $customer = Customer::findOrFail($id);
        // view
        return view('tailor.customer.edit', compact('customer'));
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
        $customer = Customer::findOrFail($id);

        // validation
        $data = $request->validate([
            'customer_name'         => 'required|string',
            'mobile_no'       => 'required',
            'balance'       => 'nullable|min:0',
            'address'       => 'nullable'
        ]);

        if ($request->balance_status) {
            $data['balance'] = $request->balance ?? 0;
        } else {
            $data['balance'] = -1 * $request->balance ?? 0;
        }
        // update
        $customer->update($data);

        // view with message
        return redirect()->route('customer.index')->with('success', 'Customer has been updated successfully.');
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
        $customer = Customer::findOrFail($id);

        // view
        if ($customer->delete()) {
            return redirect()->route('customer.index')->withSuccess('Customer deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete customer.');
        }
    }
}
