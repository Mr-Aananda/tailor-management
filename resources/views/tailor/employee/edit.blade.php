<x-app-layout>
    <x-slot name="title">Employee Edit </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.employee.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old employee</h4>
                    <p><small>Can edit an employee here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('employee.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('employee.update',$employee->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="employee-name" class="mt-1 form-label required">Employee name</label>
                        </div>

                        <div class="col-4">
                            <input type="text" name="employee_name" value="{{ $employee->employee_name }}" class="form-control" id="employee-name" placeholder="Characters only" required>

                            <!-- error -->
                            @error('employee_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="employee-role" class="mt-1 form-label required">Select role</label>
                        </div>

                        <div class="col-3">
                            <select name="employee_role" class="form-control" id="employee-role" required>
                                <option value="" selected disabled>--</option>
                                @foreach ($employees_role as $role)
                                    <option value="{{ $role }}" {{ (old('employee_role',$employee->employee_role ) == $role) ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>

                                <!-- error -->
                            @error('employee_role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="mobile-no" class="mt-1 form-label required">Mobile no</label>
                        </div>

                        <div class="col-3">
                            <input type="number" name="mobile_no" value="{{ $employee->mobile_no }}" class="form-control" id="mobile_no" placeholder="Number only" required>

                            <!-- error -->
                            @error('mobile_no')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2 ">
                            <label for="basic-salary" class="mt-1 form-label required">Basic Salary</label>
                        </div>
                        <div class="col-3">
                            <input type="number" name="basic_salary" value="{{ $employee->basic_salary }}" class="form-control" id="basic-salary" placeholder="0.00" required>

                            <!-- error -->
                            @error('basic_salary')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="nid-number" class="mt-1 form-label">NID number</label>
                        </div>

                        <div class="col-3">
                            <input type="number" name="nid_number" value="{{  $employee->nid_number }}" class="form-control" id="nid-number" placeholder="Number only">

                            <!-- error -->
                            @error('mobile_no')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="address" class="mt-1 form-label">Address</label>
                        </div>

                        <div class="col-5">
                            <textarea name="address" class="form-control" id="note" rows="2"
                                placeholder="Optional">{{ $employee->address }}</textarea>

                                <!-- error -->
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="description" class="mt-1 form-label">Description</label>
                        </div>

                        <div class="col-6">
                            <textarea name="description" class="form-control" id="description" rows="3"
                                placeholder="Optional">{{ $employee->description }}</textarea>

                                <!-- error -->
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <div class="col-2">
                            <label class="mt-1 form-label"> &nbsp;</label>
                        </div>

                        <div class="col-10">
                            <button type="reset" class="btn btn-warning me-2">
                                <i class="bi bi-dash-square"></i>
                                <span class="p-1">Reset</span>
                            </button>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-square"></i>
                                <span class="p-1">Update</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
