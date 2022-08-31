<x-app-layout>
    <x-slot name="title">Employee salary </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.payroll.employee-salary.menu')
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
                    <h4 class="main-title">Employee salary sheet</h4>
                    <p><small>About {{ count($employees) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('employee-salary.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                  <!-- search -->
                <a href="#employee-salary-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('employee-salary.create') }}" class="btn top-icon-button print-none" title="Create new employee salary">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->
                 <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="employee-salary-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <form action="{{ route('employee-salary.index') }}" method="GET" >
                            <input type="hidden" name="search" value="1">
                            <div class="row gy-1 gx-3">
                                <div class="col-6">
                                    <label for="from-date" class="form-label">Month</label>
                                    <input type="month" name="month" class="form-control"
                                        placeholder="Enter month" required>
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
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone no</th>
                                <th scope="col">Salary</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($employees as $employee)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $employee->employee_name }}</td>
                                    <td>{{ $employee->mobile_no }}</td>

                                    <td>
                                        @if($employee->last_month_paid_status)
                                            <span class="badge bg-success px-3 py-2">Paid</span>
                                        @else
                                            <a href="{{ route('employee-salary.salaryPay', $employee->id) }}"
                                                class="btn btn-sm btn-danger text-decoration-none" target="__blank"

                                                >Unpaid</a>
                                        @endif
                                    </td>

                                    <td class="print-none text-end">
                                        @if($employee->last_month_paid_status)
                                            {{-- <a href="{{ (request()->search) ? route('employee-salary.edit', $employee->employeeSalaries->last()['id']) : route('employee-salary.edit', $employee->employeeSalaries->last()['id']) }}" class="btn table-small-button text-success"
                                            title="view last salary details.">
                                                <i class="bi bi-pencil-square"></i>
                                            </a> --}}

                                            <a href="{{ (request()->search) ? route('employee-salary.show', $employee->employeeSalaries->last()['id']) : route('employee-salary.show', $employee->employeeSalaries->last()['id']) }}" class="btn table-small-button text-info"
                                            title="view last salary details.">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4">Employee salary list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                {{-- <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($employees)->links() }}
                    </nav>
                </div> --}}
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
