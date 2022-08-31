<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeContoller extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate($this->paginate);
        return view('tailor.employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees_role = config('tailor.employees_role');
        return view('tailor.employee.create', compact('employees_role'));
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
            'employee_name'         => 'required|string',
            'employee_role'         => 'required|string',
            'mobile_no'       => 'required',
            'basic_salary'       => 'required',
            'nid_number'       => 'nullable',
            'address'       => 'nullable',
            'description'       => 'nullable'
        ]);

        //Insert
        Employee::create($data);
        // view
        return redirect()->back()->withSuccess('Employee create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('tailor.employee.show', compact('employee'));
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
        $employee = Employee::findOrFail($id);
        $employees_role = config('tailor.employees_role');
        // view
        return view('tailor.employee.edit', compact('employees_role', 'employee'));
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
        $employee = Employee::findOrFail($id);

        // validation
        $data = $request->validate([
            'employee_name'         => 'required|string',
            'employee_role'         => 'required|string',
            'mobile_no'       => 'required',
            'basic_salary'       => 'required',
            'nid_number'       => 'nullable',
            'address'       => 'nullable',
            'description'       => 'nullable'
        ]);
        // update
        $employee->update($data);

        // view with message
        return redirect()->route('employee.index')->with('success', 'Employee has been updated successfully.');
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
        $employee = Employee::findOrFail($id);

        // view
        if ($employee->delete()) {
            return redirect()->route('employee.index')->withSuccess('Employee deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete employee.');
        }
    }
}
