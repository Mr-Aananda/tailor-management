<x-app-layout>
    <x-slot name="title">Worker </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.worker.menu')
        <!-- container menu end -->

        <!-- print header -->
        @include('layouts.partials.printHead')
        <!-- print header end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 mb-3 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Workers details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    <a href="{{ route('worker.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>

                <div class="p-0 card-body">

                   <div class="mb-3 row">
                        <div class="col-2">
                            <dt for="date" class="mt-1 form-label">Worker Name </dt>
                        </div>

                        <div class="col-6">
                            <dd class="fst-italic text-muted">{{ $worker->worker_name }}</dd>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <dt for="date" class="mt-1 form-label">Mobile no </dt>
                        </div>

                        <div class="col-6">
                            <dd class="fst-italic text-muted">{{ $worker->mobile_no }}</dd>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <dt for="date" class="mt-1 form-label">Address </dt>
                        </div>

                        <div class="col-6">
                            <dd class="fst-italic text-muted">{{ $worker->address }}</dd>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <dt for="date" class="mt-1 form-label">Working items</dt>
                        </div>

                        <div class="col-6">
                            @foreach ($worker->items as $item )

                                <dd class="fst-italic fw-bold">{{ $item->item_name }} , <span>Cost: {{ $item->worker_cost }}</span></dd>

                            @endforeach


                        </div>
                    </div>

                    @if ($worker->description!==null)
                        <div class="col-2">
                            <dt for="description" class="mt-1 form-label">Description </dt>
                        </div>

                        <div class="col-6">
                            <dd class="fst-italic text-muted">{{ $worker->description }}</dd>
                        </div>

                    @endif
                    </div>


                </div>

            </div>
        </div>
    </div>
</x-app-layout>
