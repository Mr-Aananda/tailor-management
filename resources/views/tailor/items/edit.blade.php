<x-app-layout>
    <x-slot name="title">Item Edit </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.items.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old item</h4>
                    <p><small>Can edit an item here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('items.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('items.update',$item->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="item-name" class="mt-1 form-label required">Item name</label>
                        </div>

                        <div class="col-6">
                            <input type="text" name="item_name" class="form-control" id="item-name" value="{{ $item->item_name }}" placeholder="Characters only"
                                required>
                        </div>
                    </div>
                                         <!-- item part start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="item-part" class="mt-1 form-label required">Item Part</label>
                        </div>

                        <div class="col-3">
                            <select name="item_part" class="form-control" id="item-part" required>
                                <option value="" selected disabled>--</option>
                                @foreach ($itemPart as $part)
                                    <option value="{{ $part }}" {{ (old('item_part',$item->item_part) == $part) ? 'selected' : '' }}>
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
                     <!-- item paer end-->
                     <!-- item price start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="item-price" class="mt-1 form-label required">Price</label>
                        </div>

                        <div class="col-3">
                            <input type="number" name="price" value="{{ $item->price }}" class="form-control" id="item-price" placeholder="Enter price" required>

                            <!-- error -->
                            @error('item_name')
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
                            <input type="number" name="worker_cost" value="{{ $item->worker_cost }}" class="form-control" id="worker-cost" placeholder="Enter worker cost" required>

                            <!-- error -->
                            @error('worker_cost')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                     <!-- Worker cost end-->

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="description" class="mt-1 form-label">Description</label>
                        </div>

                        <div class="col-8">
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Optional">{{ $item->description }}</textarea>
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
