<x-app-layout>
    <x-slot name="title">Expense subcategory </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.expense.expense-subCategory.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit Subcategory</h4>
                    <p><small>Can edit or update <strong>Subcategory</strong> from here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('expense-subcategory.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('expense-subcategory.update', $subcategory->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="category-id" class="mt-1 form-label required">Select category</label>
                        </div>

                        <div class="col-3">
                            <select name="expense_category_id" class="form-control" id="category-id" required>
                                <option value="" selected disabled>--</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ (old('expense_category_id', $subcategory->expense_category_id) == $category->id) ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach

                            </select>

                                <!-- error -->
                            @error('expense_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="subcategory-name" class="mt-1 form-label required"> name </label>

                        </div>

                        <div class="col-4">
                            <input type="text" name="subcategory_name" value="{{ $subcategory->subcategory_name }}" class="form-control" id="subcategory-name" placeholder="Characters only">

                            <!-- error -->
                            @error('subcategory_name')
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
                                placeholder="Optional">{{ $subcategory->description }}</textarea>

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

