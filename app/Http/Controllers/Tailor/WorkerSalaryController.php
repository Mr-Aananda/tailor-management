<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\Distribution;
use App\Models\Worker;
use App\Models\WorkerSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WorkerSalaryController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $worker_salaries_query = WorkerSalary::with('worker.distributions');
        $workers = Worker::all();

        if (request()->search) {
            // set date
            $date = [];

            // set date
            if (request()->form_date != null) {
                $date[] = date(request()->form_date);

                if (request()->to_date != null) {
                    $date[] = date(request()->to_date);
                } else {
                    if (request()->form_date != null) {
                        $date[] = date('Y-m-d');
                    }
                }

                if (count($date) > 0) {
                    $worker_salaries_query = $worker_salaries_query->whereBetween('date', $date);
                }
            }
        }

        if (request('worker_name')) {
            $worker_salaries_query->whereHas('worker', function ($query) {
                $query->where('worker_name', 'like', '%' . request('worker_name') . '%');
            });
        }

        // get data
        $worker_salaries = $worker_salaries_query->paginate($this->paginate);


        return view('tailor.payroll.worker-salary.index', compact('worker_salaries','workers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workers = Worker::all();
        $cashes = Cash::all();
        $distributions = Distribution::where('complete_date','!=', null)->with('orderDetails.item')->get();

        return view('tailor.payroll.worker-salary.create',compact('workers', 'distributions','cashes'));
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
            'date'           => 'required',
            'worker_id'      => 'required',
            'amount'         => 'nullable|numeric',
            'cash_id'        => 'nullable',
            'payment_type'   => 'required',
            'bonus'          => 'nullable|numeric|min:1|max:100',
            'bonus_amount'   => 'nullable|numeric',
            'form_date'      => 'nullable',
            'to_date'        => 'nullable',
            'note'           => 'nullable'
        ]);
        $data['amount'] = $request->amount ?? 0;
        $data['bonus'] = $request->bonus ?? 0;
        $data['bonus_amount'] = $request->bonus_amount ?? 0;

        //Insert
        $worker_salary= WorkerSalary::create($data);

        //Cash update start
        $total_amount = ($request->amount + $worker_salary->bonus_amount);

        if ($request->payment_type == 'cash') {
            $cash = Cash::findOrFail($request->cash_id);
            $cash->decrement('balance', $total_amount);
        }
         //Cash update end

        //worker balance update start
        $update_worker_balance = $request->amount ?  $request->amount : 0;

        Worker::findOrFail($request->worker_id)->increment('balance', $update_worker_balance);
         //worker balance update start

        // view
        return redirect()->back()->withSuccess('Worker payment given successfully.');
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
        $worker_salary = WorkerSalary::findOrFail($id);
        $workers = Worker::all();
        $cashes = Cash::all();
        // view
        return view('tailor.payroll.worker-salary.edit', compact('worker_salary', 'workers','cashes'));
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
        $worker_salary = WorkerSalary::findOrFail($id);

        // validation
        $data = $request->validate([
            'date'           => 'required',
            'worker_id'      => 'required',
            'amount'         => 'required|numeric',
            'cash_id'        => 'nullable',
            'payment_type'   => 'required',
            'bonus'          => 'nullable|numeric|min:1|max:100',
            'bonus_amount'   => 'nullable|numeric',
            'form_date'      => 'nullable',
            'to_date'        => 'nullable',
            'note'           => 'nullable'
        ]);

        $data['amount'] = $request->amount ?? 0;
        $data['bonus'] = $request->bonus ?? 0;
        $data['bonus_amount'] = $request->bonus_amount ?? 0;

         // variable for cash balance update
        $total_paid = $request->amount;
        $total_bonus_amount = $request->bonus_amount;
        $previous_total_paid = $worker_salary->amount;
        $previous_total_bonus_amount = $worker_salary->bonus_amount;

        // variable for worker balance update
        $update_worker_balance = $request->amount;
        $previous_update_worker_balance = $worker_salary->amount;

        // update
        $worker_salary->update($data);

        //Cash balance update
        $increment_total_paid = $previous_total_paid - $total_paid;
        $increment_total_bonus_amount = $total_bonus_amount - $previous_total_bonus_amount;
        $increment_all = $increment_total_paid + $increment_total_bonus_amount;

        Cash::where('id', $request->cash_id)->increment('balance', $increment_all);

        //Worker balance update
        $new_update_worker_balance = $previous_update_worker_balance - $update_worker_balance;
        Worker::where('id', $request->worker_id)->decrement('balance', $new_update_worker_balance);

        // view with message
        return redirect()->route('worker-salary.index')->with('success', 'Worker payment has been updated successfully.');
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
     *
     * React component method for get all distribution with complete
     *
     */
    public function getItemsCostbyId()
    {
        $balance = Worker::find(request('id'))->balance;

        return [
            'total_payable' => abs($balance),
            'status'=> $balance >= 0 ? "Rec":"Pay"
        ];

        // return Distribution::query()
        // ->workerPayableAmount(request()->id)
        // ->first()
        //  ?? [
        //     'total_payable' => '0'
        // ]
        // ;

    }

    /**
     *
     * React component method for get all distribution with complete
     *
     */
    public function getDistributeCompleteData(Request $request)
    {
        $worker_id = $request->worker_id;
        $form_date = date($request->formDate);
        $to_date = date($request->toDate);

        return Distribution::query()->totalDistributeAmount($worker_id, $form_date, $to_date)
        ->first()
        ?? [
            'total_distribute_amount' => '0'
        ];

    }
}
