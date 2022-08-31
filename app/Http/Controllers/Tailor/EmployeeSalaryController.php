<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\AdvancedSalary;
use App\Models\Cash;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeSalaryController extends Controller
{
    private $paginate = 25;
    private $errors = false;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get user Those salary is given in previous month
           $paidEmployee = Employee::whereHas('employeeSalaries', function ($query) {
            $query->where('salary_month', '>', Carbon::today()->subMonth()->subDay(31));
        })->get();

        // in last month salary given user create a column last_month_paid_status = true
        $paidEmployee->map(function ($employee) {
            return $employee['last_month_paid_status'] = true;
        });

        // get user Those salary is not given in previous month
        $unpaidEmployee = Employee::whereDoesntHave('employeeSalaries')->orWhereHas('employeeSalaries', function ($query) {
            $query->where('salary_month', '<', Carbon::today()->subMonth()->subDay(1));
        })->get();

        // in last month salary is not given user create a column last_month_paid_status = false
        $unpaidEmployee->map(function ($employee) {
            return $employee['last_month_paid_status'] = false;
        });

        // get all user those salary given & is not given
        $employees = $unpaidEmployee->merge($paidEmployee)->sortBy('created_at');

        // if search for salary in selected month
        if (request()->search) {
            // add day 01 in requested month
            $month = request()->month . '-' . '01';
            // get user where slary is given in requested month
            $paidEmployee = Employee::whereHas('employeeSalaries', function ($query) use ($month) {
                $query->where('salary_month', $month);
            })->get();

            // in last month salary given user create a column last_month_paid_status = true
            $paidEmployee->map(function ($employee) {
                return $employee['last_month_paid_status'] = true;
            });

            // get user where slary is not given in requested month
            $unpaidEmployee = Employee::whereDoesntHave('employeeSalaries')->orWhereHas('employeeSalaries', function ($query) use ($month) {
                $query->where('salary_month', '!=', $month);
            })->get();

            // get user where slary is not given in requested month
            $unpaidEmployee->map(function ($employee) {
                return $employee['last_month_paid_status'] = false;
            });

            // merge paid user and unpaid user
            $employees = $unpaidEmployee->merge($paidEmployee)->sortBy('created_at');

            $employee_id = $employees->pluck('id')->all();
        }

        return view('tailor.payroll.employee-salary.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $records = collect([]);
         $records['employees'] = Employee::all();
         $cashes = Cash::all();

        return view('tailor.payroll.employee-salary.create', compact('records','cashes'));
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
        DB::transaction(function () use($request) {
            // add day in requested year & amont
            $modify_year_month = $request->salary_month . '-' . '01';
            // get month for request user
            $exist = EmployeeSalary::where('salary_month', $modify_year_month)->where('employee_id', $request->employee_id)->first();
            if ($exist) {
                // return redirect()->back()->withErrors('Salary already given.');
                $this->errors = true;
                $this->messages = 'Salary already given.';
            }
           else{
                //Validation
                $salary_info = $request->validate([
                    'employee_id'               => 'required|integer',
                    'salary_month'              => 'required',
                    'given_date'                => 'required',
                    'cash_id'                   => 'nullable',
                    'payment_type'              => 'required',
                ]);

                // add day in requested year & amont
                $salary_info['salary_month'] = $modify_year_month;

                //Insert
                $employee_salary = EmployeeSalary::create($salary_info);

                $bonusAmount = ($request->bonus * $request->basic_salary) / 100;
                $total_amount = ($request->basic_salary + $bonusAmount) - ($request->installments + $request->deductions);

                if ($request->payment_type == 'cash') {

                    $cash = Cash::find($request->cash_id);
                    //            return response($cash, 200);
                    $cash->decrement('balance', $total_amount);
                }

                // validation salary details
                $employeeSalaryDetails = $request->validate([

                    'basic_salary' => 'required|numeric',
                    'bonus' => 'nullable|numeric|min:1|max:100',
                    'installments' => 'required|numeric',
                    'deductions' => 'nullable',
                ]);
                // find requested user
                $employee = Employee::find($request->employee_id);
                // get installment amount
                $installment_amount = $request->installments;

                // if has advanced salaries
                if ($installment_amount > 0) {
                    // get advanced salaries where is paid is 0 or false
                    $advancedSalaries = $employee->advancedSalaries->advancedSalaryDetails->filter(function ($item) {
                        return !$item->is_paid;
                    });

                    foreach ($advancedSalaries as  $details) {
                        // if installment amount is smaller than first advances salaries due
                        if ($installment_amount < $details->total_due) {
                            $details->advancedSalaryPaidDetails()->create([
                                'installment_pay' => $installment_amount,
                            ]);
                            break;
                        } else {
                            // if installment amount is bigger than first advances salaries due
                            $details->advancedSalaryPaidDetails()->create([
                                'installment_pay' => $details->total_due,
                            ]);
                            // if installment amount & advanced due amount is equal then is_paid is 1 or true
                            $details->is_paid = true;
                            $details->save(); // save installment paid details
                            // then intallment amount is subtract paid amount
                            $installment_amount = $installment_amount - $details->total_due;
                        }
                    }
                }

                // salary details save
                foreach ($employeeSalaryDetails as $key => $value) {
                    $basicSalary = $request->basic_salary;
                    $totalBonus = ($request->bonus*$basicSalary)/100;
                    if ($value > 0) {
                        if ($key == 'installments') {
                            $employee_salary->employeeSalaryDetails()->create([
                                'purpose' => $key,
                                'dtls_amount' => $value,
                                'type' => 'decrement',
                            ]);
                        } elseif ($key == 'deductions') {
                            $employee_salary->employeeSalaryDetails()->create([
                                'purpose' => $key,
                                'dtls_amount' => $value,
                                'type' => 'decrement',
                            ]);
                        } elseif ($key == 'bonus') {
                            $employee_salary->employeeSalaryDetails()->create([
                                'purpose' => $key,
                                'dtls_amount' => $totalBonus,
                                'type' => 'increment',
                            ]);
                        } else {
                            $employee_salary->employeeSalaryDetails()->create([
                                'purpose' => $key,
                                'dtls_amount' => $value,
                                'type' => 'increment',
                            ]);
                        }
                    }
                }
           }
        });

        if ($this->errors) {
            return redirect()->back()->withErrors($this->messages);
        } else {
            return redirect()->back()->withSuccess('Salary given successfully.');
        }

        // view
        // return redirect()->back()->withSuccess('Salary given successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employeeSalary = EmployeeSalary::with('employeeSalaryDetails')->find($id);

        $employeeSalary["increment"] = $employeeSalary->employeeSalaryDetails->where("type", "increment")->sum("dtls_amount");
        $employeeSalary["decrement"] = $employeeSalary->employeeSalaryDetails->where("type", "decrement")->sum("dtls_amount");

        $employeeSalary["basic_salary"] = $employeeSalary->employeeSalaryDetails->where('purpose', 'basic_salary')->first();
        $employeeSalary["bonus"] = $employeeSalary->employeeSalaryDetails->where('purpose', 'bonus')->first();
        $employeeSalary["installments"] = $employeeSalary->employeeSalaryDetails->where('purpose', 'installments')->first();
        $employeeSalary["deductions"] = $employeeSalary->employeeSalaryDetails->where('purpose', 'deductions')->first();

        return view('tailor.payroll.employee-salary.show', compact('employeeSalary'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employeeSalary = EmployeeSalary::with('employeeSalaryDetails')->findOrFail($id);
        $records = collect([]);
        $records['employees'] = Employee::all();
        $cashes = Cash::all();

        $employeeSalary["increment"] = $employeeSalary->employeeSalaryDetails->where("type", "increment")->sum("dtls_amount");
        $employeeSalary["decrement"] = $employeeSalary->employeeSalaryDetails->where("type", "decrement")->sum("dtls_amount");

        $employeeSalary["basic_salary"] = $employeeSalary->employeeSalaryDetails->where('purpose', 'basic_salary')->first();
        $employeeSalary["bonus"] = $employeeSalary->employeeSalaryDetails->where('purpose', 'bonus')->first();
        $employeeSalary["installments"] = $employeeSalary->employeeSalaryDetails->where('purpose', 'installments')->first();
        $employeeSalary["deductions"] = $employeeSalary->employeeSalaryDetails->where('purpose', 'deductions')->first();


        return view('tailor.payroll.employee-salary.edit', compact('employeeSalary', 'records','cashes'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function salaryDetails(Request $request)
    // {
    //     $basicSalary = Employee::where('id', $request->id)
    //         ->with(['advancedSalaries.advancedSalaryDetails' => function ($query) {
    //             $query->where('is_paid', 0);
    //         }, 'advancedSalaries.advancedSalaryDetails.advancedSalaryPaidDetails'])->with('metas')->first();

    //     return response()->json($basicSalary, 200);
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function salaryPay($id)
    {
        // $employee = Employee::with('advancedSalaries')->find($id);
        $records = collect([]);
        $records['employees'] = Employee::all();
        $cashes = Cash::all();

        return view('tailor.payroll.employee-salary.create', compact( 'records','cashes'));
    }

    /**
     *
     * React component method for get all employee details
     *
     */
    public function getEmployeeDetailsbyId()
    {

        $total_paid_query = AdvancedSalary::query()
        ->join('advanced_salary_details', function($join){
            $join->on('advanced_salaries.id', '=', 'advanced_salary_details.advanced_salary_id')
            ->where('advanced_salary_details.is_paid', 0);
        })
        ->join('advanced_salary_paid_details', function($join){
            $join->on('advanced_salary_details.id', '=', 'advanced_salary_paid_details.advanced_salary_details_id');
        })
        ->groupBy('advanced_salaries.employee_id')
        ->selectRaw('advanced_salaries.employee_id, SUM(advanced_salary_paid_details.installment_pay) as total_paid');

        return Employee::where('id', '=', request()->id)
        ->addSelect([
            'total_installment_sum' => AdvancedSalary::query()
            ->whereColumn('advanced_salaries.employee_id', 'employees.id')
            ->join('advanced_salary_details', function($join){
                $join->on('advanced_salaries.id', '=', 'advanced_salary_details.advanced_salary_id')
                ->where('is_paid', 0);
            })
            ->selectRaw('
                CASE
                    WHEN SUM(advanced_salary_details.installment) IS NULL
                        THEN 0
                    ELSE
                        SUM(advanced_salary_details.installment)
                END
            as total_installment_sum
            '),
            'total_advanced_sum' => AdvancedSalary::query()
                ->whereColumn('advanced_salaries.employee_id', 'employees.id')
                ->join('advanced_salary_details', function ($join) {
                    $join->on('advanced_salaries.id', '=', 'advanced_salary_details.advanced_salary_id')
                        ->where('is_paid', 0);
                })
                ->leftJoinSub($total_paid_query, 'total_paid_query', function($join){
                    $join->on('advanced_salaries.employee_id', '=', 'total_paid_query.employee_id');
                })
                ->groupBy('advanced_salary_details.amount')
                ->groupBy('total_paid_query.total_paid')
                ->selectRaw('
                (
                    CASE
                    WHEN SUM(advanced_salary_details.amount) IS NULL
                        THEN 0
                    ELSE
                        SUM(advanced_salary_details.amount)
                    END
                    -
                    CASE
                    WHEN total_paid_query.total_paid IS NULL
                        THEN 0
                    ELSE
                        total_paid_query.total_paid
                    END

                 )
                 as
                  total_advanced_sum
                ')

        ])
        // ->join('advanced_salaries', function($join){
        //     $join->on('employees.id', '=', 'advanced_salaries.employee_id');
        // })
        // ->join('advanced_salary_details', function ($join) {
        //     $join->on('advanced_salaries.id', '=', 'advanced_salary_details.advanced_salary_id')
        //         ->where('is_paid', 0);
        // })
        // ->leftJoin('advanced_salary_paid_details', function ($join) {
        //     $join->on('advanced_salary_details.id', '=', 'advanced_salary_paid_details.advanced_salary_details_id');
        // })
        // ->select('employees.*')
        // ->selectRaw('SUM(advanced_salary_details.amount) as total_advanced')
        ->first();
    }
}
