<x-app-layout>
    <x-slot name="title">Bank Accounts</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bankAccount.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bankAccount.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('bankAccount.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 mb-3 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Bank Account details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    <a href="{{ route('bankAccount.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>

                </div>
                        <div class="p-0 card-body">
            <h4>Bank Name</h4>
            <p class="mt-1 mb-3 fst-italic text-muted">{{ $record->bank->name }}</p>
            <p class="mt-1 mb-3 fst-italic text-muted">{{ $record->created_at->format('d F, Y') }}</p>

            <dl class="mb-3 row">

                <dt class="col-sm-3">Account Owner : </dt>
                <dd class="col-sm-9 fst-italic text-muted">
                    {{ $record->account_name }}

                </dd>

                <dt class="col-sm-3">Account No : </dt>
                <dd class="col-sm-9 fst-italic text-muted">
                    {{ $record->account_number }}

                </dd>

                <dt class="col-sm-3">Account Balance : </dt>
                <dd class="col-sm-9 fst-italic text-muted">
                    {{ $record->balance }}

                </dd>

                <dt class="col-sm-3">Account Branch : </dt>
                <dd class="col-sm-9 fst-italic text-muted">
                    {{ $record->branch }}

                </dd>
            </dl>

            @if ($record->description !=null )
            <article class="mb-3 regular-size">
                <h4>Description</h4>
                <p class="fst-italic text-muted">
                    {{ $record->description }}
                </p>
            </article>

            @endif

        </div>


    </div>
</x-app-layout>
