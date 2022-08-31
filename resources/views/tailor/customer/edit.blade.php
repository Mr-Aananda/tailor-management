<x-app-layout>
    <x-slot name="title">Customer Edit </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.customer.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old customer</h4>
                    <p><small>Can edit an customer here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('customer.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('customer.update',$customer->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="customer-name" class="mt-1 form-label required">Customer name</label>
                        </div>

                        <div class="col-4">
                            <input type="text" name="customer_name" class="form-control" id="customer-name" value="{{ $customer->customer_name }}" placeholder="Characters only"
                                required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="mobile-no" class="mt-1 form-label required">Mobile no</label>
                        </div>

                        <div class="col-3">
                            <input type="number" name="mobile_no" class="form-control" id="mobile-no" value="{{ $customer->mobile_no }}" placeholder="Numbers only"
                                required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="balance" class="mt-1 form-label required">Balance</label>
                        </div>

                        <div class="col-3">
                            <input type="number" name="balance" value="{{abs($customer->balance) }}" class="form-control" id="balance" min="0" placeholder="0.00" required>
                        </div>

                        <div class="col-2">
                            <select name="balance_status" class="form-select" aria-label="Default select example">
                                <option value="0"  {{$customer->balance < 0 ? 'selected':''}} >Payable</option>
                                <option value="1" {{$customer->balance >= 0 ? 'selected':''}} >Recieveable</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="address" class="mt-1 form-label">Address</label>
                        </div>

                        <div class="col-5">
                            <textarea name="address" class="form-control" id="address" rows="3" placeholder="Optional">{{ $customer->address }}</textarea>
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
