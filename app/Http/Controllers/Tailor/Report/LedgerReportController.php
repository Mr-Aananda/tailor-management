<?php

namespace App\Http\Controllers\Tailor\Report;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Distribution;
use App\Models\PaymentDetails;
use App\Models\Worker;
use App\Models\WorkerSalary;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;


class LedgerReportController extends Controller
{
    private $paginate = 25;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerLedger()
    {
        $customers = Customer::orderBy('customer_name')->get();
        $customer_ledgers = [];
        $total_debit = 0;
        $total_credit = 0;
        $customer = '';
        $customer_balance = 0;

        //Eloquant search

        if (request()->search) {
            $customer = Customer::where('id', request()->customer_id)->first();
            $customer_balance = $customer->balance;

            $customer_ledgers = Search::add(PaymentDetails::whereBetween('date', [request()->form_date, request()->to_date])
                ->where('customer_id', request()->customer_id)
                ->where('total_paid', '>', 0)
                ->selectRaw("*, 'customer_order' as 'type'"))
                ->orderBy('created_at')
                ->add(CustomerOrder::whereBetween('date', [request()->form_date, request()->to_date])
                    ->where('customer_id', request()->customer_id)
                    ->selectRaw("*, 'payment_details' as 'type'"))
                ->orderBy('date')
                ->get();
        }

        foreach ($customer_ledgers as $ledger) {
            $total_debit += ($ledger->grand_total);
            $total_credit += ($ledger->total_paid);
        }

        return view('tailor.reports.customer-ledger', compact('customers', 'customer_ledgers', 'total_debit', 'total_credit', 'customer_balance'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function workerLedger()
    {
        $workers = Worker::orderBy('worker_name')->get();

        $worker_ledgers = [];
        $total_debit = 0;
        $total_credit = 0;
        $worker = '';
        $worker_balance = 0;

        if (request()->search) {
            $worker = Worker::where('id', request()->worker_id)->first();
            $worker_balance = $worker->balance;

            $worker_ledgers = Search::add(Distribution::with('orderDetails.item')->whereBetween('distribute_date', [request()->form_date, request()->to_date])
                ->where('worker_id', request()->worker_id)
                ->where('complete_date', '!=', null)
                ->selectRaw("*, 'complete_order' as 'type'"))
                ->orderBy('created_at')
                ->add(WorkerSalary::whereBetween('date', [request()->form_date, request()->to_date])
                    ->where('worker_id', request()->worker_id)
                    ->where('amount', '>', 0)
                    ->selectRaw("*, 'worker_payment' as 'type'"))
                ->orderBy('created_at')
                ->get();
        }

        foreach ($worker_ledgers as $ledger) {
            if ($ledger->type === 'complete_order') {
                $total_credit += ($ledger->orderDetails->item->worker_cost * $ledger->orderDetails->quantity);
            }

            $total_debit += ($ledger->amount);
        }

        return view('tailor.reports.worker-ledger', compact('worker_ledgers', 'workers', 'worker_balance', 'total_debit', 'total_credit'));
    }
}
