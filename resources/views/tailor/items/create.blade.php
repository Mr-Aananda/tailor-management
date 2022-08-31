
<x-app-layout>
    <x-slot name="title">Items </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.items.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create new items</h4>
                    <p><small>Can create <strong>items</strong> from here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('items.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('items.store') }}" method="POST">
                    @csrf
                    <!-- item name start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="item-name" class="mt-1 form-label required">Item name</label>
                        </div>

                        <div class="col-4">
                            <input type="text" name="item_name" value="{{ old('item_name')}}" class="form-control" id="item-name" placeholder="Characters only" required>

                            <!-- error -->
                            @error('item_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                     <!-- item name end-->
                     <!-- item part start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="item-part" class="mt-1 form-label required">Item Part</label>
                        </div>

                        <div class="col-3">
                            <select name="item_part" class="form-control" id="item-part" required>
                                <option value="" selected disabled>--</option>
                                @foreach ($itemPart as $part)
                                    <option value="{{ $part }}" {{ (old('item_part') == $part) ? 'selected' : '' }}>
                                        {{ $part }}
                                    </option>
                                @endforeach
                            </select>

                                <!-- error -->
                            @error('item_part')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                     <!-- item part end-->
                     <!-- item price start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="item-price" class="mt-1 form-label required">Price</label>
                        </div>

                        <div class="col-3">
                            <input type="number" name="price" value="{{ old('price')}}" class="form-control" id="item-price" placeholder="Enter customer price" required>

                            <!-- error -->
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                     <!-- item price end-->

                    <!-- Worker cost start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="worker-cost" class="mt-1 form-label required">Worker cost</label>
                        </div>

                        <div class="col-3">
                            <input type="number" name="worker_cost" value="{{ old('worker_cost')}}" class="form-control" id="worker-cost" placeholder="Enter worker cost" required>

                            <!-- error -->
                            @error('worker_cost')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                     <!-- Worker cost end-->

                    <!-- Description start-->
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
                    <!-- Description end-->

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
