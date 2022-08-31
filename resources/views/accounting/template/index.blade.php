<x-app-layout>
    <x-slot name="title">Template</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('template.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('template.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('template.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <!-- print header -->
        <div class="pb-2 print-show print-header border-bottom">
            <div class="d-flex">
                <div>
                    <h4>MaxSOP</h4>
                    <h6>5B Green House, 27/2 Ram Babu Road, Mymensingh</h6>
                    <p class="text-small"><strong>Phone:</strong>+880 1786 494650, +880 1786 494650</p>
                </div>

                <div class="ms-auto">
                    <p>5 December, 2020</p>
                </div>
            </div>
        </div>
        <!-- print header end -->

        <!-- card start -->
        <div class="card border-0">
            <!-- card head -->
            <div class="card-header p-0 border-0 d-md-flex align-items-center d-block mb-3">
                <!-- page title -->
                <div class="mt-3 mb-2">
                    <h4 class="main-title">Template</h4>
                    <p><small>About {{ count($records) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('template.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                <a href="#template-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('template.create') }}" class="btn top-icon-button print-none" title="Create new template">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="card-body p-0">
                <!-- search area -->
                <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="template-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <!-- search form -->
                        <form action="{{ route('template.index') }}" method="GET">
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

                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="particular" class="form-label">Particular</label>
                                    <input type="text" name="filter[particular]" value="{{ request()->filter['particular'] ?? '' }}" class="form-control" id="particular" placeholder="Characters only">
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
                <div class="table-responsive mb-3">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Particular</th>
                                <th scope="col">Group</th>
                                <th scope="col">Depreciable</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($records as $template)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $template->particular }}</td>
                                    <td>{{ $template->group->name }}</td>
                                    <td>{{ $template->is_depreciable ? "Yes" : "No" }}</td>
                                    <td class="print-none text-end">
                                        <a href="{{ route('template.show', $template->id) }}" class="btn table-small-button" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('template.edit', $template->id) }}" class="btn table-small-button" title="Update">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        <span data-bs-toggle="tooltip" title="{{ (count($template->journal) > 0) ? 'Already been used.' : 'Trash' }}">
                                            <a href="#" class="btn table-small-button {{ (count($template->journal) > 0) ? 'disabled' : '' }}" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('template-delete-{{ $template->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('template.destroy', $template->id) }}" method="post" class="d-none" id="template-delete-{{ $template->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <th colspan="5">Template is empty.</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="card-footer print-none mb-5">
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
</x-app-layout>