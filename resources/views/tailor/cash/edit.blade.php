<x-app-layout>
    <x-slot name="title">Cash Edit </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.cash.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old cash</h4>
                    <p><small>Can edit an cash here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('cash.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('cash.update',$cash->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="cash-name" class="mt-1 form-label required">Cash name</label>
                        </div>

                        <div class="col-4">
                            <input type="text" name="cash_name" value="{{ old('cash_name',$cash->cash_name)}}" class="form-control" id="cash-name" placeholder="Characters only" required>

                            <!-- error -->
                            @error('cash_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="balance" class="mt-1 form-label required">Initial amount</label>
                        </div>

                        <div class="col-4">
                            <input type="number" name="balance" value="{{ old('balance',$cash->balance)}}" class="form-control" id="balance" placeholder="0.00" required>

                            <!-- error -->
                            @error('balance')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="description" class="mt-1 form-label">Description</label>
                        </div>

                        <div class="col-6">
                            <textarea name="description" class="form-control" id="note" rows="3"
                                placeholder="Optional">{{ old('description',$cash->description)}}</textarea>

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
