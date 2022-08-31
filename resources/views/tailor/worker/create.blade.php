
<x-app-layout>
    <x-slot name="title">Worker</x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.worker.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create new worker</h4>
                    <p><small>Can create <strong>worker</strong> from here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('worker.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('worker.store') }}" method="POST">
                    @csrf

                    <!-- worker name start -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="worker-name" class="mt-1 form-label required">Worker name</label>
                        </div>

                        <div class="col-4">
                            <input type="text" name="worker_name" value="{{ old('worker_name')}}" class="form-control" id="worker-name" placeholder="Characters only" required>

                            <!-- error -->
                            @error('worker_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- worker name end -->

                    <!-- worker mobile no start -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="mobile-no" class="mt-1 form-label required">Mobile no</label>
                        </div>

                        <div class="col-4">
                            <input type="text" name="mobile_no" value="{{ old('mobile_no')}}" class="form-control" id="worker-name" placeholder="Numbers only" required>

                            <!-- error -->
                            @error('mobile_no')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- worker mobile no end -->

                    <!-- worker balance start -->
                    <div class="mb-3 row">
                        <div class="col-2 ">
                            <label for="balance" class="mt-1 form-label">Balance</label>
                        </div>
                        <div class="col-2">
                            <input type="number" name="balance" value="{{ old('balance')}}" class="form-control" id="balance" min="0" placeholder="0.00">

                            <!-- error -->
                            @error('balance')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-2">
                            <select name="balance_status" class="form-select" aria-label="Default select example">
                                <option value="0">Payable</option>
                                <option value="1" selected>Receivable</option>
                            </select>
                        </div>
                    </div>
                     <!-- worker balance end -->

                    {{-- React components --}}
                    <div data-items="{{ $items }}" data-worker="{{ json_encode([]) }}" id="multiple-add-item-and-show-worker-cost">

                    </div>

                    <!-- worker address start -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="address" class="mt-1 form-label">Address</label>
                        </div>

                        <div class="col-5">
                            <textarea name="address" class="form-control" id="address" rows="2"
                                placeholder="Optional">{{ old('address')}}</textarea>

                                <!-- error -->
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                        </div>
                    </div>
                    <!-- worker address end -->

                    <!-- worker discription start -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="description" class="mt-1 form-label">Discription</label>
                        </div>

                        <div class="col-6">
                            <textarea name="description" class="form-control" id="description" rows="3"
                                placeholder="Optional">{{ old('description')}}</textarea>

                                <!-- error -->
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                        </div>
                    </div>
                    <!-- worker discription end -->

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
