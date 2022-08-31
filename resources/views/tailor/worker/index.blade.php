<x-app-layout>
    <x-slot name="title">Worker </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.worker.menu')
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
                    <h4 class="main-title">Worker</h4>
                    <p><small>About {{ count($workers) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('worker.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- add -->
                <a href="{{ route('worker.create') }}" class="btn top-icon-button print-none" title="Create new worker">
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
                                <th scope="col">Worker name</th>
                                <th scope="col">Mobile no</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Address</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($workers as $worker)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $worker->worker_name }}</td>
                                    <td>{{ $worker->mobile_no }}</td>
                                    <td>{{ number_format(abs($worker->balance), 2) }} {{ $worker->balance >= 0 ? '(Rec)' : '(Pay)' }}</td>
                                    <td>{{ $worker->address }}</td>
                                    <td class="print-none text-end">
                                        <a href="{{ route('worker.show', $worker->id) }}" class="btn table-small-button text-info" title="View"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('worker.edit', $worker->id) }}" class="btn table-small-button text-success" title="Update"> <i class="bi bi-pencil-square"></i></a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button text-danger @if($worker->distributions_count) disabled @endif" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('worker-delete-{{ $worker->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('worker.destroy', $worker->id) }}" method="post" class="d-none" id="worker-delete-{{ $worker->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4">Workers list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($workers)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
