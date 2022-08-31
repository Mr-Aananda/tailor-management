<x-app-layout>
    <x-slot name="title">Worker Payments </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.payroll.worker-salary.menu')
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
                    <h4 class="main-title">Worker payments</h4>
                    <p><small>About {{ count($worker_salaries) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('worker-salary.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                            <!-- search -->
                <a href="#worker-salary-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('worker-salary.create') }}" class="btn top-icon-button print-none" title="Create new worker payment">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->
                <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="worker-salary-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <form action="{{ route('worker-salary.index') }}" method="GET" >
                            <input type="hidden" name="search" value="1">
                            <div class="row gy-1 gx-3">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="date" class="form-label">Date (From)</label>
                                    <input
                                    value="{{ (request()->search) ? request()->form_date : date('Y-m-d') }}"
                                    type="date"
                                    id="formdate"
                                    name="form_date"
                                    class="form-control"
                                    placeholder="YYYY-MM-DD">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="date" class="form-label">Date (To)</label>
                                    <input
                                    value="{{ (request()->search) ? request()->to_date : date('Y-m-d') }}"

                                    type="date"
                                    id="todate"
                                    name="to_date"
                                    class="form-control"
                                    placeholder="YYYY-MM-DD">
                                </div>
                                {{-- <div class="col-3">
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
                                                <option value="{{$worker->id}}">{{$worker->worker_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                 <div class="col-2">
                                    <label for="worker_name" class="form-label">Worker name</label>
                                    <input type="text" min="0"  name="worker_name" value="{{ request()->worker_name ?? '' }}" class="form-control"
                                        placeholder="Character only">
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
                                <th scope="col">Worker name</th>
                                <th scope="col">Mobile no</th>
                                <th scope="col" class="text-end">Amount</th>
                                <th scope="col" class="text-end">Bonus</th>
                                <th scope="col">Note</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($worker_salaries as $salary)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $salary->date->format('d F Y') }}</td>
                                    <td>{{ $salary->worker->worker_name }}</td>
                                    <td>{{ $salary->worker->mobile_no }}</td>
                                    <td class="text-end">{{ $salary->amount }}</td>

                                    <td class="text-end"> @if ($salary->bonus != 0)
                                           {{ $salary->bonus_amount }}
                                           <p><small>({{$salary->form_date}} - {{$salary->to_date}})</small></p>
                                        @endif
                                    </td>

                                    <td>{{ $salary->note }}</td>
                                    <td class="print-none text-end">
                                        {{-- <a href="{{ route('items.show', $item->id) }}" class="btn table-small-button text-info" title="View"><i class="bi bi-eye"></i></a> --}}
                                        <a href="{{ route('worker-salary.edit', $salary->id) }}" class="btn table-small-button text-success" title="Update"> <i class="bi bi-pencil-square"></i></a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button text-danger" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('salary-delete-{{ $salary->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('worker-salary.destroy', $salary->id) }}" method="post" class="d-none" id="salary-delete-{{ $salary->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4">Worker payments list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                         <tfoot>
                            <tr>
                                <th class="text-end" colspan="4">Total </th>
                                <th class="text-end">{{ number_format ($worker_salaries->sum('amount'),2) }} </th>
                                <th class="text-end">{{ number_format ($worker_salaries->sum('bonus_amount'),2) }} </th>
                                <th colspan="2">&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($worker_salaries)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
