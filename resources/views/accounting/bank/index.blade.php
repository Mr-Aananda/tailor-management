<x-app-layout>
    <x-slot name="title">Bank</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('bank.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bank.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bank.trash') }}">Recycle Bin</a>
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
        <div class="border-0 card">
            <!-- card head -->
            <div class="p-0 mb-3 border-0 card-header d-md-flex align-items-center d-block">
                <!-- page title -->
                <div class="mt-3 mb-2">
                    <h4 class="main-title">Banks</h4>
                    <p><small>About {{ count($records) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('bank.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                <a href="#account-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('bank.create') }}" class="btn top-icon-button print-none" title="Create new element">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->
                <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="account-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <!-- search form -->
                        <form action="{{ route('bank.index') }}" method="GET">
                            <input type="hidden" name="search" value="1">

                            <div class="row gy-1 gx-3">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="bank-name" class="form-label">Bank name</label>
                                    <input type="text" name="name" value="{{ request()->name }}" class="form-control" id="bank-name" placeholder="Characters only" autofocus>
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
                <div class="table-responsive">
                    <table class="table custom-table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Bank</th>
                            <th scope="col">Total accounts</th>
                            <th scope="col" class="print-none text-end">Add Account</th>
                            <th scope="col" class="print-none text-end">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($records as $bank)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}.</th>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->bankAccounts->count() }}</td>
                                <td class="print-none text-end">
                                    <a href="{{ route('bankAccount.index', ['bankId' => $bank->id]) }}" class="text-primary" title="Create bank account">
                                        <span>+</span>
                                        <span>Add account</span> 
                                    </a>
                                </td>

                                <td class="print-none text-end">
                                    <a href="{{ route('bank.show', $bank->id) }}" class="btn table-small-button" title="View"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('bank.edit', $bank->id) }}" class="btn table-small-button" title="Update"><i class="bi bi-pencil"></i></a>

                                    <span data-bs-toggle="tooltip" title="@if($bank->bank_accounts_count) This journal Group is used in Journal @else Trash @endif">
                                        <a href="#" class="btn table-small-button @if($bank->bank_accounts_count) disabled @endif" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('role-delete-{{ $bank->id }}').submit() } return false ">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </span>

                                    <form
                                    action="{{ route('bank.destroy', $bank->id) }}"
                                    method="post"
                                    class="d-none"
                                    id="role-delete-{{ $bank->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                </td>
                            </tr>
                        @empty
                         <tr>
                            <td class="fw-bold" colspan="4">No data found</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
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
