<x-app-layout>
    <x-slot name="title">Advance Salary details </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.payroll.advanced-salary.menu')
        <!-- container menu end -->

        <!-- print header -->
        @include('layouts.partials.printHead')
        <!-- print header end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 mb-3 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Advance details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    {{-- <a href="{{ route('advance-salary.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a> --}}
                </div>

                <div class="p-0 card-body">
                    <h5>Details for - {{$employee->employee_name}}</h5>
                    <!-- data table -->
                <div class="mb-3 table-responsive">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Date</th>
                                <th scope="col">Advanced</th>
                                <th scope="col">Installment</th>
                                <th scope="col">Pay</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                 $total_pay = 0;
                             @endphp
                            @forelse($advanced_salary_details as $details)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td class="text-right">{{ $details->created_at->format('d M-Y') }}</td>
                                    <td class="text-right">{{ number_format($details->amount, 2) }}</td>
                                    <td class="text-right">{{ number_format($details->installment, 2) }}</td>
                                    <td class="text-right">{{ number_format($details->advancedSalaryPaidDetails->sum('installment_pay'), 2) }}</td>
                                    @php
                                        $total_pay += $details->advancedSalaryPaidDetails->sum('installment_pay');
                                    @endphp
                                    <td class="print-none text-end">
                                        @if($details->is_paid != true)
                                             <a href="{{ route('advanced-salary.edit', $details->id) }}" class="btn table-small-button text-success" title="Update">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>


                                            <span data-bs-toggle="tooltip" title="Trash">
                                                <a href="#" class="btn table-small-button text-danger" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('salary-delete-{{ $details->id }}').submit() } return false ">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </span>

                                            <form action="{{ route('advanced-salary.destroy', $details->id) }}" method="post" class="d-none" id="salary-delete-{{ $details->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4">Advanced salary  details list is empty.</th>
                                </tr>
                            @endforelse

                             <tr>
                                <th class="text-right" colspan="2">Total </th>
                                <th class="text-right">{{ number_format($advanced_salary_details->sum('amount'), 2) }}</th>
                                <th></th>
                                <th class="text-right">{{ number_format($total_pay, 2) }}</th>
                                <th></th>
                                <th></th>
                           </tr>
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->



                </div>

            </div>
        </div>
    </div>
</x-app-layout>
