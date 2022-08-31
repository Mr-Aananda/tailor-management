<x-app-layout>
    <x-slot name="title">Employee salary invoice </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.payroll.employee-salary.menu')
        <!-- container menu end -->

        <!-- print header -->
        @include('layouts.partials.printHead')
        <!-- print header end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 mb-3 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3 print-none">
                        <h4 class="main-title">Employee salary invoice</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    <a href="{{ route('employee-salary.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>

                           <!-- Print -->
                <a href="#" class="btn top-icon-button print-none mt-3" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>
                </div>

                <div class="p-0 card-body mt-5">
                        <!-- Client details -->
                        <div class="row mb-5">
                            <div class="col-4">
                                <div class="fs-5">
                                    <span> Salary to</span>
                                </div>
                                 <div>
                                     <span class="fw-bold">{{ $employeeSalary->employee->employee_name }}</span>
                                 </div>
                            </div>
                            <div class="col-5 ">
                                <div class="fs-6">
                                     Salary month :
                                    <span class="fw-bold">
                                            {{ $employeeSalary->salary_month->format('F Y') }}
                                    </span>
                                </div>
                                <div class="fs-6">
                                    Given date :
                                    <span class="fw-bold">
                                          {{ $employeeSalary->given_date }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="fs-5">
                                    <span>
                                        Total salary
                                    </span>
                                </div>

                                <div>
                                    <span class="fw-bold">
                                        {{ number_format(($employeeSalary['increment']) - ($employeeSalary['decrement']), 2) }} BDT
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{--<!-- End of the client details -->--}}

                        {{-- <!-- Terms and total -->--}}

                    <div class="row mt-5">
                        <div class="col-12 ">
                            <table class="table table-borderless">
                                <thead >
                                    <tr>

                                        <th scope="col" class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="text-end">
                                    <tr>
                                        @if($employeeSalary['basic_salary'] != null)
                                            <td>Basic salary</td>
                                            <td>{{ number_format($employeeSalary['basic_salary']->dtls_amount, 2) }}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($employeeSalary['bonus'] != null)
                                            <td>Bonus</td>
                                            <td>{{number_format($employeeSalary['bonus']->dtls_amount,2) }}</td>
                                        @endif
                                    </tr>

                                    <tr>
                                        @if($employeeSalary['installments'] != null)
                                            <td>Installment</td>
                                            <td> -{{number_format($employeeSalary['installments']->dtls_amount,2) }}</td>
                                        @endif
                                    </tr>

                                    <tr>
                                        @if($employeeSalary['deductions'] != null)
                                            <td>Deductions</td>
                                            <td> -{{number_format($employeeSalary['deductions']->dtls_amount,2) }}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tfoot class="text-end border-top">
                                    <th>Total</th>
                                    <th>{{ number_format(($employeeSalary['increment']) - ($employeeSalary['decrement']), 2) }} BDT</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>


                        {{--  <!-- Footer -->--}}
                    <div class="footer mt-5">
                        <div class="row">
                            <div class="col-6">
                                Employee sign
                            </div>
                            <div class="col-6 text-end">
                                Authorized sign
                            </div>
                        </div>
                    </div>
                    {{--  <!-- End of the footer -->--}}

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
