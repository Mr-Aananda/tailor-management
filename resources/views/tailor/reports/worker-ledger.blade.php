<x-app-layout>
    <x-slot name="title">Worker ledger</x-slot>

    <div class="container">

        <!-- card start -->
        <div class="border-0 card">
            <!-- card head -->
            <div class="p-0 border-0 card-header d-md-flex align-items-center d-block">
                <!-- page title -->
                <div class="mt-3 mb-2">
                    <h4 class="main-title">Worker ledger</h4>
                    <p><small>About {{ count($worker_ledgers) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('ledger-report.worker') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->
                <div class="print-none {{ request()->search ? 'show' : '' }}" id="workerLedger-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <form action="{{ route('ledger-report.worker') }}" method="GET" >
                            <input type="hidden" name="search" value="1">
                            <div class="row gy-1 gx-3">
                                <div class="col-3">
                                    <label for="date" class="form-label">Date (From)</label>
                                    <input
                                    value="{{ (request()->search) ? request()->form_date : date('Y-m-d') }}"
                                    type="date"
                                    id="formdate"
                                    name="form_date"
                                    class="form-control"
                                    placeholder="YYYY-MM-DD">
                                </div>
                                <div class="col-3">
                                    <label for="date" class="form-label">Date (To)</label>
                                    <input
                                    value="{{ (request()->search) ? request()->to_date : date('Y-m-d') }}"

                                    type="date"
                                    id="todate"
                                    name="to_date"
                                    class="form-control"
                                    placeholder="YYYY-MM-DD">
                                </div>

                                <div class="col-3">
                                    <label for="id_label_single" class="form-label">Worker name</label>
                                    <div class="custom-select2">
                                        <select
                                            class="js-example-basic-single js-states js-example-responsive form-select"
                                            style="width: 100%"
                                            id="id_label_single"
                                            name="worker_id"
                                            data-placeholder="Select worker name"
                                            data-allow-clear="true">

                                            <option value=""></option>
                                            @foreach ($workers as $worker )
                                                <option {{ request()->search ? request()->worker_id == $worker->id ? 'selected' : '' : '' }} value="{{$worker->id}}">{{$worker->worker_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

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
                @if (request()->search)
                    <div class="mb-3 table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Particular</th>
                                    <th scope="col">Items</th>
                                    <th scope="col"  class="text-end">Debit</th>
                                    <th scope="col"  class="text-end">Credit</th>
                                    <th scope="col"  class="text-end">Balance</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>

                                    <th colspan="5" class="text-center">Opening balance</th>
                                    <th colspan="4" class="text-end">
                                         @php
                                            $opening_balance = 0;
                                            $balance = 0;
                                        @endphp
                                        @if($total_debit > $total_credit)
                                            @php
                                                $opening_balance = $worker_balance - ($total_debit - $total_credit) ;
                                                $balance = $opening_balance;
                                            @endphp
                                        @else
                                            @php
                                                $opening_balance = $worker_balance + ($total_credit - $total_debit) ;
                                                $balance = $opening_balance;
                                            @endphp
                                        @endif

                                        {{ number_format(abs($opening_balance), 2) }} {{$opening_balance>= 0 ? 'Rec' : 'Pay' }}

                                    </th>
                                </tr>
                             @forelse ($worker_ledgers as $ledger)
                             <tr>
                                <td>{{ $loop->iteration + 1 }}</td>

                                <td>
                                     @if ($ledger->type === 'complete_order')
                                            {{$ledger->distribute_date->format('d F Y')}}
                                     @else
                                            {{$ledger->date->format('d F Y')}}
                                    @endif
                                </td>

                                <td>
                                     @if ($ledger->type === 'complete_order')
                                            Service recieve by due
                                    @else
                                        {{ $ledger->note ?? "Pay on cash" }}
                                    @endif
                                </td>

                                <td>
                                     @if ($ledger->type === 'complete_order')
                                            {{$ledger->orderDetails->item->item_name}} <span class="fw-bold"> ({{$ledger->orderDetails->quantity}}) </span>
                                     @else
                                            --
                                    @endif
                                </td>

                                 <td  class="text-end">
                                         @if ($ledger->type === 'worker_payment')
                                            {{ $ledger->amount}}
                                        @else
                                            {{ number_format(0, 2) }}
                                        @endif
                                </td>

                                <td  class="text-end">
                                    @if ($ledger->type === 'complete_order')
                                        {{$ledger->orderDetails->item->worker_cost * $ledger->orderDetails->quantity}}
                                    @else
                                        {{ number_format(0, 2)}}
                                    @endif
                                </td>

                                <td  class="text-end">
                                    @php
                                        if ($ledger->type === 'complete_order') {
                                            $balance -= ( $ledger->orderDetails->item->worker_cost * $ledger->orderDetails->quantity );
                                        }
                                        else {
                                                $balance += ($ledger->amount);
                                        }

                                    @endphp
                                        {{ number_format(abs($balance), 2) }} {{ $balance >= 0 ? 'Rec' : 'Pay' }}

                                </td>
                            </tr>

                            @empty

                            @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif

                <!-- data table end -->
            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
    @push('script')
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();

        });

    </script>
  @endpush

@push('style')
    <style>
        .custom-select2 .select2-selection{
            height: 37px!important;
            border-radius: 2px!important;
            border: 1px solid #ced4da!important;
        }
        .custom-select2 .select2-selection .select2-selection__rendered{
            line-height: 37px!important;
            font-size: 14px!important;
            padding-left: 10px!important;
        }
        .custom-select2 .select2-selection .select2-selection__arrow{
            height: 37px!important;
        }
    </style>
@endpush
</x-app-layout>

