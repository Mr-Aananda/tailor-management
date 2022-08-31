<x-app-layout>
    <x-slot name="title">Journal </x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('journal.index') }}">All Records</a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('journal.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('journal.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 border-0 card-header d-flex mb-3">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Journal details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    <a href="{{ route('journal.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>

                </div>
        
                <div class="p-0 card-body">
                    <h4>{{ $record->template->particular }}</h4>
                    @if ($record->created_at != null )
                        <p class="mt-1 mb-3 fst-italic text-muted">
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $record->entry_date)->format('d F Y') }}
                        </p>
                    @endif

                    <dl class="mb-3 row">
                        <dt class="col-sm-3">Amount : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            @foreach ($record->journalDetails as $details)
                                <div class="d-flex justify-content-between col-4 ps-{{ $details->is_debit ? '' : '3' }}">
                                    <span>{{ $details->account->name }}</span>

                                    @if ($details->is_debit)
                                        <span>(Dr.) <strong class="ms-3">{{ number_format($details->amount, 2) }}</strong></span>
                                    @else
                                        <span">(Cr.) <strong class="ms-3">{{ number_format($details->amount, 2) }}</strong></span>
                                    @endif
                                </div>
                            @endforeach
                        </dd>

                        @if ($record->depreciation)
                            <dt class="col-sm-3">Depreciation : </dt>
                            <dd class="col-sm-9 fst-italic text-muted">
                                <span class="d-block">Approximate year to use: <strong>{{ $record->depreciation->years }} years</strong></span>
                                <span class="d-block">Fund per year: <strong>{{ number_format($record->depreciation->amount, 2) }}</strong></span>
                            </dd>
                        @endif

                        <dt class="col-sm-3">Spender : </dt>
                        <dd class="col-sm-9 fst-italic">
                            <a href="{{ route('contact.show', $record->contact_id) }}" target="_blank">
                                {{ $record->contact->contact_person_name }}
                            </a>
                        </dd>

                        <dt class="col-sm-3">Operator : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->user->name }} 
                        </dd>
                    </dl>

                    <article class="mb-3 regular-size">
                        <h4>Note</h4>
                        <p class="fst-italic text-muted">
                            {{ $record->note }}
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>