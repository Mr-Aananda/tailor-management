<x-app-layout>
    <x-slot name="title">Loan edit</x-slot>

    <div class="container">
        <!-- container menu -->
       @include('tailor.loan.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old loan</h4>
                    <p><small>Can edit an loan here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('loan.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('loan.update',$loan->id) }}" method="POST" accept-charset="utf-8">
                    @csrf
                    @method('PATCH')

                      {{-- loan date start --}}
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="date" class="mt-1 form-label required">Date</label>
                        </div>

                        <div class="col-3">
                            <input type="date" name="date" value="{{ old('date',$loan->date)}}" class="form-control" id="date" required>

                            <!-- error -->
                            @error('date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- loan date end --}}
                    {{-- select employee start --}}
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="employee_id" class="mt-1 form-label required">Select employee</label>
                        </div>

                        <div class="col-3">
                            <select name="employee_id" class="form-control" id="employee_id" required>
                                <option value="" selected disabled>--</option>

                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ (old('employee_id', $loan->employee_id) == $employee->id) ? 'selected' : '' }}>
                                    {{ $employee->employee_name }}
                                </option>
                            @endforeach
                            </select>

                                <!-- error -->
                            @error('employee_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                      {{-- select employee end --}}

                      {{-- amount start --}}
                     <div class="mb-3 row">
                        <div class="col-2">
                            <label for="amount" class="mt-1 form-label required">Amount</label>
                        </div>

                        <div class="col-3">
                           <div class="input-group">
                               <div class="col-4">
                                    <select name="payment_type" class="form-control" id="payment_type" required>
                                        <option value="cash" {{ $loan->payment_type == 'cash' ? 'selected' : '' }} >Cash</option>
                                    </select>
                               </div>
                            <input type="number" name="amount" value="{{ old('amount', $loan->amount)}}" class="form-control" id="amount" placeholder="0.00" required>

                            <!-- error -->
                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                           </div>
                        </div>
                    </div>
                    {{-- amount end --}}

                    {{-- loan expire date start --}}
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="expire_date" class="mt-1 form-label required">Expired date</label>
                        </div>

                        <div class="col-3">
                            <input type="date" name="expire_date" value="{{ old('expire_date', $loan->expire_date)}}" class="form-control" id="expire_date" required>

                            <!-- error -->
                            @error('expire_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- loan expire date end --}}

                    {{-- select cash start --}}
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="cash-id" class="mt-1 form-label">&nbsp;</label>
                        </div>

                        <div class="col-3">
                            <select name="cash_id" class="form-control" id="cash-id" required>
                                {{-- <option value="" >--</option> --}}
                            @foreach ($cashes as $cash)
                                <option value="{{ $cash->id }}" {{ (old('cash_id', $loan->cash_id) == $cash->id) ? 'selected' : '' }}>
                                    {{ $cash->cash_name }}
                                </option>
                            @endforeach
                            </select>

                                <!-- error -->
                            @error('employee_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                      {{-- select cash start end --}}

                    <!-- Description start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="note" class="mt-1 form-label">Note</label>
                        </div>

                        <div class="col-4">
                            <textarea name="note" class="form-control" id="note" rows="2"
                                placeholder="Optional">{{ old('note',$loan->note)}}</textarea>

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


