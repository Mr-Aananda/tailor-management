<x-app-layout>
    <x-slot name="title">Customer Payments detail </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.due-payments.menu')
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
                    <h4 class="main-title">Customer Payments</h4>
                    <p><small>About {{ count($customerOrders) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('due-payments.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                <a href="#customerOrder-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                {{-- <a href="{{ route('due-payments.create') }}" class="btn top-icon-button print-none" title="Create new payment">
                    <i class="bi bi-plus-circle"></i>
                </a> --}}
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->
                 <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="customerOrder-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <form action="{{ route('due-payments.index') }}" method="GET" >
                            <input type="hidden" name="search" value="1">
                            <div class="row gy-1 gx-3">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="date" class="form-label">Date (From)</label>
                                    <input
                                    value="{{ (request()->search) ? request()->form_date : '' }}"
                                    type="date"
                                    id="formdate"
                                    name="form_date"
                                    class="form-control"
                                    placeholder="YYYY-MM-DD">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
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
                                    <input type="text" min="0"  name="order_no" value="{{ request()->order_no ?? '' }}" class="form-control"
                                        placeholder="C.xxxx">
                                </div>

                                <div class="col-2">
                                    <label for="mobile-no" class="form-label">Mobile no</label>
                                    <input type="number" min="0"  name="mobile_no" value="{{ request()->mobile_no ?? '' }}" class="form-control"
                                        placeholder="01xx xxxxxx">
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
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Date</th>
                                <th scope="col">Order no</th>
                                <th scope="col">Customer name</th>
                                <th class="text-end" scope="col">Subotal</th>
                                <th class="text-end" scope="col">Discount</th>
                                <th class="text-end" scope="col">Voucher amount</th>
                                <th class="text-end " scope="col">Grand Total</th>
                                <th class="text-end" scope="col">Paid</th>
                                <th class="text-end" scope="col">Adjustment</th>
                                <th class="text-end" scope="col">Due</th>

                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $_totalPaid= 0;
                                $_totalAdjustment=0;
                            @endphp

                            @forelse($customerOrders as $order)
                                @php
                                    $_totalPaid += $order->paymentDetails->sum("total_paid");
                                    $_totalAdjustment += $order->paymentDetails->sum("adjustment");
                                @endphp

                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $order->date->format('d M , Y') }}</td>
                                    <td><a href="{{route('customer-order.show', $order->id)}}" target="__blank">{{ $order->order_no ?? "" }}</a></td>
                                    <td>{{ $order->customer->customer_name ?? ""}}</td>
                                    <td class="text-end">{{ number_format($order->sub_total,2) }}</td>
                                    <td class="text-end">{{ number_format($order->total_discount,2) }}</td>
                                    <td class="text-end">{{ number_format($order->voucher_amount,2) }}</td>
                                    <td class="text-end">{{ number_format($order->grand_total,2) }}</td>
                                    <td class="text-end">{{ number_format($order->paymentDetails->sum("total_paid"), 2)}}</td>
                                    <td class="text-end">{{ number_format($order->paymentDetails->sum("adjustment"), 2)}}</td>
                                    <td class="text-end">{{ number_format($order->total_due,2)}}</td>

                                    <td class="print-none text-end">
                                        {{-- <a href="{{ route('due-payments.show', $order->id) }}" class="btn table-small-button text-info" title="View"><i class="bi bi-eye"></i></a> --}}
                                        <a href="{{ route('due-payments.edit', $order->id) }}" class="btn table-small-button text-success" title="Update"> <i class="bi bi-pencil-square"></i></a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button text-danger" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('due-payments-delete-{{ $order->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('due-payments.destroy', $order->id) }}" method="post" class="d-none" id="due-payments-delete-{{ $order->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="11">Order list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>

                        <tfoot>
                            <tr>
                                <th class="text-end" colspan="4">Total </th>
                                <td class="text-end">{{ number_format ($customerOrders->sum('sub_total'),2) }} </td>
                                <td class="text-end">{{ number_format ($customerOrders->sum('total_discount'),2) }} </td>
                                <td class="text-end">{{ number_format ($customerOrders->sum('voucher_amount'),2) }} </td>
                                <th class="text-end">{{ number_format ($customerOrders->sum("grand_total"),2) }} </th>
                                <th class="text-end">{{ number_format ($_totalPaid,2) }} </th>
                                <td class="text-end">{{ number_format ($_totalAdjustment,2) }} </td>
                                <th class="text-end">{{ number_format ($customerOrders->sum('total_due'),2) }} </th>

                                <th colspan="2">&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($customerOrders)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
