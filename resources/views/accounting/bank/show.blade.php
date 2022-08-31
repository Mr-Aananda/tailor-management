<x-app-layout>
    <x-slot name="title">Banks</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bank.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bank.create') }}">New Entry</a>
                </li>

                 <li class="nav-item">
                    <a class="nav-link active" href="{{ route('bank.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 mb-3 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Bank details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    <a href="{{ route('bank.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>

                </div>

        <div class="p-0 mt-3 card-body">
            <h4>Bank</h4>
            <p class="mt-1 mb-3 fst-italic text-muted">{{ $record->name }}</p>
            <p class="mt-1 mb-3 fst-italic text-muted">{{ $record->created_at->format('d F, Y') }}</p>

            <dl class="mb-3 row">
                <dt class="col-sm-3">Bank Name : </dt>
                <dd class="col-sm-9 fst-italic text-muted">
                    {{ $record->name }}
                </dd>
            </dl>

            <dl class="mb-3 row">
                <dt class="col-sm-3">Bank accounts: </dt>
                <dd class="col-sm-9 ">
                @foreach ($record->bankAccounts as $account)
                    <span class="mb-3 d-block">
                        <span class="text-muted ">A/C holder: {{ $account->account_name }}</span>
                        <span class="text-muted d-block">A/C no: {{ $account->account_number }}</span>
                        <span class="text-muted d-block">Branch: {{ $account->branch }}</span>
                        <span class="text-muted d-block">Balance: {{ $account->balance ?? 0.00 }}</span>
                    </span>
                @endforeach
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
