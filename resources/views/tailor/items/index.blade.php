<x-app-layout>
    <x-slot name="title">Items </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.items.menu')
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
                    <h4 class="main-title">Items</h4>
                    <p><small>About {{ count($items) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('items.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- add -->
                <a href="{{ route('items.create') }}" class="btn top-icon-button print-none" title="Create new item">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->

                <!-- search area end -->

                <!-- data table -->
                <div class="mb-3 table-responsive">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Item name</th>
                                <th scope="col">Item part</th>
                                <th scope="col">price</th>
                                <th scope="col">Worker cost</th>
                                <th scope="col">Description</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->item_part }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->worker_cost }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td class="print-none text-end">
                                        {{-- <a href="{{ route('items.show', $item->id) }}" class="btn table-small-button text-info" title="View"><i class="bi bi-eye"></i></a> --}}
                                        <a href="{{ route('items.edit', $item->id) }}" class="btn table-small-button text-success" title="Update"> <i class="bi bi-pencil-square"></i></a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button text-danger @if($item->order_details_count) disabled @endif" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('item-delete-{{ $item->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('items.destroy', $item->id) }}" method="post" class="d-none" id="item-delete-{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4">items list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($items)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
