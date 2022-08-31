<x-app-layout>
    <x-slot name="title">Customer orders </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.customer-order.menu')
        <!-- container menu end -->

        <!-- print header -->
        @include('layouts.partials.printHead')
        <!-- print header end -->

        <!-- card start -->
        <div class="border-0 card">
            <!-- card head -->
            <div class="p-0 mb-3 border-0 card-header d-md-flex align-items-center d-block">
                <!-- page title -->
                <div class="mt-3 mb-2">
                    <h4 class="main-title">Customer orders</h4>
                    <p><small>About {{ count($customerOrders) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('customer-order.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                <a href="#customerOrder-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('customer-order.create') }}" class="btn top-icon-button print-none" title="Create new customer order">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->
                <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="customerOrder-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <form action="{{ route('customer-order.index') }}" method="GET" >
                            <input type="hidden" name="search" value="1">
                            <div class="row gy-1 gx-3">
                                <div class="col-12 col-sm-6 col-lg-2">
                                    <label for="date" class="form-label">Date (From)</label>
                                    <input
                                    value="{{ (request()->search) ? request()->form_date : '' }}"
                                    type="date"
                                    id="formdate"
                                    name="form_date"
                                    class="form-control"
                                    placeholder="YYYY-MM-DD">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-2">
                                    <label for="date" class="form-label">Date (To)</label>
                                    <input
                                    value="{{ (request()->search) ? request()->to_date : '' }}"

                                    type="date"
                                    id="todate"
                                    name="to_date"
                                    class="form-control"
                                    placeholder="YYYY-MM-DD">
                                </div>
                                <div class="col-2">
                                    <label for="order-no" class="form-label">Order no</label>
                                    <input type="text" name="order_no" value="{{ request()->order_no ?? '' }}" class="form-control"
                                        placeholder="D.xxxx">
                                </div>

                                <div class="col-2">
                                    <label for="mobile-no" class="form-label">Mobile no</label>
                                    <input type="number" min="0"  name="mobile_no" value="{{ request()->mobile_no ?? '' }}" class="form-control"
                                        placeholder="01xx xxxxxx">
                                </div>

                                <div class="col-2">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value selected disabled>----</option>
                                        <option {{ request()->search ? request()->status == 1 ? 'selected' : '' : '' }}  value="1">Pending</option>
                                        <option  {{ request()->search ? request()->status == 2 ? 'selected' : '' : '' }} value="2">Processing</option>
                                        <option {{ request()->search ? request()->status == 3 ? 'selected' : '' : '' }}  value="3">Complete</option>
                                        <option {{ request()->search ? request()->status == 4 ? 'selected' : '' : '' }}  value="4">Delivered</option>
                                    </select>
                                </div>

                                <!-- button -->
                                <div class="col-12 col-sm-6 col-lg-2">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-block w-100 custom-btn btn-success">
                                        <i class="bi bi-search"></i>
                                        <span class="p-1">Search</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- search area end -->

                <!-- data table -->
                <div class="mb-3 table-responsive">
                    <table class="table  custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Date</th>
                                <th scope="col">Order no</th>
                                <th scope="col">Customer name</th>
                                <th scope="col">Mobile no</th>
                                <th scope="col">Delivery date</th>
                                <th scope="col">Recieved by</th>
                                <th scope="col">Remaining days</th>
                                <th scope="col">Status</th>

                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($customerOrders as $order)
                            @php
                                $orderDate= $order->date;
                                $deliveryDate = $order->delivery_date;

                                 $today = date("Y-m-d H:i:s");

                                $dateFrom = Carbon\Carbon::createFromDate($orderDate);
                                $dateTo = Carbon\Carbon::createFromDate($deliveryDate);
                                $remainingDay = $dateFrom->diffInDays($dateTo);
                            @endphp
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $order->date->format('d M , Y') }}</td>
                                    <td><a href="{{ route('customer-order.show', $order->id) }}" target="__blank">{{ $order->order_no }}</a></td>
                                    <td>{{ $order->customer->customer_name }}</td>
                                    <td>{{ $order->customer->mobile_no }}</td>
                                    <td>{{ $order->delivery_date->format('d M , Y') }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td class="{{$dateTo < $today ? 'text-danger':''}}">{{$dateTo > $today ? $remainingDay: 0 }}</td>

                                    <td class="text-center" >
                                        <a href="{{route('customerOrder.status',$order->id)}}"
                                            class="btn btn-sm text-decoration-none w-100
                                            @if ($order->status == App\Models\CustomerOrder::STATUS_DELIVERY )  btn-secondary fw-bold
                                            @elseif ($order->status == App\Models\CustomerOrder::STATUS_COMPLETE )  btn-success
                                            @elseif ($order->status == App\Models\CustomerOrder::STATUS_PROCESSING) btn-info text-white
                                            @else btn-primary
                                            @endif
                                            @if ($order->status != App\Models\CustomerOrder::STATUS_COMPLETE && $order->status != App\Models\CustomerOrder::STATUS_DELIVERY  ) disabled @endif"

                                            onclick="'Are you sure want to delete?'"
                                            >
                                        {{$order->current_status}}
                                      </a>
                                    </td>

                                    <td class="print-none text-end">
                                        <a href="{{ route('paymentReceive.create', $order->id) }}"
                                            class="btn table-small-button text-secondary
                                            @if ($order->status != App\Models\CustomerOrder::STATUS_COMPLETE && $order->status != App\Models\CustomerOrder::STATUS_DELIVERY ) disabled @endif"
                                            title="Payment"
                                            target="_blank" >
                                            <i class="bi bi-cash"></i>
                                        </a>
                                        <a href="{{ route('customer-order.show', $order->id) }}"
                                            class="btn table-small-button text-info"
                                            title="View"
                                            target="_blank" >
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('customer-order.edit', $order->id) }}"
                                            class="btn table-small-button text-success @if ($order->status != App\Models\CustomerOrder::STATUS_PENDING ) disabled @endif"
                                            title="Update">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button text-danger @if ($order->status != App\Models\CustomerOrder::STATUS_PENDING && $order->status != App\Models\CustomerOrder::STATUS_DELIVERY) disabled @endif"
                                                onclick="if(confirm('Are you sure want to delete?'))
                                                { document.getElementById('fitting-delete-{{ $order->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('customer-order.destroy', $order->id) }}" method="post" class="d-none" id="fitting-delete-{{ $order->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="10">Order list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($customerOrders)->withQueryString()->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
