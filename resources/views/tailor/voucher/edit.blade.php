<x-app-layout>
    <x-slot name="title">Voucher Edit </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.voucher.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old voucher</h4>
                    <p><small>Can edit an voucher here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('voucher.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('voucher.update',$voucher->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="name" class="mt-1 form-label required">Company/Person name</label>
                        </div>

                        <div class="col-3">
                            <input type="text" name="name" value="{{ old('name',$voucher->name)}}" class="form-control" id="name" placeholder="Characters only" required>

                            <!-- error -->
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="voucher-number" class="mt-1 form-label required">Voucher number</label>
                        </div>

                        <div class="col-3">
                            <input type="text" name="voucher_number" value="{{ $voucher->voucher_number}}" class="form-control" id="voucher_number" readonly>

                            <!-- error -->
                            @error('voucher_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="discount" class="mt-1 form-label required">Discount</label>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <div class="col-4">

                                    <select name="discount_type" class="form-control" id="discount" required>
                                            <option value="">--</option>
                                            <option value="flat" {{ $voucher->discount_type == 'flat' ? 'selected' : ''}}>Flat</option>
                                            <option value="percentage" {{ $voucher->discount_type == 'percentage' ? 'selected' : ''}}>Percentage</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <input type="number" name="discount" value="{{ old('discount',$voucher->discount) }}" class="form-control" placeholder="0.00" id="discount" aria-describedby="button-addon-paid" required>
                                    </div>

                                    <!-- error -->
                                    @error('discount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="description" class="mt-1 form-label">Description</label>
                        </div>

                        <div class="col-5">
                            <textarea name="description" class="form-control" id="note" rows="3"
                                placeholder="Optional">{{ old('description',$voucher->description)}}</textarea>

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
