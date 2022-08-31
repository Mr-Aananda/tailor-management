<x-app-layout>
    <x-slot name="title">Design edit </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.design.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old design</h4>
                    <p><small>Can edit a design here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('design.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('design.update',$design->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="design-name" class="mt-1 form-label required">Design name</label>
                        </div>

                        <div class="col-5">
                            <input type="text" name="design_name" class="form-control" id="design-name" value="{{ $design->design_name }}" placeholder="Characters only"
                                required>
                        </div>
                    </div>

                    {{-- <div class="mb-3 row">
                        <div class="col-2">
                            <label for="item-id" class="mt-1 form-label required">Select item</label>
                        </div>

                        <div class="col-4">
                            <select name="item_id" class="form-control" id="item-id" required>
                                <option value="" selected disabled>--</option>

                            @foreach ($items as $item)
                                <option value="{{ $item->id }}"{{ (old('item_id', $design->item_id) == $item->id) ? 'selected' : '' }}>
                                    {{ $item->item_name }}
                                </option>
                            @endforeach
                            </select>

                                <!-- error -->
                            @error('item_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div> --}}
                      {{-- React component for add items --}}
                    <div data-items="{{ $items }}" data-design ="{{ $design ?? [] }}" id="multiple-add-item"></div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="description" class="mt-1 form-label">Description</label>
                        </div>

                        <div class="col-8">
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Optional">{{ $design->description }}</textarea>
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
