<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\AdvancedSalary;
use App\Models\AdvancedSalaryDetails;
use App\Models\Cash;
use App\Models\Employee;
use Illuminate\Http\Request;

class AdvancedSalaryController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $advanced_salaries = AdvancedSalary::with('advancedSalaryDetails.advancedSalaryPaidDetails')->paginate($this->paginate);

        // $total_advanced = $advanced_salaries->sum('amount');
        return view('tailor.payroll.advanced-salary.index', compact('advanced_salaries', 'employees'));
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
        return view('tailor.payroll.advanced-salary.create',compact('employees','cashes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exist = AdvancedSalary::where('employee_id', $request->employee_id)->first();
        //Validation
        if ($exist) {

            $advanced_salary_details_data = $request->validate([
                'date'           => 'required',
                'employee_id'      => 'required',
                'amount'         => 'required',
                'installment'      => 'nullable',
                'cash_id'      => 'nullable',
                'payment_type'      => 'required',
                'note'           => 'nullable'
            ]);

            $advanced_salary_details_data['advanced_salary_id'] = $exist->id;
            $advanced_salary_details_data['installment'] = $request->installment ?? 0;
            AdvancedSalaryDetails::create($advanced_salary_details_data);

            if ($request->payment_type == 'cash') {
                $cash = Cash::findOrFail($request->cash_id);
                $cash->decrement('balance', $request->amount);
            }
        }
        else{
            $advanced_salary_data = $request->validate([
                'employee_id' => 'required',
            ]);
            $advanced_salary = AdvancedSalary::create($advanced_salary_data);

            $advanced_salary_details_data = $request->validate([
                'date'           => 'required',
                'employee_id'      => 'required',
                'amount'         => 'required|numeric',
                'installment'      => 'nullable|numeric',
                'cash_id'      => 'nullable',
                'payment_type'      => 'required',
                'note'           => 'nullable'
            ]);

            $advanced_salary_details_data['advanced_salary_id'] = $advanced_salary->id;
            $advanced_salary_details_data['installment'] = $request->installment ?? 0;
            AdvancedSalaryDetails::create($advanced_salary_details_data);

            if ($request->payment_type == 'cash') {
                $cash = Cash::findOrFail($request->cash_id);
                $cash->decrement('balance', $request->amount);
            }
        }

        // view
        return redirect()->back()->withSuccess('Advanced create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advanced_salary_details = AdvancedSalaryDetails::where('advanced_salary_id', $id)->get();
        $employee = Employee::where('id', $advanced_salary_details->first()->advancedSalary->employee->id)->first();
        return view('tailor.payroll.advanced-salary.show', compact('advanced_salary_details', 'employee'));
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
        $advanced_salary_details = AdvancedSalaryDetails::findOrFail($id);
        $cashes = Cash::all();
        // view
        return view('tailor.payroll.advanced-salary.edit', compact('advanced_salary_details','cashes'));
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
        $advanced_salary_details = AdvancedSalaryDetails::findOrFail($id);
        // return $request->all();
        $advanced_salary_details_data = $request->validate([
            'amount' => 'required|numeric',
            'cash_id'          => 'required',
            'payment_type'     => 'required|string',
            'installment' => 'required|numeric',
            'note' => 'nullable',
        ]);

        $amount = $request->amount ? $request->amount : 0.00;
        $previous_amount = $advanced_salary_details->amount;

        $advanced_salary_details->update($advanced_salary_details_data);

        $decrement = $amount - $previous_amount;

        Cash::where('id', $request->cash_id)->decrement('balance', $decrement);

        // view with message
        return redirect()->route('advanced-salary.index', $advanced_salary_details->advancedSalary->id)->with('success', 'Advanced salary has been updated successfully.');
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
        $advanced_salary_details = AdvancedSalaryDetails::findOrFail($id);

        // view
        if ($advanced_salary_details->delete()) {
            return redirect()->route('advanced-salary.index', $advanced_salary_details->advancedSalary->id)->withSuccess('Advanced salary deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete advanced salary.');
        }
    }
}
