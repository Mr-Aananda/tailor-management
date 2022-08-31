<x-app-layout>
    <x-slot name="title">Expense Category Update </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.expense.expense-category.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit Category</h4>
                    <p><small>Can update <strong>category</strong> from here for expenses.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('expense-category.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('expense-category.update',$category->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- type text -->

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="category-name" class="mt-1 form-label required">Category name</label>
                        </div>

                        <div class="col-4">
                            <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control" id="category-name" placeholder="Characters only">

                            <!-- error -->
                            @error('category_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                                <label for="description" class="mt-1 form-label">Description</label>
                        </div>

                        <div class="col-6">
                            <textarea name="description" class="form-control" id="description" rows="3"
                                placeholder="Optional">{{ $category->description }}</textarea>

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
                                <span class="p-1">Update</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

