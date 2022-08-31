<x-app-layout>
    <x-slot name="title">Employee </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.employee.menu')
        <!-- container menu end -->

        <!-- print header -->
        @include('layouts.partials.printHead')
        <!-- print header end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 mb-3 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Employee details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    <a href="{{ route('employee.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>

                <div class="p-0 card-body">

                   <div class="mb-3 row">
                        <div class="col-2">
                            <dt for="date" class="mt-1 form-label">Joining Date </dt>
                        </div>

                        <div class="col-6">
                            <dd class="fst-italic text-muted">{{ $employee->created_at->format('d F Y') }}</dd>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <dt for="employee-name" class="mt-1 form-label">Employee name </dt>
                        </div>

                        <div class="col-6">
                            <dd class="fst-italic text-muted">{{ $employee->employee_name}}</dd>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <dt for="employee-role" class="mt-1 form-label">Role</dt>
                        </div>

                        <div class="col-6">
                            <dd class="fst-italic text-muted">{{ $employee->employee_role}}</dd>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <dt for="mobile-no" class="mt-1 form-label">Mobile no </dt>
                        </div>

                        <div class="col-6">
                            <dd class="fst-italic text-muted">{{ $employee->mobile_no}}</dd>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <dt for="salary" class="mt-1 form-label">Basic salary </dt>
                        </div>

                        <div class="col-6">
                            <dd class="fst-italic text-muted">{{$employee->basic_salary}}</dd>
                        </div>
                    </div>

                     <div class="mb-3 row">

                        @if ($employee->nid_number !== null)
                            <div class="col-2">
                                <dt for="nid_number" class="mt-1 form-label">NID number </dt>
                            </div>

                            <div class="col-6">
                                <dd class="fst-italic text-muted">{{ $employee->nid_number }}</dd>
                            </div>

                        @endif
                    </div>

                    <div class="mb-3 row">

                        @if ($employee->address !== null)
                            <div class="col-2">
                                <dt for="address" class="mt-1 form-label">Address </dt>
                            </div>

                            <div class="col-6">
                                <dd class="fst-italic text-muted">{{ $employee->address }}</dd>
                            </div>

                        @endif
                    </div>

                    <div class="mb-3 row">

                        @if ($employee->description!==null)
                            <div class="col-2">
                                <dt for="description" class="mt-1 form-label">Description </dt>
                            </div>

                            <div class="col-6">
                                <dd class="fst-italic text-muted">{{ $employee->description }}</dd>
                            </div>

                        @endif
                    </div>


                </div>

            </div>
        </div>
    </div>
</x-app-layout>
