<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\Expense;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_order = CustomerOrder::with('paymentDetails')->get();
        $orderPending= $customer_order->where('status', '==', CustomerOrder::STATUS_PENDING)->all();
        $orderProcessing = $customer_order->where('status', '==', CustomerOrder::STATUS_PROCESSING)->all();
        $orderComplete = $customer_order->where('status', '==', CustomerOrder::STATUS_COMPLETE)->all();

        $totalPayment=0;
        $totalAdjustment=0;
        foreach ($customer_order as  $order) {

            $totalPayment+= $order->paymentDetails->sum("total_paid");
         $totalAdjustment+= $order->paymentDetails->sum("total_adjustment");
        }

        return view('tailor.dashboard',compact('customer_order', 'orderPending', 'orderProcessing', 'orderComplete', 'totalPayment'));
    }
}
