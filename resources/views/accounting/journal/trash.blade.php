<x-app-layout>
    <x-slot name="title">Journal </x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('journal.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('journal.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('journal.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <!-- card start -->
        <div class="card border-0">
            <!-- card head -->
            <div class="card-header p-0 border-0 d-md-flex align-items-center d-block mb-3">
                <!-- page title -->
                <div class="mt-3 mb-2">
                    <h4 class="main-title">Journal</h4>
                    <p><small>About {{ count($records) }} results found.</small></p>
                </div>

                <!-- refresh -->
                <a href="{{ route('journal.trash') }}" class="btn top-icon-button ms-auto" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                <a href="#journal-search" class="btn top-icon-button " title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="card-body p-0">
                <!-- search area -->
                <div class="collapse {{ request()->search ? 'show' : '' }}" id="journal-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <!-- search form -->
                        <form action="{{ route('journal.trash') }}" method="GET">
                            <input type="hidden" name="search" value="1">

                            <div class="row gy-1 gx-3">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="group-id" class="form-label">Group </label>
                                    <select name="filter[group_id]" class="form-control" id="group-id">
                                        <option value="" selected disabled> -- </option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}" @isset(request()->filter['group_id']) {{ (request()->filter['group_id'] == $group->id) ? 'selected' : '' }} @endisset>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-sm-3 col-lg-2">
                                    <label for="from-date" class="form-label">From date</label>
                                    <input type="date" name="filter[from]" value="{{ request()->filter['from'] ?? '' }}" class="form-control" id="from-date"> 
                                </div>

                                <div class="col-12 col-sm-3 col-lg-2">
                                    <label for="to-date" class="form-label">To date</label>
                                    <input type="date" name="filter[to]" value="{{ request()->filter['to'] ?? '' }}" class="form-control" id="to-date">
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
                <div class="d-block mb-3">
                    <form action="{{ route('journal.trash') }}" method="POST">
                        @csrf

                        <div class="table-responsive">
                            <table class="table custom-table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="p-0">
                                            <label for="check-all" class="d-block p-2">
                                                <input type="checkbox" class="me-2" id="check-all">
                                                <span>SL </span>
                                            </label>
                                        </th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Particular</th>
                                        <th scope="col">Spender</th>
                                        <th scope="col">Operator</th> 
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($records as $index => $journal) 
                                        <tr>
                                            <th scope="row" class="p-0">
                                                <label class="d-block p-2">
                                                    <input type="checkbox" name="journals[]" value="{{ $journal->id }}" class="me-2">
                                                    {{ $index + $records->firstItem() }}.
                                                </label>
                                            </th>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $journal->entry_date)->format('d M Y') }}</td>
                                            <td title="{{ $journal->note }}">
                                                <strong class="d-block mb-2">{{ $journal->template->particular }}</strong>
                                            </td>
                                            <td>{{ $journal->contact->contact_person_name }}</td>
                                            <td>{{ $journal->user->name }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('journal.restore', $journal->id) }}" class="btn table-small-button" title="Restore">
                                                    <i class="bi bi-bootstrap-reboot"></i>
                                                </a>

                                                <a href="{{ route('journal.permanentDelete', $journal->id) }}" onclick="return confirm('Are you sure, want to delete this data permanently?')" title="Permanent delete" class="btn table-small-button">
                                                    <i class="bi bi-x-square-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty 
                                        <tr>
                                            <th colspan="6">Trash is empty.</th>
                                        </tr>
                                    @endforelse 
                                </tbody>
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
                <div class="card-footer mb-5">
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
                childCheckbox = document.querySelectorAll('[name="journals[]"]');

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

