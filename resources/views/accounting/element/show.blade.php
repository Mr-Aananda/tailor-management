<x-app-layout>
    <x-slot name="title">Elements</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="container print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('elements.index') }}">All Records</a>
                </li>

            </ul>
        </div>
        <!-- container menu end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Element</h4>
                        <p><small>All the details show below.</small></p>
                    </div>
    
                    <!-- header icon -->
                    <a href="{{ route('elements.index') }}" title="Go back"
                        class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
            </div>
        
            <div class="p-0 card-body">
                <h4>Element</h4>
                <p class="mt-1 mb-3 fst-italic text-muted">{{ $record->name }}</p>
                <p class="mt-1 mb-3 fst-italic text-muted">{{ $record->created_at->format('d F, Y') }}</p>
    
                <dl class="mb-3 row">
                    <dt class="col-sm-3">Element Name : </dt>
                    <dd class="col-sm-9 fst-italic text-muted">
                        {{ $record->name }}
    
                    </dd>
    
                    <dt class="col-sm-3">Element Symbol : </dt>
                    <dd class="col-sm-9 fst-italic text-muted">
                        {{ $record->symbol }}
    
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
</x-app-layout>