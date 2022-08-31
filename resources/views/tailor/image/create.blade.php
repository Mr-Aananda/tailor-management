
<x-app-layout>
    <x-slot name="title">Image </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.image.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Upload new image</h4>
                    <p><small>Can upload <strong>images</strong> from here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('image.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Image start -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="image" class="mt-1 form-label required">Image upload</label>
                        </div>

                        <div class="col-4">
                            <input name="image" class="form-control" type="file" id="image">

                            <!-- error -->
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- Image end -->

                    <!-- Image part start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="image-part" class="mt-1 form-label required">Image part</label>
                        </div>

                        <div class="col-4">
                            <select name="image_part" class="form-control" id="image-part" required>
                                <option value="" selected disabled>--</option>
                                @foreach ($imagePart as $image)
                                    <option value="{{ $image }}" {{ (old('image_part') == $image) ? 'selected' : '' }}>
                                        {{ $image }}
                                    </option>
                                @endforeach
                            </select>

                                <!-- error -->
                            @error('image_part')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                     <!-- Image part end-->


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
