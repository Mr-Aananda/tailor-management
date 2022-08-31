<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\Employee;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $loans = Loan::query()
            ->withCount('loanInstallments')
            ->addAdjustment()
            ->addPaid()
            ->addDue()
            ->paginate($this->paginate);
        return view('tailor.loan.index',compact('loans'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        $cashes = Cash::all();
        return view('tailor.loan.create',compact('employees','cashes'));
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
            'date'             => 'required',
            'employee_id'      => 'required',
            'amount'           => 'required|numeric',
            'expire_date'      => 'required',
            'cash_id'          => 'required',
            'payment_type'     => 'required|string',
            'note'             => 'nullable'
        ]);
        //Insert
        Loan::create($data);

        if ($request->payment_type == 'cash') {
            $cash = Cash::findOrFail($request->cash_id);
            $cash->decrement('balance', $request->amount);
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
        // get the specified resource
        $loan = Loan::findOrFail($id);
        return view('tailor.loan.show', compact('loan'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loanPaid($id)
    {
        // get the specified resource
        $loan = Loan::findOrFail($id);
        $cashes = Cash::all();
        return view('tailor.loan.loan-paid', compact('loan', 'cashes'));
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
        $loan = Loan::findOrFail($id);
        $employees = Employee::all();
        $cashes = Cash::all();

        return view('tailor.loan.edit', compact('employees', 'cashes','loan'));
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
        $loan = Loan::findOrFail($id);

        // validation
        $data = $request->validate([
            'date'             => 'required',
            'employee_id'      => 'required',
            'amount'           => 'required|numeric',
            'expire_date'      => 'required',
            'cash_id'          => 'required',
            'payment_type'     => 'required|string',
            'note'             => 'nullable'
        ]);


        $amount = $request->amount ? $request->amount : 0.00;
        $previous_amount= $loan->amount;
        // update
        $loan->update($data);

        $decrement = $amount - $previous_amount;

        Cash::where('id', $request->cash_id)->decrement('balance', $decrement);

        // view with message
        return redirect()->route('loan.index')->with('success', 'Loan has been updated successfully.');
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
        $loan = Loan::findOrFail($id);

        // view
        if ($loan->delete()) {
            return redirect()->route('loan.index')->withSuccess('Loan deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }
}
