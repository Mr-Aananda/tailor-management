<x-app-layout>
    <x-slot name="title">Expense subcategory trash</x-slot>

    <div class="container">
        <!-- container menu -->
        @include('coaching.expense.expense-subCategory.menu')
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
                    <h4 class="main-title">Expense category trash</h4>
                    <p><small>About {{ count($records) }} results found.</small></p>
                </div>

                <!-- refresh -->
                <a href="{{ route('expense-subcategory.trash') }}" class="btn top-icon-button ms-auto" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                <a href="#expense-subcategory-search" class="btn top-icon-button " title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->
                <div class="collapse {{ request()->search ? 'show' : '' }}" id="expense-subcategory-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <!-- search form -->
                        <form action="{{ route('expense-subcategory.trash') }}" method="GET">
                            <input type="hidden" name="search" value="1">

                            <div class="row gy-1 gx-3">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="expense-subcategory-name" class="form-label">Expense subcategory</label>
                                    <input type="text" name="name" value="{{ request()->name }}" class="form-control" id="expense-subcategory-name" placeholder="Characters only">
                                </div>

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
                <div class="mb-3 d-block">
                    <form action="{{ route('expense-subcategory.trash') }}" method="POST">
                        @csrf

                        <div class="table-responsive">
                            <table class="table custom-table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="p-0">
                                            <label for="check-all" class="p-2 d-block">
                                                <input type="checkbox" class="me-2" id="check-all">
                                                <span>SL </span>
                                            </label>
                                        </th>
                                        <th scope="col">Subcategory</th>
                                        <th scope="col">Category</th>
                                        <th scope="col" class="text-end">Opening balance</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($records as $record)
                                        <tr>
                                            <th scope="row" class="p-0">
                                                <label class="p-2 d-block">
                                                    <input type="checkbox" name="subcategories[]" value="{{ $record->id }}" class="me-2">
                                                    {{ $loop->iteration }}.
                                                </label>
                                            </th>
                                            <td>{{ $record->name }}</td>
                                            <td>{{ $record->expenseCategory->name}}</td>
                                            <td class="text-end">{{ $record->opening_balance }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('expense-subcategory.restore', $record->id) }}" class="btn table-small-button" title="Restore">
                                                    <i class="bi bi-bootstrap-reboot"></i>
                                                </a>

                                                <a href="{{ route('expense-subcategory.permanentDelete', $record->id) }}" onclick="return confirm('Are you sure, want to delete this data permanently?')" title="Permanent delete" class="btn table-small-button">
                                                    <i class="bi bi-x-square-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Trash is empty.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-end" colspan="3">Total </th>
                                        <th class="text-end">{{ number_format ($records->sum('opening_balance'),2) }} </th>
                                        <th colspan="2">&nbsp;</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- submit button -->
                        <div class="mt-4">
                            <button class="btn btn-success btn-sm" name="restore" value="1" onclick="return confirm('Do you want to restore all selected record(s)?')" {{ ($records->count() > 0) ? '' : 'disabled'}}>Restore all</button>

                            <button class="btn btn-danger btn-sm" name="delete" value="1" onclick="return confirm('The selected record(s) will be delete permanently!')" {{ ($records->count() > 0) ? '' : 'disabled'}}>Permanently delete</button>
                        </div>
                        <!-- submit button end -->
                    </form>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ $records->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>

    @push('script')
        <!-- checked all program script -->
        <script>
            // select master & child checkboxes
            let masterCheckbox = document.getElementById("check-all"),
                childCheckbox = document.querySelectorAll('[name="subcategories[]"]');

            // add 'change' event into master checkbox
            masterCheckbox.addEventListener("change", function() {
                // add/remove attribute into child checkbox conditionally
                for (var i = 0; i < childCheckbox.length; i++) {
                    if(this.checked) {
                        childCheckbox[i].checked = true; // add attribute
                    } else {
                        childCheckbox[i].checked = false; // add attribute
                    }
                }
            });
        </script>
        <!-- checked all program script end -->
    @endpush
</x-app-layout>

