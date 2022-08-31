<x-app-layout>
    <x-slot name="title">Due Payment </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.due-payments.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">New payment</h4>
                    <p><small>Can receive due payment from here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('due-payments.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <div class="row">
                    <div class="col-8">
                         <!-- search customer order by order no-->
                        {{-- <form action="{{ route('due-payments.create') }}" method="GET" class="mb-5">
                            <div class="row">
                                <div class="col-2">
                                    <label for="order-no" class="mt-1 form-label required">Order no</label>
                                </div>

                                <div class="col-8">
                                    <div class="input-group">
                                        <input type="text" name="mobile_no" value="{{request()->mobile_no ?? ''}}" class="form-control" placeholder="Order no" id="order-no" aria-describedby="button-addon-roll" autofocus required>

                                        <button class="btn btn-outline-success" type="submit" id="button-addon-roll">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>

                                    <small class="text-muted">Please enter valid customer order no.</small>
                                </div>
                            </div>
                        </form> --}}
                        <!-- search student by roll end -->

                        <!-- payment -->
                        <form action="{{ route('due-payments.store') }}" method="POST">
                            @csrf

                            @if ($customerOrder)
                                <input type="hidden" name="customer_order_id" value="{{ $customerOrder->id }}">
                            @endif

                            <div class="mb-3 row">
                                <div class="col-2">
                                    <label class="mt-1 form-label required">Date</label>
                                </div>

                                <div class="col-4">
                                    <input type="date" name='date' value="{{ old('date')}}" class="form-control" required>
                                </div>

                                   <!-- error -->
                                    @error('date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>

                            <div class="mb-3 row">
                                <div class="col-2 ">
                                    <label for="paid" class="mt-1 form-label required">Paid</label>
                                </div>
                                <div class="col-5">
                                    <div class="input-group">
                                        <div class="col-4">
                                            <select name="payment_type" class="form-control" id="item-part" required>
                                                {{-- <option value="" selected disabled>--</option> --}}
                                                    {{-- @foreach ($paymentTypes as $paymentType)
                                                        <option value="{{ $paymentType->id }}" {{ (old('payment_type_id') == $paymentType->id) ? 'selected' : '' }}>
                                                            {{ $paymentType->name }}
                                                        </option>
                                                    @endforeach --}}
                                                    <option value="cash">Cash</option>
                                            </select>
                                        </div>
                                     <div class="col-8">
                                         <div class="input-group">
                                             <input type="number" name="total_paid" value="{{ old('total_paid') }}" class="form-control" placeholder="0.00" id="paid" aria-describedby="button-addon-paid" required>
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
                                <div class="col-5">
                                    <select name="cash_id" class="form-control" id="cash_id" required>
                                        {{-- <option value="" selected disabled>--</option> --}}
                                            @foreach ($cashes as $cash)
                                                <option value="{{ $cash->id }}" {{ (old('cash_id') == $cash->id) ? 'selected' : '' }}>
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

                                <div class="col-5">
                                    <div class="input-group">
                                        <input type="number" name="adjustment" value="{{ old('adjustment') }}" class="form-control" placeholder="0.00" id="adjustment" aria-describedby="button-addon-adjustment">
                                    </div>

                                    <!-- error -->
                                    @error('adjustment')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-2">
                                    <label for="description" class="mt-1 form-label">Description</label>
                                </div>

                                <div class="col-7">
                                    <textarea name="description" class="form-control" id="note" rows="3" placeholder="Optional">{{ old('description') }}</textarea>
                                </div>
                            </div>



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
                        <!-- payment end -->
                    </div>

                    <!-- information -->
                    <div class="col-4">
                        @if ($customerOrder)
                            <h5>{{$customerOrder->customer->customer_name}}</h5>
                            <small>Delivery Date: {{$customerOrder->delivery_date->format('d M , Y')}}</small>
                            <small class="mb-2 d-block">Last payment: {{$customerOrder->date->format('d M , Y')}} | Phone: {{$customerOrder->customer->mobile_no}}</small>
                             <p class="mb-2 fw-bold">Order no: {{$customerOrder->order_no}} </p>

                            <figure>
                                <h5 class="mb-3">Payments History</h5>
                                <table class="table table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th  class="text-end" scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="text-end" >{{ number_format($customerOrder->sub_total, 2) }}</td>
                                        </tr>
                                        @if ($customerOrder->total_discount!=0)
                                        <tr>
                                            <td>Discount</td>
                                            <td class="text-end" >{{ number_format($customerOrder->total_discount, 2) }}</td>
                                        </tr>

                                        @endif
                                        @if ($customerOrder->voucher_amount!=0)
                                        <tr>
                                            <td>Voucher discount</td>
                                            <td class="text-end" >{{ number_format($customerOrder->voucher_amount, 2) }}</td>
                                        </tr>

                                        @endif

                                        <tr>
                                            <td>Grand total</td>
                                            <td class="text-end" >{{ number_format($customerOrder->grand_total, 2) }}</td>
                                        </tr>

                                        <tr>
                                            <td>Total paid</td>
                                            <td class="text-end" >{{ number_format($customerOrder->paymentDetails->sum("total_paid"), 2) }}</td>
                                        </tr>
                                        @if ($customerOrder->paymentDetails->sum("adjustment")!=0)
                                        <tr>
                                            <td>Adjustment</td>
                                            <td class="text-end" >{{ number_format($customerOrder->paymentDetails->sum("adjustment"), 2) }}</td>
                                        </tr>

                                        @endif


                                    </tbody>

                                    <tfoot>
                                        <tr  class="border-top">
                                            <th>Total due </th>
                                            <th class="text-end">{{ number_format($customerOrder->total_due,2)}}</th>
                                            <th colspan="1">&nbsp;</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </figure>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
