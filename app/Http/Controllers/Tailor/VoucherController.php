<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::paginate($this->paginate);
        return view('tailor.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // generate a pin based on 2 * 3 digits + two random character
        $pin =mt_rand(100, 999)
            . $characters[rand(0, strlen($characters) - 1)]
            . mt_rand(100, 999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        // $random_voucher_number ="D-" . str_shuffle($pin);
        $random_voucher_number = str_shuffle($pin);

        return view('tailor.voucher.create',compact('random_voucher_number'));
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
            'voucher_number' => 'required|string',
            'discount_type' => 'required|string',
            'discount' => 'required',
            'description'       => 'nullable'
        ]);
        //Insert
        Voucher::create($data);
        // view
        return redirect()->back()->withSuccess('Voucher create successfully.');
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
        $voucher = Voucher::findOrFail($id);
        // view
        return view('tailor.voucher.edit', compact('voucher'));
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
        $voucher = Voucher::findOrFail($id);

        // validation
        $data = $request->validate([
            'name'         => 'required|string',
            'voucher_number' => 'required|string',
            'discount_type' => 'required|string',
            'discount' => 'required',
            'description'       => 'nullable'
        ]);
        // update
        $voucher->update($data);

        // view with message
        return redirect()->route('voucher.index')->with('success', 'Voucher has been updated successfully.');
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
        $voucher = Voucher::findOrFail($id);

        // view
        if ($voucher->delete()) {
            return redirect()->route('voucher.index')->withSuccess('Voucher deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete voucher.');
        }
    }

    /**
     *
     * react component method for check voucher number or name
     *
     */

    public function getVouchernumberOrname()
    {
        return Voucher::where('voucher_number', '=', request()->voucher_or_name)
        ->orWhere('name', '=', request()->voucher_or_name)
        ->firstOrFail();
    }
}
