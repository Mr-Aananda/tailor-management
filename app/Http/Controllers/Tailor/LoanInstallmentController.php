<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\Loan;
use App\Models\LoanInstallment;
use Illuminate\Http\Request;

class LoanInstallmentController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loanInstallments = LoanInstallment::with('loan')->paginate($this->paginate);

        return view('tailor.loan-installment.index',compact('loanInstallments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $data = $request->validate([
            'loan_id' => 'required|integer',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'adjustment' => 'nullable|numeric',
            'cash_id'          => 'required|integer',
            'payment_type'     => 'required|string',
            'note' => 'nullable',
        ]);


        LoanInstallment::create($data);
        $total_amount = $request->amount + $request->adjustment;

        if ($request->payment_type == 'cash') {
            $cash = Cash::findOrFail($request->cash_id);
            $cash->increment('balance', $total_amount);
        }
        // view
        return redirect()->back()->withSuccess('Loan given successfully.');
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
         $loanInstallment = LoanInstallment::findOrFail($id);
        $cashes = Cash::all();
         return view('tailor.loan-installment.edit', compact('loanInstallment','cashes'));
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
        $loanInstallment = LoanInstallment::findOrFail($id);

        // validation
        $data = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'adjustment' => 'nullable|numeric',
            'cash_id'          => 'required|integer',
            'payment_type'     => 'required|string',
            'note' => 'nullable',
        ]);


        $amount = $request->amount ? $request->amount : 0.00;
        $adjustment = $request->adjustment ? $request->adjustment : 0.00;
        $previous_amount = $loanInstallment->amount;
        $previous_adjustment= $loanInstallment->adjustment;
        // update
        $loanInstallment->update($data);

        $amount_increment = $amount - $previous_amount;
        $adjustment_increment = $adjustment - $previous_adjustment;
        $increment = $amount_increment + $adjustment_increment;

        Cash::where('id', $request->cash_id)->increment('balance', $increment);

        // view with message
        return redirect()->back()->with('success', 'Loan has been updated successfully.');
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
        $loanInstallment = LoanInstallment::findOrFail($id);

        // view
        if ($loanInstallment->delete()) {
            return redirect()->back()->withSuccess('Loan deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }
}
