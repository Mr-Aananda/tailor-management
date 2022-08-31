<x-app-layout>
    <x-slot name="title">Loans</x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.loan.menu')
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
                    <h5 class="main-title">Employee name : {{$loan->employee->employee_name}} </h5> <br>
                    <h5 class="main-title">Mobile no : {{$loan->employee->mobile_no}} </h5>

                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('loan.show',$loan->id) }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- add -->
                {{-- <a href="{{ route('loan.show',$loan->id) }}" class="btn top-icon-button print-none" title="Create new loan installment">
                    <i class="bi bi-plus-circle"></i>
                </a> --}}
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                    <h4 class="text-center text-muted print-none">Installments
                         <a href="{{ route('loan.paid', $loan->id) }}" class="btn btn-sm  btn-success" title="Installment"> <i class="bi bi-cash"></i></a>

                    </h4>
                <!-- search area -->

                <!-- search area end -->

                <!-- data table -->
                <div class="mb-3 table-responsive">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Date</th>
                                {{-- <th scope="col">Employee name</th>
                                <th scope="col">Phone no</th> --}}
                                <th scope="col">Paid</th>
                                <th scope="col">Adjustment</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($loan->loanInstallments as $installment)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $installment->date}}</td>
                                    {{-- <td>{{ $loan->employee->employee_name }}</td>
                                    <td>{{ $loan->employee->mobile_no  }}</td> --}}
                                    <td>{{ number_format($installment->amount, 2) }}</td>
                                    <td>{{ number_format($installment->adjustment, 2) }}</td>

                                    <td class="print-none text-end">
                                        {{-- <a href="{{ route('loan.show', $loan->id) }}" class="btn table-small-button text-secondary" title="View" target="_blank"><i class="bi bi-cash"></i></a> --}}
                                        <a href="{{ route('loan-installment.edit', $installment->id) }}" class="btn table-small-button text-success" title="Installment"> <i class="bi bi-pencil-square"></i></a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button text-danger {{ $loan->loan_installments_count > 0 ? 'disabled' : '' }}" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('loanInstallment-delete-{{ $installment->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('loan-installment.destroy', $installment->id) }}" method="post" class="d-none" id="loanInstallment-delete-{{ $installment->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="7">Loan installment list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                {{-- <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($loan)->links() }}
                    </nav>
                </div> --}}
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>

</x-app-layout>
