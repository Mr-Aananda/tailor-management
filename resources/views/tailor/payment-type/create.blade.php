
<x-app-layout>
    <x-slot name="title">Payment type </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.payment-type.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create new payment type</h4>
                    <p><small>Can create <strong>payment type</strong> from here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('payment-type.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('payment-type.store') }}" method="POST">
                    @csrf

                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="name" class="mt-1 form-label required">Payment type name</label>
                        </div>

                        <div class="col-4">
                            <input type="text" name="name" value="{{ old('name')}}" class="form-control" id="name" placeholder="Characters only" required>

                            <!-- error -->
                            @error('name')
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
                                placeholder="Optional">{{ old('description')}}</textarea>

                                <!-- error -->
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
            </div>
        </div>
    </div>
</x-app-layout>
