
<x-app-layout>
    <x-slot name="title">Design </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.design.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create new design</h4>
                    <p><small>Can create <strong>design</strong> from here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('design.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('design.store') }}" method="POST">
                    @csrf

                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="design-name" class="mt-1 form-label required">Design name</label>
                        </div>

                        <div class="col-4">
                            <input type="text" name="design_name" value="{{ old('item_name')}}" class="form-control" id="design-name" placeholder="Characters only" required>

                            <!-- error -->
                            @error('design_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
{{--
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="item-id" class="mt-1 form-label required">Select item</label>
                        </div>

                        <div class="col-4">
                            <select name="item_id" class="form-control" id="item-id" required>
                                <option value="" selected disabled>--</option>

                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                            @endforeach
                            </select>

                                <!-- error -->
                            @error('item_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div> --}}

                    {{-- React component for add items --}}
                    <div data-items="{{ $items }}" data-design="{{ json_encode([]) }}" id="multiple-add-item"></div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="description" class="mt-1 form-label">Description</label>
                        </div>

                        <div class="col-5">
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
