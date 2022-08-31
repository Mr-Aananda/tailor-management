<x-app-layout>
    <x-slot name="title">Payment edit </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.due-payments.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old payment</h4>
                    <p><small>Can edit a payment here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('due-payments.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('due-payments.update',$paymentDetails->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- type text -->

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label class="mt-1 form-label required">Date</label>
                        </div>

                        <div class="col-3">
                            <input type="date" name='date' value="{{$paymentDetails->date->format('Y-m-d')}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2 ">
                            <label for="paid" class="mt-1 form-label required">Paid</label>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <div class="col-4">
                                    <select name="payment_type" class="form-control" id="item-part" required>
                                        {{-- <option value="" selected disabled>--</option> --}}
                                            {{-- @foreach ($paymentTypes as $paymentType)
                                                <option value="{{ $paymentType->id }}" {{ (old('payment_type_id',$paymentDetails->payment_type_id) == $paymentType->id) ? 'selected' : '' }}>
                                                    {{ $paymentType->name }}
                                                </option>
                                            @endforeach --}}
                                            <option value="{{$paymentDetails->payment_type}}">Cash</option>
                                    </select>
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <input type="number" name="total_paid" value="{{ $paymentDetails->total_paid }}" class="form-control" placeholder="0.00" id="paid" aria-describedby="button-addon-paid" required>
                                    </div>

                                    <!-- error -->
                                    @error('total_paid')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="mb-3 row">
                                <div class="col-2 ">
                                    <label for="paid" class="mt-1 form-label">&nbsp;</label>
                                </div>
                                <div class="col-4">
                                    <select name="cash_id" class="form-control" id="cash_id" required>
                                        {{-- <option value="" selected disabled>--</option> --}}
                                            @foreach ($cashes as $cash)
                                                <option value="{{ $cash->id }}" {{ (old('cash_id',$paymentDetails->cash_id ) == $cash->id) ? 'selected' : '' }}>
                                                    {{ $cash->cash_name }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>

                            </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="adjustment" class="mt-1 form-label">Adjustment</label>
                        </div>

                        <div class="col-4">
                            <div class="input-group">
                                <input type="number" name="adjustment" value="{{ $paymentDetails->adjustment}}" class="form-control" placeholder="0.00" id="adjustment" aria-describedby="button-addon-adjustment">
                            </div>

                            <!-- error -->
                            @error('paid')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="description" class="mt-1 form-label">Description</label>
                        </div>

                        <div class="col-6">
                            <textarea name="description" class="form-control" id="note" rows="3" placeholder="Optional">{{  $paymentDetails->description }}</textarea>
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
