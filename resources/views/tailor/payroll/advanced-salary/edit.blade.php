<x-app-layout>
    <x-slot name="title">Advanced salary Edit </x-slot>

    <div class="container">
        <!-- container menu -->
       @include('tailor.payroll.advanced-salary.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old advanced salary</h4>
                    <p><small>Can edit an advanced salary here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('advanced-salary.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('advanced-salary.update',$advanced_salary_details->id) }}" method="POST" accept-charset="utf-8">
                    @csrf
                    @method('PATCH')

                      {{-- amount start --}}
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="amount" class="mt-1 form-label required">Amount</label>
                        </div>
                            <div class="col-3">
                               <div class="input-group">
                                    <div class="col-4">
                                        <select name="payment_type" class="form-control" id="payment_type" required>
                                            <option value="cash" {{ $advanced_salary_details->payment_type == 'cash' ? 'selected' : '' }} >Cash</option>
                                        </select>
                                    </div>

                                    <input type="number" name="amount" value="{{ old('amount',$advanced_salary_details->amount)}}" class="form-control" id="amount" placeholder="Number only" required>

                                    <!-- error -->
                                    @error('amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                               </div>
                            </div>
                    </div>
                    {{-- amount end --}}
                    {{-- select cash start --}}
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="cash-id" class="mt-1 form-label">&nbsp;</label>
                        </div>

                        <div class="col-3">
                            <select name="cash_id" class="form-control" id="cash-id" required>
                                {{-- <option value="" >--</option> --}}
                            @foreach ($cashes as $cash)
                                <option value="{{ $cash->id }}" {{ (old('cash_id', $advanced_salary_details->cash_id) == $cash->id) ? 'selected' : '' }} > {{ $cash->cash_name }}</option>
                            @endforeach
                            </select>

                                <!-- error -->
                            @error('employee_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                      {{-- select cash start end --}}

                     {{-- Installment start --}}
                     <div class="mb-3 row">
                        <div class="col-2">
                            <label for="installment" class="mt-1 form-label required">Installment amount</label>
                        </div>

                        <div class="col-3">
                            <input type="number" name="installment" value="{{ old('installment',$advanced_salary_details->installment)}}" class="form-control" id="installment" placeholder="Number only" required>

                            <!-- error -->
                            @error('installment')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- Installment end --}}

                    <!-- Description start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="note" class="mt-1 form-label">Note</label>
                        </div>

                        <div class="col-4">
                            <textarea name="note" class="form-control" id="note" rows="2"
                                placeholder="Optional">{{ old('note',$advanced_salary_details->note)}}</textarea>

                                <!-- error -->
                                @error('note')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                        </div>
                    </div>
                    <!-- Description end-->

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

