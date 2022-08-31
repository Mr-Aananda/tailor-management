<x-app-layout>
    <x-slot name="title">Accounts</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accounts.index') }}">All Records</a>
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

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Account details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    <a href="{{ route('accounts.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>

                </div>
        
                <div class="p-0 card-body">
                    <h4>Account</h4>
                    <p class="mt-1 mb-3 fst-italic text-muted">{{ $record->name }}</p>

                    @if ($record->created_at != null )
                        <p class="mt-1 mb-3 fst-italic text-muted">{{ $record->created_at->format('d F, Y') }} </p>
                    @endif

                    <dl class="mb-3 row">
                        <dt class="col-sm-3">Account Name : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->name }}
                        </dd>

                        <dt class="col-sm-3">Opening Balance : </dt>
                        <dd class="font-bold col-sm-9 fst-italic fw-bold">
                            {{ $record->opening_balance }}
                        </dd>

                        <dt class="col-sm-3">Element : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->element->name }}(ID: {{ $record->element_id }})
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