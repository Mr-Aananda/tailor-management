<x-app-layout>
    <x-slot name="title">Ledger report</x-slot>

    <div class="container">
        <!-- container menu -->
        @include('layouts.partials.reportsMenu')
        <!-- container menu end -->

        <!-- print header -->
        @include('layouts.partials.printHead')
        <!-- print header end -->

        <!-- card start -->
        <div class="card border-0">
            <!-- card head -->
            <div class="card-header p-0 border-0 d-md-flex align-items-center d-block">
                <!-- page title -->
                <div class="mt-3 mb-2">
                    <h4 class="main-title">Ledger report</h4>
                    @if ($records)
                        <p><small>About {{ count($records) }} results found.</small></p>
                    @endif
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('reports.ledger') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="card-body p-0">
                <!-- search form -->
                <form action="{{ route('reports.ledger') }}" method="GET" class="print-none">
                    <input type="hidden" name="search" value="1"/>

                    <div class="row gy-1 gx-3">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <label for="account-id" class="form-label">Account </label>
                            <select name="account_id" class="form-control" id="account-id">
                                <option value="" selected disabled> -- </option>

                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" {{ (request()->account_id == $account->id) ? 'selected' : '' }}>{{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-3 col-lg-2">
                            <label for="from-date" class="form-label">From date</label>
                            <input type="date" name="from_date" value="{{ request()->from_date ?? '' }}" class="form-control" id="from-date"> 
                        </div>

                        <div class="col-12 col-sm-3 col-lg-2">
                            <label for="to-date" class="form-label">To date</label>
                            <input type="date" name="to_date" value="{{ request()->to_date ?? '' }}" class="form-control" id="to-date">
                        </div>

                        <!-- button -->
                        <div class="col-12 col-sm-6 col-lg-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-block w-100 custom-btn btn-success">
                                <i class="bi bi-search"></i>
                                <span class="p-1">Search</span>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- search area end --> 

                <!-- data table -->
                <div class="table-responsive mt-3 mb-3">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Date</th>
                                <th scope="col">Particulars</th>
                                <th scope="col" class="text-end" title="Reference number">Ref.</th>
                                <th scope="col" class="text-end">Debit</th>
                                <th scope="col" class="text-end">Credit</th>
                                <th scope="col" class="text-center" colspan="2">Balance</th>
                            </tr>

                            <tr>
                                <th scope="col" colspan="6">&nbsp;</th>
                                <th scope="col" class="text-end">Debit</th>
                                <th scope="col" class="text-end">Credit</th>
                            </tr>
                        </thead>

                        @if ($records)
                        <tbody>
                            @php
                                $currentBalance = 0.00;
                            @endphp

                            @forelse($records as $index => $record)
                            <tr>
                                <td scope="row">{{ $index + $records->firstItem() }}.</td>
                                <td>{{  $record->journal_entry_date->format('d M Y') }}</td>

                                <td>{{ $record->pair_account_name }} (# {{ str_pad($record->pair_account_id, 3, "0", STR_PAD_LEFT) }})</td>

                                <td scope="col" class="text-end" title="Journal ID #{{ $record->journal_id }}">
                                    <a href="{{ route('journal.show', $record->journal_id) }}" target="_blank">{{ $record->journal_id }}</a>
                                </td>

                                <td class="text-end">
                                    @if ($record->is_debit)
                                        @php
                                            $currentBalance += $record->amount;
                                        @endphp

                                        {{ number_format($record->amount, 2) }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="text-end">
                                    @if ($record->is_credit)
                                        @php
                                            $currentBalance -= $record->amount;
                                        @endphp

                                        {{ number_format($record->amount, 2) }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="text-end">{{ ($currentBalance >= 0) ? number_format($currentBalance, 2) : '-' }}</td>
                                <td class="text-end">
                                    {{ ($currentBalance < 0) ? number_format(abs($currentBalance), 2) : '-' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <tfoot>
                            <tr>
                                <th colspan="8">Records not available.</th>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="card-footer print-none mb-5">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($records)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>