<x-app-layout>
    <x-slot name="title">Contact </x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.index') }}">All Records</a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 border-0 card-header d-flex mb-3">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Contact details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    <a href="{{ route('contact.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
        
                <div class="p-0 card-body">
                    <h4>{{ $record->organigation_name }} </h4>
                    <p class="mt-1 mb-3 fst-italic text-muted">
                        @if ($record->created_at != null )
                            <span>{{ $record->created_at->format('d F, Y') }}</span> | 
                        @endif

                        <span>{{ $contactTypes[$record->contact_type] }}</span>
                    </p>

                    <dl class="mb-3 row">
                        <dt class="col-sm-3">Contact person : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->contact_person_name }} ({{ $record->gender }})
                        </dd>
                    </dl>

                    @if ($record->father_name != null )
                    <dl class="mb-3 row">
                        <dt class="col-sm-3">Father's name : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->father_name }}
                        </dd>
                    </dl>
                    @endif

                    @if ($record->mother_name != null )
                    <dl class="mb-3 row">
                        <dt class="col-sm-3">Mother's name : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->mother_name }}
                        </dd>
                    </dl>
                    @endif

                    @if ($record->date_of_birth != null )
                    <dl class="mb-3 row">
                        <dt class="col-sm-3">Date of birth : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->date_of_birth->format('d F, Y') }}
                        </dd>
                    </dl>
                    @endif

                    <dl class="mb-3 row">
                        <dt class="col-sm-3">NID : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->nid ?? 'N/A' }}
                        </dd>
                    </dl>

                    <dl class="mb-3 row">
                        <dt class="col-sm-3">Email address : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->email_address }}
                        </dd>
                    </dl>

                    <dl class="mb-3 row">
                        <dt class="col-sm-3">Opening balance : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            {{ $record->opening_balance }} (Credit limit: {{ $record->credit_limit }})
                        </dd>
                    </dl>

                    <dl class="mb-3 row">
                        <dt class="col-sm-3">Mobile number(s) : </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            @foreach ($record->phones as $phone)
                                <span class="d-block">
                                    {{ $phone->mobile_number }}
                                    {{ $phone->is_primary ? '(Primary)' : '' }}
                                </span>
                            @endforeach
                        </dd>
                    </dl>

                    @foreach ($record->addresses as $address)
                    <dl class="mb-3 row">
                        <dt class="col-sm-3">
                            {{ ucfirst(str_replace('_', ' ', $address->address_type)) }} : 
                        </dt>
                        <dd class="col-sm-9 fst-italic text-muted">
                            <span class="d-block">Street: {{ $address->street }}</span>
                            <span class="d-block">Postal code: {{ $address->postal_code ?? 'N/A' }}</span>
                            <span class="d-block">Union: {{ $address->union ?? 'N/A' }}</span>
                            <span class="d-block">Upazila: {{ $address->upazila }}</span>
                            <span class="d-block">District: {{ $address->district }}</span>
                            <span class="d-block">Division: {{ $address->division }}</span>
                        </dd>
                    </dl>
                    @endforeach

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