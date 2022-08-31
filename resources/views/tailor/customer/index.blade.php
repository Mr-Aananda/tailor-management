<x-app-layout>
    <x-slot name="title">Customers </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.customer.menu')
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
                    <h4 class="main-title">Customer</h4>
                    <p><small>About {{ count($customers) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('customer.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
                                <!-- search -->
                <a href="#customer-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('customer.create') }}" class="btn top-icon-button print-none" title="Create new customer">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->
                <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="customer-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <!-- search form -->
                        <form action="{{ route('customer.index') }}" method="GET">
                            <input type="hidden" name="search" value="1">
                            <div class="row gy-1 gx-3">
                              <div class="col-4">
                                    <label for="customer-name" class="form-label">Customer name</label>
                                    <input type="text" min="0"  name="customer_name" value="{{ request()->customer_name ?? '' }}" class="form-control"
                                        placeholder="Character only">
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
                <div class="mb-3 table-responsive">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Customer name</th>
                                <th scope="col">Mobile no</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Address</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $customer->customer_name }}</td>
                                    <td>{{ $customer->mobile_no }}</td>
                                    <td>{{ number_format($customer->balance, 2) }} {{ $customer->balance >= 0 ? '(Rec)' : '(Pay)' }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td class="print-none text-end">

                                        <a href="{{ route('customer.edit', $customer->id) }}" class="btn table-small-button text-success" title="Update"> <i class="bi bi-pencil-square"></i></a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button text-danger" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('customer-delete-{{ $customer->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('customer.destroy', $customer->id) }}" method="post" class="d-none" id="customer-delete-{{ $customer->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4">Customer list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($customers)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
