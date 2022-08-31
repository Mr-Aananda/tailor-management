<?php

namespace App\Http\Controllers\tailor;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\PaymentDetails;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class DuePaymentController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $paymentDetails_query = PaymentDetails::with('customerOrder')->latest();
        $customerOrders_query = CustomerOrder::with('paymentDetails')->whereHas('paymentDetails')->latest();

        if (request()->search) {
            // set date
            $date = [];

            // set date
            if (request()->form_date != null) {
                $date[] = date(request()->form_date).' 00:00:00';

                if (request()->to_date != null) {
                    $date[] = date(request()->to_date).' 23:59:59';
                } else {
                    if (request()->form_date != null) {
                        $date[] = date('Y-m-d').' 23:59:59';
                    }
                }


                if (count($date) > 0) {
                    $customerOrders_query = $customerOrders_query->whereBetween('date', $date);
                }
            }
        }
        // Search by Mobile no
        if (request('mobile_no')) {
            $customerOrders_query->whereHas('customer', function( $query){
                $query->where('mobile_no', 'like', '%' . request('mobile_no') . '%');
            }) ;
        }

        if (request('order_no')) {
            $customerOrders_query->where('order_no', 'like', '%' . request('order_no') . '%');
        }

        // get data
       $customerOrders = $customerOrders_query->paginate($this->paginate);

        return view('tailor.due-payments.index', compact('customerOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('tailor.due-payments.create', compact('paymentTypes', 'customerOrder'));
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
        $customer_order = CustomerOrder::findOrFail($request->customer_order_id);
        $customer = Customer::findOrFail($customer_order->customer_id);
        $data = $request->validate([
            'customer_order_id' => 'required',
            'date'         => 'required',
            'payment_type' => 'required',
            'total_paid' => 'required',
            'cash_id' => 'required',
            'adjustment'         => 'nullable',
            'description'       => 'nullable'
        ]);
        $data['adjustment'] = $data['adjustment'] ?? 0;
        $data['customer_id'] = $customer->id;
        //Insert
        $data=PaymentDetails::create($data);

        //update customer balance start
         $customerBalance = $customer->balance;
         $customerTotalPaid= $request->total_paid;
         $customerUpdateBalance = $customerBalance - $customerTotalPaid;

        $customer->update([
            'balance' => $customerUpdateBalance
        ]);

        //update customer balance end
        $amount = $request->total_paid;
        if ($amount) {
            if ($request->payment_type === 'cash'
            ) {
                $cash = Cash::find($request->cash_id);
                $cash->increment('balance', $amount);
            }
        }

        // view
        return redirect()->back()->withSuccess('Payment recieved successfully.');
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
        $paymentDetails = PaymentDetails::where('customer_order_id',$id)->get()->last();
        // $paymentTypes = PaymentType::all();
        $cashes = Cash::all();
        // view
        return view('tailor.due-payments.edit', compact('paymentDetails','cashes'));
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
        $paymentDetails = PaymentDetails::findOrFail($id);
        // $customer = Customer::findOrFail($paymentDetails->customer_id);

        // validation
        $data = $request->validate([

            'date'         => 'required',
            'payment_type' => 'required',
            'total_paid' => 'required',
            'adjustment'         => 'nullable',
            'description'       => 'nullable'
        ]);

        $total_paid = $request->total_paid;
        $previous_total_paid = $paymentDetails->total_paid;

        // update
        $paymentDetails->update($data);


        $increment = $total_paid - $previous_total_paid;

        Cash::where('id', $request->cash_id)->increment('balance', $increment);

        //update customer balance start
        // $customerBalance = $customer->balance;
        // $customerPreviousPaid = $paymentDetails->total_paid;
        // $customerTotalPaid = $request->total_paid;
        // if ($customerPreviousPaid >= $customerTotalPaid ) {
        //     $diffAmount = $customerPreviousPaid - $customerTotalPaid;

        //     $customerUpdateBalance = $customerBalance + $diffAmount;
        //     $customer->update([
        //         'balance' => $customerUpdateBalance
        //     ]);
        // }


        // view with message
        return redirect()->route('due-payments.index')->with('success', 'Payment has been updated successfully.');
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
        $paymentDetails = PaymentDetails::findOrFail($id);

        // view
        if ($paymentDetails->delete()) {
            return redirect()->route('due-payments.index')->withSuccess('Payment deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }

    public function paymentReceive($id)
    {
        $paymentTypes = PaymentType::all();
        $customerOrder = CustomerOrder::with('paymentDetails')->findOrFail($id);
        $cashes = Cash::all();

        return view('tailor.due-payments.create', compact('paymentTypes', 'customerOrder','cashes'));
    }


}
