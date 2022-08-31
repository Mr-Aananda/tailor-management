<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Design;
use App\Models\Employee;
use App\Models\Fitting;
use App\Models\Image;
use App\Models\Item;
use App\Models\OrderDetails;
use App\Models\PaymentDetails;
use App\Models\PaymentType;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerOrderController extends Controller
{
    private $paginate = 25;
    private $customer_order;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerOrders_query = CustomerOrder::with('customer','user', 'orderDetails')->latest();

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
                    $customerOrders_query = $customerOrders_query->whereBetween('date', $date);
                }
            }
        }
        //Search by Mobile no
        // if (request('mobile_no')) {
        //     $customerOrders_query->where('mobile_no', 'like', '%' . request('mobile_no') . '%');
        // }

        if (request('mobile_no')) {
            $customerOrders_query->whereHas('customer', function ($query) {
                $query->where('mobile_no', request('mobile_no'));
            });
        }

        //Search by Order no
        if (request('order_no')) {
            $customerOrders_query->where('order_no', request('order_no'));
        }

        //search by status

        if(request('status')) {
            $customerOrders_query->where('status', request('status'));
        }

        // get data
         $customerOrders = $customerOrders_query->paginate($this->paginate);
        return view('tailor.customer-order.index', compact('customerOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        $designs = Design::all();
        $fittings = Fitting::all();
        $cashes = Cash::all();
        $paymentTypes = PaymentType::all();
        $discountTypes = config('tailor.discountType');
        $images = Image::all();
        $customers = Customer::all();
        // $order_no = "D." . str_pad(CustomerOrder::max('id') + 1, 4, '0', STR_PAD_LEFT);
        $vouchers = Voucher::all();
        $employees = Employee::where('employee_role', 'Master')->get();
        $previousOrders = OrderDetails::with('customerOrder', 'item')->get();

        return view('tailor.customer-order.create', compact('items', 'designs', 'fittings', 'paymentTypes', 'discountTypes', 'images','customers','cashes','vouchers', 'employees', 'previousOrders'));
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
        //validation
       $request->validate([

            //Customer information
            'date' => 'required',
            'order_no' => 'required',
            'delivery_date' => 'required',
            'customer_name' => 'nullable|string',
            'mobile_no' => 'nullable|string',
            'address' => 'nullable|string',
            'discount_type' => 'nullable|string',
            'sub_total' => 'numeric',
            'discount' => 'nullable|numeric',


            'allData.*.item_id' => 'required',
            'allData.*.image_id' => 'nullable',
            'allData.*.master_id' => 'required',
            'allData.*.design_ids.*' => 'required',
            'allData.*.fitting_id' => 'required',
            'allData.*.quantity' => 'required',

            //upper part
            'allData.*.upper_length' => 'nullable',
            'allData.*.round_body' => 'nullable',
            'allData.*.belly' => 'nullable',
            'allData.*.upper_hip' => 'nullable',
            'allData.*.solder' => 'nullable',
            'allData.*.sleeve' => 'nullable',
            'allData.*.coff' => 'nullable',
            'allData.*.arm' => 'nullable',
            'allData.*.mussle' => 'nullable',
            'allData.*.neck' => 'nullable',
            'allData.*.body_front' => 'nullable',
            'allData.*.belly_front' => 'nullable',
            'allData.*.hip_front' => 'nullable',
            'allData.*.down' => 'nullable',
            'allData.*.straight' => 'nullable',

            //Lower part
            'allData.*.lower_length' => 'nullable',
            'allData.*.muhuri' => 'nullable',
            'allData.*.knee' => 'nullable',
            'allData.*.thigh' => 'nullable',
            'allData.*.waist' => 'nullable',
            'allData.*.lower_hip' => 'nullable',
            'allData.*.high' => 'nullable',
            'allData.*.front_down' => 'nullable',
            'allData.*.back_down' => 'nullable',
            'allData.*.fly' => 'nullable',
            'allData.*.front' => 'nullable',
            'allData.*.back' => 'nullable',

            //payment part
            'payment_type' => 'required|string',
            'cash_id' => 'required',
            'total_paid' => 'nullable|numeric',
        ]);

        DB::transaction(function () use($request) {
            // insert customer information

            $customer = Customer::firstOrCreate([
                'mobile_no' => $request->mobile_no,
            ], [
                'customer_name' => $request->customer_name,
                'address' => $request->address,
            ]);

            $customer_id = $customer->id;


            $this->customer_order = CustomerOrder::create([
                'customer_id' => $customer_id,
                'date' => $request->date,
                'order_no' => $request->order_no,
                'delivery_date' => $request->delivery_date,
                'sub_total' => $request->sub_total,
                'discount_type' => $request->discount_type,
                'discount' => $request->discount ? $request->discount : 0.00,
                'voucher_amount' => $request->voucher_amount,
                'fabric_bill' => $request->fabric_bill ? $request->fabric_bill : 0.00,
                'fabric_paid' => $request->fabric_paid ? $request->fabric_paid : 0.00,
                'user_id' => Auth::id(),
            ]);

            $customer_order = $this->customer_order;

            // update customer order id
            $customer_order_id = $customer_order->id;


            foreach ($request->allData as $data) {
                // insert
                $OrderDetails = OrderDetails::create([
                    'customer_order_id' => $customer_order_id,
                    'item_id' => $data['item_id'],
                    'image_id' => $data['image_id'],
                    'master_id' => $data['master_id'],
                    'fitting_id' => $data['fitting_id'],
                    'quantity' => $data['quantity'],

                    //Upper part
                    'upper_length' => $data['upper_length'],
                    'round_body' => $data['round_body'],
                    'belly' => $data['belly'],
                    'upper_hip' => $data['upper_hip'],
                    'solder' => $data['solder'],
                    'sleeve' => $data['sleeve'],
                    'coff' => $data['coff'],
                    'arm' => $data['arm'],
                    'mussle' => $data['mussle'],
                    'neck' => $data['neck'],
                    'body_front' => $data['body_front'],
                    'belly_front' => $data['belly_front'],
                    'hip_front' => $data['hip_front'],
                    'down' => $data['down'],
                    'straight' => $data['straight'],

                    //lower part
                    'lower_length' => $data['lower_length'],
                    'muhuri' => $data['muhuri'],
                    'knee' => $data['knee'],
                    'thigh' => $data['thigh'],
                    'waist' => $data['waist'],
                    'lower_hip' => $data['lower_hip'],
                    'high' => $data['high'],
                    'front_down' => $data['front_down'],
                    'back_down' => $data['back_down'],
                    'fly' => $data['fly'],
                    'front' => $data['front'],
                    'back' => $data['back'],
                ]);

                $OrderDetails->designs()->sync($data['design_ids']);
            }
            // insert
            PaymentDetails::create([
                'date' => $request->date,
                'customer_id' => $customer_id,
                'customer_order_id' => $customer_order_id,
                'payment_type' => $request->payment_type,
                'cash_id' => $request->cash_id,
                'total_paid' => $request->total_paid ? $request->total_paid : 0.00,
            ]);

            //Update customer balance start
            $_customer = Customer::where('id', $customer_id)->first();

            $customerBalance = $_customer->balance;
            $customerSubTotal = $request->sub_total;
            $customerDiscount = $request->discount_type  == 'percentage' ? ($request->sub_total * $request->discount) / 100 : $request->discount;
            $customerGrandtotal = $customerSubTotal - $customerDiscount;
            $customerUpdateBalance = ($customerBalance + $customerGrandtotal) - $request->total_paid;

            $_customer->update([
                'balance' => $customerUpdateBalance
            ]);

            // Update customer balance end
            //  $paymentTypes = PaymentType::findOrFail($request->payment_type_id);
             $amount = $request->total_paid;
             if ($amount) {
                 if ($request->payment_type === 'cash') {
                    $cash = Cash::find($request->cash_id);
                    $cash->increment('balance', $amount);
                 }
             }

        });

        session()->flash("success", 'Order created succesfully');

        // view
        return response($this->customer_order);
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
        $customer_order = CustomerOrder::with('orderDetails.item')->findOrFail($id);

        $fabric_due = 0;
        $fabric_due = $customer_order->fabric_bill - $customer_order->fabric_paid;

        return view('tailor.customer-order.show', compact('customer_order', 'fabric_due'));
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
        $customer_order = CustomerOrder::with('orderDetails.designs','customer')->findOrFail($id);

        $allEditData =  $customer_order->orderDetails->map(function($order_detail) {
            return [
                "id" => $order_detail->id,
                "item_id" => $order_detail->item_id,
                "image_id" => $order_detail->image_id,
                "master_id" => $order_detail->master_id,
                "upper_length" => $order_detail->upper_length,
                "round_body" => $order_detail->round_body,
                "belly" => $order_detail->belly,
                "upper_hip" => $order_detail->upper_hip,
                "solder" => $order_detail->solder,
                "sleeve" => $order_detail->sleeve,
                "coff" => $order_detail->coff,
                "arm" => $order_detail->arm,
                "mussle" => $order_detail->mussle,
                "neck" => $order_detail->neck,
                "body_front" => $order_detail->body_front,
                "belly_front" => $order_detail->belly_front,
                "hip_front" => $order_detail->hip_front,
                "down" => $order_detail->down,
                "straight" => $order_detail->straight,
                "lower_length" => $order_detail->lower_length,
                "muhuri" => $order_detail->muhuri,
                "knee" => $order_detail->knee,
                "thigh" => $order_detail->thigh,
                "waist" => $order_detail->waist,
                "lower_hip" => $order_detail->lower_hip,
                "high" => $order_detail->high,
                "front_down" => $order_detail->front_down,
                "back_down" => $order_detail->back_down,
                "fly" => $order_detail->fly,
                "front" => $order_detail->front,
                "back" => $order_detail->back,
                "fitting_id" => $order_detail->fitting_id,
                "quantity" => $order_detail->quantity,
                "design_ids" => $order_detail->designs->pluck("id")
            ];
        })->toArray();

        $customer_order['format_date'] = $customer_order->date->format('Y-m-d');
        $customer_order['format_delivery_date'] = $customer_order->delivery_date->format('Y-m-d');

        $items = Item::all();
        $designs = Design::all();
        $fittings = Fitting::all();
        $paymentTypes = PaymentType::all();
        $cashes = Cash::all();
        $discountTypes = config('tailor.discountType');
        $images = Image::all();
        $customers = Customer::all();
        $vouchers = Voucher::all();
        $employees = Employee::where('employee_role', 'Master')->get();

        // $order_no = "C." . str_pad(CustomerOrder::max('id') + 1, 4, '0', STR_PAD_LEFT);

        // view
        return view('tailor.customer-order.edit', compact('customer_order', 'items', 'designs', 'fittings', 'paymentTypes', 'discountTypes', 'discountTypes', 'allEditData','images', 'customers', 'cashes','vouchers','employees'));
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
        // return $request->all();

        $request->validate([

            //Customer information
            'date' => 'required',
            'order_no' => 'required',
            'delivery_date' => 'required',
            'customer_name' => 'nullable|string',
            'mobile_no' => 'nullable|string',
            'address' => 'nullable|string',
            'discount_type' => 'nullable|string',
            'sub_total' => 'numeric',
            'discount' => 'nullable|numeric',

            'allData.*.item_id' => 'required',
            'allData.*.master_id' => 'required',
            'allData.*.image_id' => 'nullable',
            'allData.*.design_ids.*' => 'required',
            'allData.*.fitting_id' => 'required',
            'allData.*.quantity' => 'required',

            //upper part
            'allData.*.upper_length' => 'nullable',
            'allData.*.round_body' => 'nullable',
            'allData.*.belly' => 'nullable',
            'allData.*.upper_hip' => 'nullable',
            'allData.*.solder' => 'nullable',
            'allData.*.sleeve' => 'nullable',
            'allData.*.coff' => 'nullable',
            'allData.*.arm' => 'nullable',
            'allData.*.mussle' => 'nullable',
            'allData.*.neck' => 'nullable',
            'allData.*.body_front' => 'nullable',
            'allData.*.belly_front' => 'nullable',
            'allData.*.hip_front' => 'nullable',
            'allData.*.down' => 'nullable',
            'allData.*.straight' => 'nullable',

            //Lower part
            'allData.*.lower_length' => 'nullable',
            'allData.*.muhuri' => 'nullable',
            'allData.*.knee' => 'nullable',
            'allData.*.thigh' => 'nullable',
            'allData.*.waist' => 'nullable',
            'allData.*.lower_hip' => 'nullable',
            'allData.*.high' => 'nullable',
            'allData.*.front_down' => 'nullable',
            'allData.*.back_down' => 'nullable',
            'allData.*.fly' => 'nullable',
            'allData.*.front' => 'nullable',
            'allData.*.back' => 'nullable',

            //payment part
            'payment_type' => 'required|string',
            'cash_id' => 'required',
            'total_paid' => 'required|numeric',
        ]);



        $customer_order = CustomerOrder::with('orderDetails.designs')->findOrFail($id);
        $old_ids = $customer_order->orderDetails->pluck('id');


        $form_order_details = collect($request->allData);

        $updating_ids = $form_order_details->pluck('id')->filter();

        // need to update from records
        $available_old_ids = $old_ids->intersect($updating_ids);

        // need to delete from records
        $removed_ids = $old_ids->diff($updating_ids)->toArray();

        // nedd to add to record
        $new_details = $form_order_details->filter(fn($item) => !isset($item['id']))->values();

        // old details need update record
        $old_details = $form_order_details->filter(function($item) use ($available_old_ids){
            if(isset($item['id'])){
                return in_array($item['id'], $available_old_ids->toArray());
            }
        });


        DB::transaction(function () use ($customer_order, $removed_ids, $old_details, $new_details, $request) {
            // rmeove deleted details
            $customer_order->orderDetails()
                ->whereIn('id', $removed_ids)
                ->delete();

            // old record update
            foreach ($old_details as $old_detail) {
                $order_detail = $customer_order->orderDetails()
                    ->where('id', $old_detail['id'])
                    ->first();

                $order_detail->update([
                        'item_id' => $old_detail['item_id'],
                        'image_id' => $old_detail['image_id'],
                        'master_id' => $old_detail['master_id'],
                        'fitting_id' => $old_detail['fitting_id'],
                        'quantity' => $old_detail['quantity'],

                        //Upper part
                        'upper_length' => $old_detail['upper_length'],
                        'round_body' => $old_detail['round_body'],
                        'belly' => $old_detail['belly'],
                        'upper_hip' => $old_detail['upper_hip'],
                        'solder' => $old_detail['solder'],
                        'sleeve' => $old_detail['sleeve'],
                        'coff' => $old_detail['coff'],
                        'arm' => $old_detail['arm'],
                        'mussle' => $old_detail['mussle'],
                        'neck' => $old_detail['neck'],
                        'body_front' => $old_detail['body_front'],
                        'belly_front' => $old_detail['belly_front'],
                        'hip_front' => $old_detail['hip_front'],
                        'down' => $old_detail['down'],
                        'straight' => $old_detail['straight'],

                        //lower part
                        'lower_length' => $old_detail['lower_length'],
                        'muhuri' => $old_detail['muhuri'],
                        'knee' => $old_detail['knee'],
                        'thigh' => $old_detail['thigh'],
                        'waist' => $old_detail['waist'],
                        'lower_hip' => $old_detail['lower_hip'],
                        'high' => $old_detail['high'],
                        'front_down' => $old_detail['front_down'],
                        'back_down' => $old_detail['back_down'],
                        'fly' => $old_detail['fly'],
                        'front' => $old_detail['front'],
                        'back' => $old_detail['back'],
                    ]);

                $order_detail->designs()->sync($old_detail['design_ids']);
            }

            // create new details
            foreach ($new_details as $new_detail) {
                $new_order_detail = $customer_order->orderDetails()
                    ->create([
                        'item_id' => $new_detail['item_id'],
                        'image_id' => $new_detail['image_id'],
                        'master_id' => $new_detail['master_id'],
                        'fitting_id' => $new_detail['fitting_id'],
                        'quantity' => $new_detail['quantity'],

                        //Upper part
                        'upper_length' => $new_detail['upper_length'],
                        'round_body' => $new_detail['round_body'],
                        'belly' => $new_detail['belly'],
                        'upper_hip' => $new_detail['upper_hip'],
                        'solder' => $new_detail['solder'],
                        'sleeve' => $new_detail['sleeve'],
                        'coff' => $new_detail['coff'],
                        'arm' => $new_detail['arm'],
                        'mussle' => $new_detail['mussle'],
                        'neck' => $new_detail['neck'],
                        'body_front' => $new_detail['body_front'],
                        'belly_front' => $new_detail['belly_front'],
                        'hip_front' => $new_detail['hip_front'],
                        'down' => $new_detail['down'],
                        'straight' => $new_detail['straight'],

                        //lower part
                        'lower_length' => $new_detail['lower_length'],
                        'muhuri' => $new_detail['muhuri'],
                        'knee' => $new_detail['knee'],
                        'thigh' => $new_detail['thigh'],
                        'waist' => $new_detail['waist'],
                        'lower_hip' => $new_detail['lower_hip'],
                        'high' => $new_detail['high'],
                        'front_down' => $new_detail['front_down'],
                        'back_down' => $new_detail['back_down'],
                        'fly' => $new_detail['fly'],
                        'front' => $new_detail['front'],
                        'back' => $new_detail['back'],
                    ]);
                $new_order_detail->designs()->sync($new_detail['design_ids']);
            }


            // update or create customer information
            $customer = Customer::firstOrCreate([
                'mobile_no' => $request->mobile_no,
            ], [
                'customer_name' => $request->customer_name,
                'address' => $request->address,
            ]);

            $customer_id = $customer->id;

            $customer_order->update([
                'customer_id' => $customer_id,
                'date' => $request->date,
                'order_no' => $request->order_no,
                'delivery_date' => $request->delivery_date,
                'sub_total' => $request->sub_total,
                'discount_type' => $request->discount_type,
                'discount' => $request->discount ? $request->discount : 0.00,
                'voucher_amount' => $request->voucher_amount,
                'fabric_bill' => $request->fabric_bill ? $request->fabric_bill : 0.00,
                'fabric_paid' => $request->fabric_paid ? $request->fabric_paid : 0.00,
                'user_id' => Auth::id(),
            ]);

            $total_paid = $request->total_paid ? $request->total_paid : 0.00;
            $previous_total_paid = $customer_order->paymentDetails->first()->total_paid;

            // insert
            $customer_order->paymentDetails->first()->update([
                    'date' => $request->date,
                    'customer_id' => $customer_id,
                    'customer_order_id' => $customer_order->id,
                    'payment_type' => $request->payment_type,
                    'cash_id' => $request->cash_id,
                    'total_paid' => $total_paid,
                ]);

            // return $paymentDetails = PaymentDetails::where('cash_id',$request->cash_id)->firstOrFail();

            $increment = $total_paid - $previous_total_paid;
            Cash::where('id', $request->cash_id)->increment('balance', $increment);

           $decrement = $total_paid - $previous_total_paid;
            Customer::where('id', $customer_id)->decrement('balance', $decrement);

        });

        session()->flash("success", 'Order updated succesfully');

        // view
        return response($customer_order);
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
        $customer_order = CustomerOrder::findOrFail($id);

        // view
        if ($customer_order->delete()) {
            return redirect()->route('customer-order.index')->withSuccess('Customer order deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }

    public function statusChangeToDelivery($id)
    {
        $customerOrder = CustomerOrder::findOrFail($id);

        //Customer order status update to delivery using button
        if ($customerOrder->status != CustomerOrder::STATUS_DELIVERY) {
            $customerOrder->update([
                'status' => CustomerOrder::STATUS_DELIVERY
            ]);
        return redirect()->back()->withSuccess('Order delivered successfully.');
        }
        else{
            $customerOrder->update([
                'status' => CustomerOrder::STATUS_COMPLETE
            ]);
        }

        return redirect()->back()->withSuccess('Order has not yet been delivered.');
    }


    /**
     *
     * react component method get prevous order by customer id
     *
     */

    public function getPreviousOrderByCustomerId(Request $request)
    {
        return OrderDetails::with('item','designs')
        ->whereHas('customerOrder', function($query){
            $query->where('customer_id', '=', request()->customer_id);

        })
        ->orderBy('id','desc')
        ->paginate(40)
        ->map(function($order_detail){
            $order_detail["design_ids"] = $order_detail->designs->pluck("id");

            return $order_detail;
        })->toArray();

    }
}
