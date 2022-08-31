<x-app-layout>
    <x-slot name="title">Group </x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('group.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('group.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('group.trash') }}">Recycle Bin</a>
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
                    <h4 class="main-title">Group</h4>
                    <p><small>About {{ count($records) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('group.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                <a href="#group-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('group.create') }}" class="btn top-icon-button print-none" title="Create new group">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="card-body p-0">
                <!-- search area -->
                <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="group-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <!-- search form -->
                        <form action="{{ route('group.index') }}" method="GET">
                            <input type="hidden" name="search" value="1">

                            <div class="row gy-1 gx-3">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="group-name" class="form-label">Group name</label>
                                    <input type="text" name="name" value="{{ request()->name }}" class="form-control" id="group-name" placeholder="Characters only" autofocus>
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
                                <th scope="col">Group name</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($records as $group)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $group->name }}</td>
                                    <td class="print-none text-end">
                                        <a href="{{ route('group.show', $group->id) }}" class="btn table-small-button" title="View"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('group.edit', $group->id) }}" class="btn table-small-button" title="Update"><i class="bi bi-pencil"></i></a>
                                        
                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('group-delete-{{ $group->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('group.destroy', $group->id) }}" method="post" class="d-none" id="group-delete-{{ $group->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="3">Group is empty.</th>
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