<x-app-layout>
    <x-slot name="title">Employee salary </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.payroll.employee-salary.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create new employee salary</h4>
                    <p><small>Can create <strong>employee salary</strong> from here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('employee-salary.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('employee-salary.store') }}" method="POST">
                    @csrf
                    {{-- React Component start--}}
                    <div>
                     @php
                        $all_errors = [];
                        // number errors
                        if ($errors->has('employee_id')) {
                            $all_errors['employee_id'] = $errors->get('employee_id');
                        }
                         if ($errors->has('salary_month')) {
                            $all_errors['salary_month'] = $errors->get('salary_month');
                        }
                         if ($errors->has('given_date')) {
                            $all_errors['given_date'] = $errors->get('given_date');
                        }
                         if ($errors->has('basic_salary')) {
                            $all_errors['basic_salary'] = $errors->get('basic_salary');
                        }
                        if ($errors->has('bonus')) {
                            $all_errors['bonus'] = $errors->get('bonus');
                        }
                        if ($errors->has('installments')) {
                            $all_errors['installments'] = $errors->get('installments');
                        }
                        if ($errors->has('deductions')) {
                            $all_errors['deductions'] = $errors->get('deductions');
                        }
                          if ($errors->has('cash_id')) {
                            $all_errors['cash_id'] = $errors->get('cash_id');
                        }

                          if ($errors->has('payment_type')) {
                            $all_errors['payment_type'] = $errors->get('payment_type');
                        }

                    @endphp

                    <div
                    data-records="{{ $records  }}"
                    data-cashes="{{ $cashes  }}"
                    data-employee-salary="{{ json_encode([]) }}"
                    data-errors="{{ json_encode($all_errors) }}"
                    data-selected-employee-id="{{ request()->id }}"
                    id="employee-salary-create"></div>
                    </div>

                    {{-- <pre>
                        {{ print_r($errors->get('bonus')) }}
                    </pre> --}}

                     {{-- React Component start--}}

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label class="mt-1 form-label">&nbsp;</label>
                        </div>

                        <div class="col-10">
                            <button type="reset" class="btn btn-warning me-2">
                                <i class="bi bi-dash-square"></i>
                                <span class="p-1">Reset</span>
                            </button>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-square"></i>
                                <span class="p-1">Save</span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
