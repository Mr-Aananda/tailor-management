<?php

namespace App\Http\Controllers\tailor;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\Distribution;
use App\Models\ItemWorker;
use App\Models\OrderDetails;
use App\Models\PaymentDetails;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistributionController extends Controller
{
    private $paginate = 25;
    private $messages;
    private $errors = false;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $distributions_query = Distribution::with('worker','orderDetails')->latest();

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
                    $distributions_query = $distributions_query->whereBetween('distribute_date', $date);
                }
            }
        }

        //Search by order no
        if (request('order_no')) {
            $distributions_query->whereHas('orderDetails.customerOrder', function ($query) {
                $query->where('order_no', request('order_no'));
            });
        }

        //Search by worker name
        if (request('worker_name')) {
            $distributions_query->whereHas('worker', function ($query) {
                $query->where('worker_name', 'like', '%' . request('worker_name') . '%');
            });
        }

        //search by status
        if (request('status')) {
            $distributions_query->where('status', request('status'));
        }
        // get data
        $distributions = $distributions_query->paginate($this->paginate);

        return view('tailor.distribution.index',compact('distributions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $customer_orders = CustomerOrder::with('orderDetails')->whereHas('orderDetails',function($query){
        //     $query->where('status', OrderDetails::STATUS_PENDING);

        //  })
        $orderDetails = OrderDetails::with('customerOrder')
        ->where('status',OrderDetails::STATUS_PENDING)
        ->whereHas('customerOrder') //for soft deleted, here data show without softdeleted for this query
        ->latest()
        ->paginate($this->paginate);
        $workers = Worker::all();
        return view('tailor.distribution.create', compact('orderDetails', 'workers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $item_id = OrderDetails::findOrFail($request->order_details_id)->item_id;

        $exits = ItemWorker::where('worker_id', $request->worker_id)->where('item_id', $item_id)->first();

        if($exits){
            //Validation
            $data = $request->validate([
                'order_details_id'         => 'required',
                'distribute_date'       => 'required',
                'worker_id'         => 'required',
            ]);

            $order_details = OrderDetails::with('customerOrder')
                ->find($request->order_details_id);

            //Order details update
            $order_details->update([
                'status' => OrderDetails::STATUS_PROCESSING
            ]);

            //customer status update
            if ($order_details->customerOrder->status != CustomerOrder::STATUS_PROCESSING) {
                $order_details->customerOrder->update([
                    'status' => CustomerOrder::STATUS_PROCESSING
                ]);
            }

            $data['status'] = Distribution::STATUS_PROCESSING;  //Distribuiton status updated
            //Insert
            Distribution::create($data);

            // view
            return redirect()->back()->withSuccess('Order distribute successfully.');
        }
        else
        {
            return redirect()->back()->withErrors('please select valid worker');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distribution = Distribution::with('orderDetails.employee')->findOrFail($id);
        // view
        return view('tailor.distribution.show', compact('distribution'));
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
        $distribution = Distribution::findOrFail($id);
        $workers = Worker::all();
        // view
        return view('tailor.distribution.edit', compact('distribution','workers'));
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
        $distribution = Distribution::findOrFail($id);

        // validation
        $data = $request->validate([
            'distribute_date'       => 'required',
            'worker_id'         => 'required',
        ]);
        // update
        $distribution->update($data);

        // view with message
        return redirect()->route('distribution.index')->with('success', 'Distribution has been updated successfully.');
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
        $distribution = Distribution::findOrFail($id);

        // view
        if ($distribution->delete()) {
            return redirect()->route('distribution.index')->withSuccess('Distribution deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }

    public function statusChangeToComplete(Request $request, $id)
    {
        $distribution = Distribution::with('orderDetails.customerOrder')->findOrFail($id);

        DB::transaction(function () use ($distribution,$request){

            //Distribution status update to complete
            if ($distribution->status != Distribution::STATUS_COMPLETE) {
                if($request->complete_date) {
                    $distribution->update([
                        'complete_date' => $request->complete_date,
                        'status' => Distribution::STATUS_COMPLETE
                    ]);

                    // worker balance update start
                    $worker_amount = $distribution->orderDetails->item->worker_cost * $distribution->orderDetails->quantity;
                    Worker::findOrFail($distribution->worker_id)->decrement('balance', $worker_amount);
                    // worker balance update end

                    $this->errors = false;
                    $this->messages = 'Order Complete successfully!';
                }else{
                    $this->errors = true;
                    $this->messages = 'Complate date not given!';
                }

            }
            else{
                $distribution->update([
                    'complete_date' => null,
                    'status' => Distribution::STATUS_PROCESSING
                ]);

                // worker balance update start
                $worker_amount = $distribution->orderDetails->item->worker_cost * $distribution->orderDetails->quantity;
                Worker::findOrFail($distribution->worker_id)->increment('balance', $worker_amount);
                 // worker balance update end

                $this->errors = false;
                $this->messages = 'Order has not yet been completed!';
            }


            //Order details status update to complete
          if ($distribution->orderDetails->status != OrderDetails::STATUS_COMPLETE) {
                $distribution->orderDetails->update([
                    'status' => OrderDetails::STATUS_COMPLETE
                ]);
          }
          else {
                $distribution->orderDetails->update([
                    'status' => OrderDetails::STATUS_PROCESSING
                ]);
            }

            //Customer Order status update to complete
            $is_all_order_details_complete = $distribution->orderDetails
            ->customerOrder
            ->orderDetails
            ->every(function ($_order_details) {
                return $_order_details->status == OrderDetails::STATUS_COMPLETE;
            });

            if ($is_all_order_details_complete) {

                $distribution->orderDetails->customerOrder->update([
                        'status' => CustomerOrder::STATUS_COMPLETE
                    ]);
            }
            else {
                $distribution->orderDetails->customerOrder->update([
                    'status' => CustomerOrder::STATUS_PROCESSING

                ]);
            }

        });
        if($this->errors) {
            return redirect()->back()->withErrors($this->messages);
        }else{
            return redirect()->back()->withSuccess($this->messages);
        }

    }
}
