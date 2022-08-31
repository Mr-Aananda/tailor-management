<x-app-layout>
    <x-slot name="title">Images </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.image.menu')
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
                    <h4 class="main-title">Images</h4>
                    <p><small>About {{ count($images) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('image.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- add -->
                <a href="{{ route('image.create') }}" class="btn top-icon-button print-none" title="Create new image">
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
                                <th scope="col">Image part</th>
                                <th scope="col">Images</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($images as $image)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $image->image_part }}</td>
                                    <td><img src="{{ $image->url }}" alt="image" width="120"></td>

                                    <td class="print-none text-end">
                                        {{-- <a href="{{ route('image.show', $item->id) }}" class="btn table-small-button text-info" title="View"><i class="bi bi-eye"></i></a> --}}
                                        <a href="{{ route('image.edit', $image->id) }}" class="btn table-small-button text-success" title="Update"> <i class="bi bi-pencil-square"></i></a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button text-danger @if($image->order_details_count) disabled @endif " onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('image-delete-{{ $image->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('image.destroy', $image->id) }}" method="post" class="d-none" id="image-delete-{{ $image->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4">Image list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($images)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
