<x-app-layout>
    <x-slot name="title">Customer order </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.customer-order.menu')
        <!-- container menu end -->

        <!-- print header -->
        {{-- @include('layouts.partials.printHead') --}}
        <!-- print header end -->

        <div class="container print-none">
            <div class="mb-5 border-0 card">
                <div class="p-0 mb-3 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Customer order details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- Print -->
                    <a href="#" class="btn top-icon-button print-none ms-auto mt-3" title="Print" onclick="window.print()">
                        <i class="bi bi-printer"></i>
                    </a>
                    <!-- header icon -->
                    <a href="{{ route('customer-order.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0 print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>

                <div class="p-0 card-body">

                   <div class="mb-5 text-center">
                       <h5 class="border border-1 border-secondary p-3 d-inline-block bg-white">ORDER NO -
                           <span class="fst-italic text-muted fs-5">{{ $customer_order->order_no }}</span>
                       </h5>

                    </div>
                    <div class="row">
                        <div class="col-8">
                            {{-- Customer Info start --}}

                            <div class="row">
                                <div class="col-2">
                                    <dt>Customer name</dt>
                                </div>
                                <div class="col-1">
                                    <dt> : </dt>
                                </div>
                                <div class="col-6">
                                    <dd>{{$customer_order->customer->customer_name}}</dd>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <dt>Mobile no</dt>
                                </div>
                                <div class="col-1">
                                    <dt> : </dt>
                                </div>
                                <div class="col-6">
                                    <dd>{{$customer_order->customer->mobile_no}}</dd>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <dt>Order date</dt>
                                </div>
                                <div class="col-1">
                                    <dt> : </dt>
                                </div>
                                <div class="col-6">
                                    <dd>{{$customer_order->date->format('d M , Y') }}</dd>
                                </div>
                            </div>

                            @if ($customer_order->customer->address != null)
                            <div class="row">
                                <div class="col-2">
                                    <dt>Address</dt>
                                </div>
                                <div class="col-1">
                                    <dt> : </dt>
                                </div>
                                <div class="col-6">
                                    <dd>{{$customer_order->customer->address}}</dd>
                                </div>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-2">
                                    <dt>Delivery date</dt>
                                </div>
                                <div class="col-1">
                                    <dt> : </dt>
                                </div>
                                <div class="col-6">
                                    <dd>{{$customer_order->delivery_date->format('d M , Y') }}</dd>
                                </div>
                            </div>
                            {{-- Customer Info End --}}
                        </div>

                         {{-- Payment history start --}}
                        <div class="col-4">
                            <p class="fw-bold">Payments History</p>
                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th  class="text-end" scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="text-end" >{{ number_format($customer_order->sub_total, 2) }}</td>
                                    </tr>
                                    @if ($customer_order->total_discount!= 0)
                                    <tr>
                                        <td>Discount</td>
                                        <td class="text-end" >{{ number_format($customer_order->total_discount, 2) }}</td>
                                    </tr>

                                    @endif

                                    <tr>
                                        <td>Grand total</td>
                                        <td class="text-end" >{{ number_format($customer_order->grand_total, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td>Total paid</td>
                                        <td class="text-end" >{{ number_format($customer_order->paymentDetails->sum("total_paid"), 2) }}</td>
                                    </tr>

                                    @if ($customer_order->paymentDetails->sum("total_adjustment")!= 0)
                                    <tr>
                                        <td>Adjustment</td>
                                        <td class="text-end" >{{ number_format($customer_order->paymentDetails->sum("total_adjustment"), 2) }}</td>
                                    </tr>

                                    @endif
                                </tbody>

                                <tfoot>
                                    <tr  class="border-top">
                                        <th>Total due </th>
                                        <th class="text-end">{{ number_format($customer_order->total_due,2)}}</th>
                                        <th colspan="1">&nbsp;</th>
                                    </tr>
                                </tfoot>
                            </table>

                            @if ($customer_order->fabric_bill != 0)
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Fabric Bill</td>
                                        <td class="text-end" >{{ number_format($customer_order->fabric_bill, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td>Fabric paid</td>
                                        <td class="text-end" >{{ number_format($customer_order->fabric_paid, 2) }}</td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr  class="border-top">
                                        <th>Fabric due </th>
                                        <th class="text-end">{{ number_format($customer_order->fabric_bill - $customer_order->fabric_paid,2)}}</th>
                                        <th colspan="1">&nbsp;</th>
                                    </tr>
                                </tfoot>
                            </table>

                            @endif

                        </div>
                            {{-- Payment history end --}}
                    </div>

                    <div class="mt-3">
                        <div class="row">
                            @foreach ($customer_order->orderDetails as $orderDetail )
                            <div class="col-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <p class="fs-5 text-center">
                                            Item :
                                            <span class="fst-italic text-muted">{{ $orderDetail->item->item_name }}</span>
                                        </p>
                                    </div>
                                    <div class="card-body bg-white">
                                        <p class="fw-bold mb-2">Measurements:</p>
                                        <div class="row">
                                            <div class="col-12">
                                                {{-- Upper part --}}
                                                @if ( $orderDetail->item->item_part=='Upper part' )
                                                <div class="d-flex justify-content-around">
                                                    <div>
                                                        <p class="text-center">
                                                             @php
                                                                $formatted_upper_length = explode('/', $orderDetail->upper_length )
                                                            @endphp

                                                            @if(count($formatted_upper_length) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_upper_length[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_upper_length[2] ?? 0 }}</mn><mn>{{ $formatted_upper_length[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->upper_length }}

                                                            @endif

                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="border-bottom border-2 border-secondary text-center" style="width: 40px">
                                                             @php
                                                                $formatted_round_body= explode('/', $orderDetail->round_body)
                                                            @endphp

                                                            @if(count($formatted_round_body) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_round_body[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_round_body[2] ?? 0 }}</mn><mn>{{ $formatted_round_body[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->round_body }}

                                                            @endif

                                                        </p>
                                                        <p class="border-bottom border-2 border-secondary text-center" style="width: 40px">
                                                             @php
                                                                $formatted_belly= explode('/', $orderDetail->belly)
                                                            @endphp

                                                            @if(count($formatted_belly) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_belly[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_belly[2] ?? 0 }}</mn><mn>{{ $formatted_belly[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->belly }}

                                                            @endif
                                                        </p>
                                                        <p  class="text-center">
                                                            @php
                                                                $formatted_upper_hip= explode('/', $orderDetail->upper_hip)
                                                            @endphp

                                                            @if(count($formatted_upper_hip) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_upper_hip[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_upper_hip[2] ?? 0 }}</mn><mn>{{ $formatted_upper_hip[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->upper_hip }}

                                                            @endif

                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-center" style="width: 30px">
                                                            @php
                                                                $formatted_down= explode('/', $orderDetail->down)
                                                            @endphp

                                                            @if(count($formatted_down) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_down[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_down[2] ?? 0 }}</mn><mn>{{ $formatted_down[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->down }}

                                                            @endif
                                                        </p>
                                                        <p class="text-center" style="width: 30px">
                                                            @php
                                                                $formatted_straight= explode('/', $orderDetail->straight)
                                                            @endphp

                                                            @if(count($formatted_straight) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_straight[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_straight[2] ?? 0 }}</mn><mn>{{ $formatted_straight[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->straight }}

                                                            @endif
                                                        </p>
                                                        <p class="border-top border-2 border-secondary text-center">
                                                            @php
                                                                $formatted_solder= explode('/', $orderDetail->solder)
                                                            @endphp

                                                            @if(count($formatted_solder) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_solder[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_solder[2] ?? 0 }}</mn><mn>{{ $formatted_solder[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->solder }}

                                                            @endif
                                                        </p>

                                                    </div>
                                                    <div>
                                                        <p class="border-bottom border-2 border-secondary text-center" style="width: 40px">

                                                            @php
                                                                $formatted_sleeve= explode('/', $orderDetail->sleeve)
                                                            @endphp

                                                            @if(count($formatted_sleeve) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_sleeve[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_sleeve[2] ?? 0 }}</mn><mn>{{ $formatted_sleeve[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->sleeve }}

                                                            @endif
                                                        </p>
                                                        <p class="border-bottom border-2 border-secondary text-center" style="width: 40px">
                                                            @php
                                                                $formatted_coff = explode('/', $orderDetail->coff )
                                                            @endphp

                                                            @if(count($formatted_coff) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_coff[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_coff[2] ?? 0 }}</mn><mn>{{ $formatted_coff[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->coff }}

                                                            @endif


                                                        </p>
                                                        <p class="border-bottom border-2 border-secondary text-center" style="width: 40px">
                                                            @php
                                                                $formatted_arm= explode('/', $orderDetail->arm )
                                                            @endphp

                                                            @if(count($formatted_arm) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_arm[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_arm[2] ?? 0 }}</mn><mn>{{ $formatted_arm[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->arm }}

                                                            @endif
                                                        </p>
                                                        <p  class="text-center">
                                                             @php
                                                                $formatted_mussle= explode('/', $orderDetail->mussle )
                                                            @endphp

                                                            @if(count($formatted_mussle) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_mussle[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_mussle[2] ?? 0 }}</mn><mn>{{ $formatted_mussle[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->mussle }}

                                                            @endif

                                                        </p>
                                                    </div>

                                                    <div>
                                                         <p class=" text-center" >
                                                             @php
                                                                $formatted_neck= explode('/', $orderDetail->neck )
                                                            @endphp

                                                            @if(count($formatted_neck) === 3)
                                                            ( <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_neck[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_neck[2] ?? 0 }}</mn><mn>{{ $formatted_neck[1] ?? 0 }}</mn></mfrac></math> )
                                                            @else

                                                            ({{ $orderDetail->neck }})

                                                            @endif
                                                        </p>
                                                    </div>


                                                    <div>

                                                        <p class="border-bottom border-2 border-secondary text-center" style="width: 40px">
                                                             @php
                                                                $formatted_body_front= explode('/', $orderDetail->body_front )
                                                            @endphp

                                                            @if(count($formatted_body_front) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_body_front[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_body_front[2] ?? 0 }}</mn><mn>{{ $formatted_body_front[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->body_front }}

                                                            @endif
                                                        </p>
                                                        <p class="border-bottom border-2 border-secondary text-center" style="width: 40px">
                                                            @php
                                                                $formatted_belly_front= explode('/', $orderDetail->belly_front )
                                                            @endphp

                                                            @if(count($formatted_belly_front) === 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_belly_front[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_belly_front[2] ?? 0 }}</mn><mn>{{ $formatted_belly_front[1] ?? 0 }}</mn></mfrac></math>
                                                            @else

                                                            {{ $orderDetail->belly_front }}

                                                            @endif
                                                        </p>
                                                        <p  class="text-center">
                                                            @php
                                                                $formatted_hip_front = explode('/', $orderDetail->hip_front)
                                                            @endphp
                                                            @if (count($formatted_hip_front)=== 3)
                                                                <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_hip_front[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_hip_front[2] ?? 0}}</mn><mn>{{ $formatted_hip_front[1] ?? 0 }}</mn></mfrac></math>

                                                            @else

                                                                {{ $orderDetail->hip_front }}

                                                            @endif

                                                        </p>
                                                    </div>
                                                </div>

                                                @else
                                                    {{-- Lower part --}}
                                                <div class="d-flex justify-content-around">
                                                    <p>
                                                        @php
                                                            $formatted_lower_length= explode('/', $orderDetail->lower_length)
                                                        @endphp
                                                        @if (count($formatted_lower_length)=== 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_lower_length[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_lower_length[2] ?? 0}}</mn><mn>{{ $formatted_lower_length[1] ?? 0 }}</mn></mfrac></math>

                                                        @else

                                                            {{ $orderDetail->lower_length }}

                                                        @endif
                                                    </p>
                                                    <p>
                                                        @php
                                                            $formatted_muhuri= explode('/', $orderDetail->muhuri)
                                                        @endphp
                                                        @if (count($formatted_muhuri)=== 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_muhuri[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_muhuri[2] ?? 0}}</mn><mn>{{ $formatted_muhuri[1] ?? 0 }}</mn></mfrac></math>

                                                        @else

                                                            {{ $orderDetail->muhuri }}

                                                        @endif
                                                    </p>
                                                    <p>
                                                        @php
                                                            $formatted_knee= explode('/', $orderDetail->knee)
                                                        @endphp
                                                        @if (count($formatted_knee)=== 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_knee[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_knee[2] ?? 0}}</mn><mn>{{ $formatted_knee[1] ?? 0 }}</mn></mfrac></math>

                                                        @else

                                                            {{ $orderDetail->knee }}

                                                        @endif
                                                    </p>
                                                    <p>
                                                        @php
                                                            $formatted_thigh= explode('/', $orderDetail->thigh)
                                                        @endphp
                                                        @if (count($formatted_thigh)=== 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_thigh[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_thigh[2] ?? 0}}</mn><mn>{{ $formatted_thigh[1] ?? 0 }}</mn></mfrac></math>

                                                        @else

                                                            {{ $orderDetail->thigh }}

                                                        @endif
                                                    </p>
                                                    <p>
                                                        @php
                                                            $formatted_waist= explode('/', $orderDetail->waist)
                                                        @endphp
                                                        @if (count($formatted_waist)=== 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_waist[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_waist[2] ?? 0}}</mn><mn>{{ $formatted_waist[1] ?? 0 }}</mn></mfrac></math>

                                                        @else

                                                            {{ $orderDetail->waist }}

                                                        @endif
                                                    </p>
                                                    <p>
                                                        @php
                                                            $formatted_lower_hip= explode('/', $orderDetail->lower_hip)
                                                        @endphp
                                                        @if (count($formatted_lower_hip)=== 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_lower_hip[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_lower_hip[2] ?? 0}}</mn><mn>{{ $formatted_lower_hip[1] ?? 0 }}</mn></mfrac></math>

                                                        @else

                                                            {{ $orderDetail->lower_hip }}

                                                        @endif
                                                    </p>
                                                    <p>
                                                        @php
                                                            $formatted_high= explode('/', $orderDetail->high)
                                                        @endphp
                                                        @if (count($formatted_high)=== 3)
                                                            <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_high[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_high[2] ?? 0}}</mn><mn>{{ $formatted_high[1] ?? 0 }}</mn></mfrac></math>

                                                        @else

                                                            {{ $orderDetail->high }}

                                                        @endif

                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-around mt-1">
                                                    @if ($orderDetail->front_down!=null)
                                                        <p>FD - {{ $orderDetail->front_down }}</p>
                                                    @endif
                                                    @if ($orderDetail->back_down !=null)
                                                        <p>BD - {{ $orderDetail->back_down }}</p>
                                                    @endif

                                                    @if ($orderDetail->fly !=null)
                                                    <p>Fly -
                                                        @php
                                                            $formatted_fly= explode('/', $orderDetail->fly)
                                                        @endphp
                                                        @if (count($formatted_fly)=== 3)
                                                             <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_fly[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_fly[2] ?? 0}}</mn><mn>{{ $formatted_fly[1] ?? 0 }}</mn></mfrac></math>

                                                        @else

                                                           {{ $orderDetail->fly }}

                                                        @endif
                                                    </p>
                                                    @endif
                                                    @if ( $orderDetail->front!=null )
                                                        <p>Front -
                                                        @php
                                                            $formatted_front= explode('/', $orderDetail->front)
                                                        @endphp
                                                        @if (count($formatted_front)=== 3)
                                                             <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_front[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_front[2] ?? 0}}</mn><mn>{{ $formatted_front[1] ?? 0 }}</mn></mfrac></math>

                                                        @else

                                                         {{ $orderDetail->front }}

                                                        @endif
                                                        </p>
                                                    @endif
                                                    @if ($orderDetail->back !=null)
                                                        <p>Back -
                                                            @php
                                                                $formatted_back = explode('/', $orderDetail->back)
                                                            @endphp
                                                            @if (count($formatted_back) === 3)
                                                                <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_back[0] }}</mn><mfrac><mn>{{ $formatted_back[2] }}</mn><mn>{{ $formatted_back[1] }}</mn></mfrac></math>
                                                            @else
                                                                {{ $orderDetail->back }}
                                                            @endif

                                                        </p>
                                                    @endif
                                                </div>
                                                @endif

                                                {{-- Design --}}
                                                <div>
                                                    <p class="fw-bold">Designs : </p>
                                                    @foreach ($orderDetail->designs as $design )
                                                       <ul>
                                                            <li>{{ $design->design_name }} </li>
                                                       </ul>
                                                    @endforeach
                                                </div>

                                                <div>
                                                    <p><span class="fw-bold">Fitting : </span>{{$orderDetail->fitting->fitting_name}}</p>
                                                </div>
                                                <div>
                                                    <p><span class="fw-bold">Quantity : </span>{{$orderDetail->quantity}} </p>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

        {{-- For customer order reciept print start --}}
        <div class="container print-show">
            <div class="row">
                <div class="col-4">
                    <div style="margin-top: 35px; font-size: 18px;">
                        <p class="fw-bold" style="margin-left: 230px; position: relative;top: -52px;">{{ $customer_order->order_no }}
                        </p>
                        <p style="margin-bottom: 10px; margin-left: 128px; position: relative; top: -10px;">{{$customer_order->date->format('d M , Y')}}
                        </p>
                        <p style="margin-left: 128px; position: relative;top: -10px;">{{$customer_order->delivery_date->format('d M , Y')}}
                        </p>
                    </div>

                     {{-- <div class="col-8">
                        <div class="total_payment_border">
                            <table class="table table-sm table-borderless total-payment">
                                <thead>
                                    <tr>
                                        <th scope="col">&nbsp;</th>
                                        <th class="text-end" scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Total Bill</th>
                                        <th class="text-end">{{number_format($customer_order->fabric_bill + $customer_order->grand_total ,2)}}</th>
                                    </tr>
                                    <tr>
                                        <th>Total paid </th>
                                        <th class="text-end">{{number_format($customer_order->fabric_paid + $customer_order->paymentDetails->sum("total_paid") ,2)}}</th>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="border-top">
                                        <th> Total due </th>
                                        <th class="text-end">{{number_format($fabric_due + $customer_order->total_due ,2)}}</th>
                                        <td colspan="1">&nbsp;</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                     </div> --}}

                </div>
                <div class="col-3 " style="margin-top: 120px;">
                      <div class="text-center">
                            <p>Customer name</p>
                            <p class="fw-bold">{{ $customer_order->customer->customer_name }}</p>
                      </div>
                      {{-- <div class="mt-2">
                          <table class="table table-sm table-borderless fabric-payment">
                            <tbody>
                                <tr>
                                    <td>Fabric Bill </td>
                                    <td class="text-end">{{number_format($customer_order->fabric_bill,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Fabric Paid </td>
                                    <td class="text-end">{{number_format($customer_order->fabric_paid,2)}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="border-top">
                                    <th>Fabric due </th>
                                    <th class="text-end">{{number_format($fabric_due ,2)}}</th>
                                    <td colspan="1">&nbsp;</td>
                                </tr>
                            </tfoot>
                        </table>
                      </div> --}}

                </div>

                <div class="col-5">

                    <div class="row">
                        <div class="col-12">
                            <table class="table table-sm table-borderless printable-table">
                                <thead>
                                    <tr>
                                        <th scope="col">&nbsp;</th>
                                        <th class="text-end" scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>

                                 @foreach ( $customer_order->orderDetails as $orderDetail  )
                                    <tr>
                                        <td>
                                            {{-- {{Illuminate\Support\Str::limit($orderDetail->item->item_name, 20, ' ...')}} ({{$orderDetail->quantity}}) --}}
                                            {{$orderDetail->item->item_name}} ({{$orderDetail->quantity}})
                                        </td>
                                        <td class="text-end">{{number_format($orderDetail->item->price * $orderDetail->quantity ,2)}}</td>
                                    </tr>

                                 @endforeach

                                    @if ($customer_order->fabric_bill > 0)
                                        <tr>
                                            <td>Fabric</td>
                                            <td class="text-end">{{number_format($customer_order->fabric_bill,2)}}</td>
                                        </tr>

                                    @endif

                                    <tr class="border-top">
                                        <td>Total</td>
                                        <td class="text-end">{{number_format($customer_order->sub_total + $customer_order->fabric_bill ,2)}}</td>
                                    </tr>


                                    @if ($customer_order->discount  > 0)
                                        <tr>
                                            <td>Discount</td>
                                            <td class="text-end">{{number_format($customer_order->total_discount ,2)}}</td>
                                        </tr>
                                    @endif

                                    @if ($customer_order->voucher_amount > 0)
                                         <tr>
                                            <td>Voucher discount</td>
                                            <td class="text-end">{{number_format($customer_order->voucher_amount ,2)}}</td>
                                        </tr>

                                    @endif


                                    @if ($customer_order->discount > 0  || $customer_order->voucher_amount > 0)
                                        <tr>
                                            <td>Grand total</td>
                                            <td class="text-end">{{number_format($customer_order->grand_total + $customer_order->fabric_bill ,2)}}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th>Paid</th>
                                        <th class="text-end">{{number_format($customer_order->paymentDetails->sum("total_paid") + $customer_order->fabric_paid ,2)}}</th>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="border-top">
                                        <th> Due </th>
                                        <th class="text-end">{{number_format($customer_order->total_due + $fabric_due ,2)}}</th>
                                        <td colspan="1">&nbsp;</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>


         {{-- For customer order reciept print end --}}



        @push('script')
        <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
        <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
        @endpush

        @push('style')

        <style>
            @media print{
                .printable-table{
                    transform: scale(.8) translate(60px, 50px);
                    transform-origin: top right;
                    width: auto;
                    margin-left: 50px;
                }
                .printable-table td, .printable-table th{
                    padding: 0!important;
                }
                .printable-table tfoot .border-top{
                    border-top: 1px solid black!important;
                }
                  .printable-table tbody .border-top{
                    border-top: 1px solid black!important;
                }


                .fabric-payment{
                    margin-left: 20px;
                    margin-top: 10px
                    transform:scale(.8);
                    /* width: auto; */
                }
                .fabric-payment tfoot .border-top{
                    border-top: 1px solid black!important;
                }
                  .fabric-payment td, .fabric-payment th{
                    padding: 0!important;
                }



                .total-payment{
                    margin-left: 45px;
                    transform:scale(.9);
                    margin-top: .25rem;

                }
                 .total-payment tfoot .border-top{
                    border-top: 1px solid black!important;
                }
                    .total-payment td, .total-payment th{
                    padding: 0!important;
                }
            }
        </style>

        @endpush

</x-app-layout>


