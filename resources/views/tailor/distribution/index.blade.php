<x-app-layout>
    <x-slot name="title">All Distribution</x-slot>

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
                    <h4 class="main-title">Distribution</h4>
                    <p><small>About {{ count($distributions) }} results found.</small></p>
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
                <a href="#distribution-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('distribution.create') }}" class="btn top-icon-button print-none" title="Create new distribute">
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
                                    <input type="text" min="0"  name="order_no" value="{{ request()->order_no ?? '' }}" class="form-control"
                                        placeholder="C.xxxx">
                                </div>

                                <div class="col-2">
                                    <label for="worker-name" class="form-label">Worker name</label>
                                    <input type="text" min="0" name="worker_name" value="{{ request()->worker_name ?? '' }}" class="form-control"
                                        placeholder="Character only">
                                </div>

                                 <div class="col-2">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value selected disabled>----</option>
                                        {{-- <option {{ request()->search ? request()->status == 1 ? 'selected' : '' : '' }}  value="1">Pending</option> --}}
                                        <option  {{ request()->search ? request()->status == 2 ? 'selected' : '' : '' }} value="2">Processing</option>
                                        <option {{ request()->search ? request()->status == 3 ? 'selected' : '' : '' }}  value="3">Complete</option>
                                        {{-- <option {{ request()->search ? request()->status == 4 ? 'selected' : '' : '' }}  value="4">Delivered</option> --}}
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
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Distribution date</th>
                                <th scope="col">Order no</th>
                                <th scope="col">Item</th>
                                <th scope="col">Customer name</th>
                                <th scope="col">Master name</th>
                                <th scope="col">Worker name</th>
                                <th class="print-none " scope="col">Status</th>
                                <th scope="col">Complete date</th>

                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($distributions as $distribution)
                               <form action="{{route('distribution.status',$distribution->id)}}" method="GET">
                                 @csrf
                                 @method('PATCH')
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}.</th>
                                        <td>{{ $distribution->distribute_date->format('d M , Y')  }}</td>
                                        <td>{{ $distribution->orderDetails->customerOrder->order_no }}</td>
                                        <td>{{ $distribution->orderDetails->item->item_name}} <span class="fw-bold">({{$distribution->orderDetails->quantity}})</span></td>
                                        <td>{{ $distribution->orderDetails->customerOrder->customer->customer_name}}</td>
                                        <td>{{ $distribution->orderDetails->employee->employee_name ?? ''}}</td>
                                        <td>{{ $distribution->worker->worker_name ?? "" }}</td>
                                        <td >
                                            <div class="input-group">
                                                <input type="date" name='complete_date'
                                                    @if ($distribution->orderDetails->customerOrder->status == App\Models\CustomerOrder::STATUS_DELIVERY
                                                    || $distribution->status == App\Models\CustomerOrder::STATUS_COMPLETE)
                                                    value="{{ old('complete_date',$distribution->complete_date)}}" @endif class="form-control" required>

                                                    <!-- error -->
                                                    @error('complete_date')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror

                                                    {{-- <button class="btn btn-sm btn-success
                                                       @if ($distribution->orderDetails->customerOrder->status == App\Models\CustomerOrder::STATUS_DELIVERY)
                                                         disabled @endif " type="submit">
                                                        <i class="bi bi-arrow-left-circle"></i>
                                                    </button> --}}
                                            </div>
                                        </td>

                                        <td class="text-center print-none ">
                                            <button class=" btn btn-sm text-decoration-none w-75
                                                @if ($distribution->status == App\Models\Distribution::STATUS_DELIVERY )  btn-outline-secondary fw-bold
                                                @elseif ($distribution->status == App\Models\Distribution::STATUS_COMPLETE )  btn-success
                                                @elseif ($distribution->status == App\Models\Distribution::STATUS_PROCESSING) btn-info text-white
                                                @else btn-outline-primary
                                                @endif
                                                @if ($distribution->orderDetails->customerOrder->status == App\Models\CustomerOrder::STATUS_DELIVERY)
                                                disabled
                                                @endif
                                                "type="submit">
                                                {{$distribution->current_status}}
                                            </button>
                                        </td>

                                        <td class="print-none text-end">
                                            <a href="{{ route('distribution.show', $distribution->id) }}"
                                                class="btn table-small-button text-info"
                                                title="View"
                                                target="_blank" >
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('distribution.edit', $distribution->id) }}" class="btn table-small-button text-success
                                                @if ($distribution->orderDetails->customerOrder->status == App\Models\CustomerOrder::STATUS_DELIVERY)
                                                disabled @endif" title="Update"> <i class="bi bi-pencil-square"></i></a>

                                            {{-- <span data-bs-toggle="tooltip" title="Trash">
                                                <a href="#" class="btn table-small-button text-danger
                                                @if ($distribution->orderDetails->customerOrder->status != App\Models\CustomerOrder::STATUS_DELIVERY)
                                                disabled @endif"
                                                    onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('distribution-delete-{{ $distribution->id }}').submit() } return false ">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </span>

                                            <form action="{{ route('distribution.destroy', $distribution->id) }}" method="post" class="d-none" id="distribution-delete-{{ $distribution->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
                                        </td>
                                    </tr>
                               </form>
                            @empty
                                <tr>
                                    <th colspan="7">Distribute list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($distributions)->withQueryString()->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
