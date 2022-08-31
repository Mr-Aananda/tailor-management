<x-app-layout>
    <x-slot name="title">Distribution</x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.distribution.menu')
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
                    <h4 class="main-title">Distribute to worker</h4>
                    <p><small>About {{ count($orderDetails) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('distribution.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                {{-- <a href="#distribution-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a> --}}

                <!-- add -->
                <a href="{{ route('distribution.create') }}" class="btn top-icon-button print-none" title="Create new distribution">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->
                 <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="distribution-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <form action="{{ route('distribution.index') }}" method="GET" >
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
                                <div class="col-3">
                                    <label for="order-no" class="form-label">Order no</label>
                                    <input type="text" min="0"  name="order_no" value="{{ request()->order_no ?? '' }}" class="form-control"
                                        placeholder="C.xxxx">
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
                                {{-- <th scope="col">Date</th> --}}
                                <th scope="col">Order no</th>
                                <th scope="col">Customer name</th>
                                <th scope="col">Item</th>
                                {{-- <th scope="col">Status</th> --}}
                                <th scope="col">Date</th>
                                <th scope="col">Workers</th>
                                {{-- <th scope="col" class="print-none text-end">Action</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                                @forelse($orderDetails as $orderDetail)
                                    <form action="{{route('distribution.store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_details_id" value="{{ $orderDetail->id }}">
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}.</th>
                                            {{-- <td>{{$orderDetail->customerOrder->date->format('d M , Y')}} </td> --}}
                                            <td>{{ $orderDetail->customerOrder->order_no }}</td>
                                            <td>{{ $orderDetail->customerOrder->customer->customer_name }}</td>
                                            <td class="w-25">{{$orderDetail->item->item_name}}</td>
                                            {{-- <td class="text-center">
                                                <a class=" btn btn-sm text-decoration-none w-100
                                                    @if ($orderDetail->status == App\Models\OrderDetails::STATUS_DELIVERY )  btn-outline-secondary fw-bold
                                                    @elseif ($orderDetail->status == App\Models\OrderDetails::STATUS_COMPLETE )  btn-outline-success
                                                    @elseif ($orderDetail->status == App\Models\OrderDetails::STATUS_PROCESSING) btn-outline-info
                                                    @else btn-outline-primary
                                                    @endif">
                                                    {{$orderDetail->current_status}}
                                                </a>
                                            </td> --}}
                                            <td style="width: 30px">
                                                <div>
                                                    <input type="date" name='distribute_date' value="{{ old('distribute-date')}}" class="form-control"  @if ($orderDetail->status != App\Models\OrderDetails::STATUS_PENDING ) disabled @endif required>

                                                        <!-- error -->
                                                        @error('distribute_date')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                </div>
                                            </td>

                                            <td class="w-25">
                                                <div class="input-group" >
                                                    <select name="worker_id" class="form-control" id="worker-id"
                                                    @if ($orderDetail->status != App\Models\OrderDetails::STATUS_PENDING ) disabled @endif required>
                                                        <option value="" selected disabled>--</option>
                                                        @foreach ($workers as $worker)
                                                            <option value="{{ $worker->id }}" {{ (old('worker_id') == $worker->id) ? 'selected' : '' }}>
                                                                {{ $worker->worker_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button class="btn btn-sm btn-success" @if ($orderDetail->status != App\Models\OrderDetails::STATUS_PENDING ) disabled @endif>
                                                      <i class="bi bi-arrow-right-circle"></i>
                                                    </button>
                                                </div>

                                            </td>

                                            {{-- <td class="print-none text-end">
                                                <a href="{{ route('customer-order.show', $orderDetail->id) }}" class="btn table-small-button text-info" title="View"><i class="bi bi-eye"></i></a>
                                            </td> --}}
                                        </tr>
                                    </form>
                                @empty
                                    <tr>
                                        <th colspan="8">No distribute items available</th>
                                    </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($orderDetails)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>

</x-app-layout>
