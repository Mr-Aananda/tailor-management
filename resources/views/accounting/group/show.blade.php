<x-app-layout>
    <x-slot name="title">Group </x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('group.index') }}">All Records</a>
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

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 border-0 card-header d-flex mb-3">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Group details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    <a href="{{ route('group.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
        
                <div class="p-0 card-body">
                    <h4>Group </h4>
                    <p class="mt-1 mb-3 fst-italic text-muted">{{ $record->name }}</p>

                    @if ($record->created_at != null )
                        <p class="mt-1 mb-3 fst-italic text-muted">{{ $record->created_at->format('d F, Y') }} </p>
                    @endif

                    <dl class="mb-3 row">
                        <dt class="col-sm-3">Group name : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->name }}
                        </dd>
                    </dl>

                    <article class="mb-3 regular-size">
                        <h4>Description</h4>
                        <p class="fst-italic text-muted">
                            {{ $record->description }}
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>