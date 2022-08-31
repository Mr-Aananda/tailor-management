<x-app-layout>
    <x-slot name="title">Account</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('accounts.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accounts.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accounts.trash') }}">Recycle Bin</a>
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
                    <h4 class="main-title">Accounts</h4>
                    <p><small>Sum of <strong>assets accounts</strong> = sum of <strong>liabilities accounts</strong> + sum of <strong>OE accounts</strong>. About {{ count($records) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('accounts.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                <a href="#account-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('accounts.create') }}" class="btn top-icon-button print-none" title="Create new element">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="card-body p-0">
                <!-- search area -->
                <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="account-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <!-- search form -->
                        <form action="{{ route('accounts.index') }}" method="GET">
                            <input type="hidden" name="search" value="1">

                            <div class="row gy-1 gx-3">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="account-element" class="form-label">Element</label>
                                    <select name="account_element" class="form-control" id="account-element">
                                        <option value="" selected disabled> -- </option>

                                        @foreach ($elements as $element)
                                            <option value="{{ $element->id }}" {{ (request()->account_element == $element->id) ? 'selected' : '' }}>{{ $element->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="account-name" class="form-label">Account name</label>
                                    <input type="text" name="name" value="{{ request()->name }}" class="form-control" id="account-name" placeholder="Characters only" autofocus>
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
                                <th scope="col">Account number</th>
                                <th scope="col">Account name</th>
                                <th scope="col">Element </th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($records as $index => $account)
                                <tr>
                                    <th scope="row">{{ $index + $records->firstItem() }}.</th>
                                    <th scope="row"># {{ str_pad($account->id, 3, "0", STR_PAD_LEFT) }}</th>
                                    <td>{{ $account->name }}</td>
                                    <td>{{ $account->element->name }}</td>
                                    <td class="print-none text-end">
                                        <a href="{{ route('accounts.show', $account->id) }}" class="btn table-small-button" title="View"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('accounts.edit', $account->id) }}" class="btn table-small-button" title="Update"><i class="bi bi-pencil"></i></a>
                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('account-delete-{{ $account->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('accounts.destroy', $account->id) }}" method="post" class="d-none" id="account-delete-{{ $account->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <th colspan="5">Account is empty.</th>
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