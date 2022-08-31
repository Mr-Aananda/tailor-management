<x-app-layout>
    <x-slot name="title">Advanced salary </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.payroll.advanced-salary.menu')
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
                    <h4 class="main-title">Advanced salary</h4>
                    <p><small>About {{ count($advanced_salaries) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('advanced-salary.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- add -->
                <a href="{{ route('advanced-salary.create') }}" class="btn top-icon-button print-none" title="Create new advanced">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->

                <!-- search area end -->

                <!-- data table -->
                <div class="mb-3 table-responsive">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Employee name</th>
                                <th scope="col">Phone no</th>
                                <th scope="col">Advanced</th>
                                <th scope="col">Pay</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($advanced_salaries as $salary)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $salary->employee->employee_name }}</td>
                                    <td>{{ $salary->employee->mobile_no  }}</td>
                                    <td class="text-right">{{ number_format($salary->advancedSalaryDetails->sum('amount'), 2) }}</td>
                                     @php
                                        $total_pay = 0;
                                    @endphp
                                    <td class="text-right">
                                        @foreach($salary->advancedSalaryDetails as $details)
                                            @php
                                                $total_pay += $details->advancedSalaryPaidDetails->sum('installment_pay')
                                            @endphp
                                        @endforeach

                                        {{ number_format($total_pay, 2) }}
                                    </td>

                                    <td class="print-none text-end">
                                        <a href="{{ route('advanced-salary.show', $salary->id) }}" class="btn table-small-button text-info" title="View"><i class="bi bi-eye"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="6">Advanced salary list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($advanced_salaries)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
