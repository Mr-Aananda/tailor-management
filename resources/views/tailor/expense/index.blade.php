<x-app-layout>
    <x-slot name="title">Expense </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.expense.menu')
        <!-- container menu end -->

        <!-- print header -->
        @include('layouts.partials.printHead')
        <!-- print header end -->

        <!-- card start -->
        <div class="border-0 card">
            <!-- card head -->
            <div class="p-0 mb-3 border-0 card-header d-md-flex align-items-center d-block">
                <!-- page title -->
                <div class="mt-3 mb-2">
                    <h4 class="main-title">Expenses</h4>
                    <p><small>About {{ count($expenses) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('expense.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                <a href="#expense-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('expense.create') }}" class="btn top-icon-button print-none" title="Create new course">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->
                <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="expense-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <!-- search form -->
                        <form action="{{ route('expense.index') }}" method="GET">
                            <input type="hidden" name="search" value="1">
                            <div class="row gy-1 gx-3">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="date" class="form-label">Date (From)</label>
                                    <input
                                    {{-- value="{{ (request()->search) ? request()->form_date : date('Y-m-d') }}" --}}
                                    value="{{ (request()->search) ? request()->form_date : '' }}"
                                    type="date"
                                    id="formdate"
                                    name="form_date"
                                    class="form-control"
                                    placeholder="YYYY-MM-DD">
                                </div>
                                <div class="col-3">
                                    <label for="date" class="form-label">Date (To)</label>
                                    <input
                                    {{-- value="{{ (request()->search) ? request()->to_date : date('Y-m-d') }}" --}}
                                    value="{{ (request()->search) ? request()->to_date : '' }}"
                                    type="date"
                                    id="todate"
                                    name="to_date"
                                    class="form-control"
                                    placeholder="YYYY-MM-DD">
                                </div>

                                <div class="col-2">
                                    <label for="category-name" class="form-label">Category name</label>
                                    <div class="custom-select2">
                                        <select
                                            class="js-example-basic-single js-states js-example-responsive form-select"
                                            style="width: 100%"
                                            id="id_label_single"
                                            name="category_name"
                                            data-placeholder="Select category name"
                                            data-allow-clear="true">
                                            <option value="" ></option>
                                            @foreach ($categories as $category )
                                                <option  value="{{$category->category_name}}">{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-2">
                                    <label for="subcategory-name" class="form-label">Subcategory name</label>
                                    <div class="custom-select2">
                                        <select
                                            class="js-example-basic-single js-states js-example-responsive form-select"
                                            style="width: 100%"
                                            id="id_label_single"
                                            name="subcategory_name"
                                            data-placeholder="Select subcategory name"
                                            data-allow-clear="true">
                                            <option value="" ></option>
                                            @foreach ($subcategories as $subcategory )
                                                <option value="{{$subcategory->subcategory_name}}">{{$subcategory->subcategory_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <!-- button -->
                                <div class="col-12 col-sm-6 col-lg-2">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-block w-100 custom-btn btn-success">
                                        <i class="bi bi-search"></i>
                                        <span class="p-1">Search</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- search area end -->

                <!-- data table -->
                <div class="mb-3 table-responsive">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Date</th>
                                <th scope="col">Category</th>
                                <th scope="col">Subcategory</th>
                                <th scope="col" class="text-end">Amount</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($expenses as $expense)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $expense->date }}</td>
                                    <td>{{ $expense->expenseSubCategory->expenseCategory->category_name}}</td>
                                    <td>{{ $expense->expenseSubCategory->subcategory_name }}</td>
                                    <td class="text-end">{{ $expense->amount }}</td>
                                    <td class="print-none text-end">
                                        <a href="{{ route('expense.show', $expense->id) }}" class="btn table-small-button text-info" title="View"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('expense.edit', $expense->id) }}" class="btn table-small-button text-success" title="Update"><i class="bi bi-pencil-square"></i></a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button text-danger " onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('category-delete-{{ $expense->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('expense.destroy', $expense->id) }}" method="post" class="d-none" id="category-delete-{{ $expense->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="7">Expense list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>

                        <tfoot>
                            <tr>
                                <th class="text-end" colspan="4">Total </th>
                                <th class="text-end">{{ number_format ($expenses->sum('amount'),2) }} </th>
                                <th colspan="2">&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($expenses)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>

@push('script')
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });

    </script>

@endpush

@push('style')
    <style>
        .custom-select2 .select2-selection{
            height: 37px!important;
            border-radius: 2px!important;
            border: 1px solid #ced4da!important;
        }
        .custom-select2 .select2-selection .select2-selection__rendered{
            line-height: 37px!important;
            font-size: 14px!important;
            padding-left: 10px!important;
        }
        .custom-select2 .select2-selection .select2-selection__arrow{
            height: 37px!important;
        }
    </style>
@endpush
</x-app-layout>
