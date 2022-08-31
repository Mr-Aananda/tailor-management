<x-app-layout>
    <x-slot name="title">Trial balance report</x-slot>

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
                    <h4 class="main-title">Trial balance report</h4>

                    @if ($records)
                        <p><small>About {{ count($records) }} results found.</small></p>
                    @endif
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('reports.trialBalance') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="card-body p-0">
                <!-- search form -->
                <form action="{{ route('reports.trialBalance') }}" method="GET" class="print-none">
                    <input type="hidden" name="search" value="1"/>

                    <div class="row gy-1 gx-3">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <label for="account-id" class="form-label required">Account </label>
                            <select name="account_id" class="form-control" id="account-id" required>
                                <option value="" selected disabled> -- </option>

                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" {{ (request()->account_id == $account->id) ? 'selected' : '' }}>{{ $account->name }}</option>
                                @endforeach
                            </select>
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
                                <th scope="col">Account name </th>
                                <th scope="col" class="text-end">Debit</th>
                                <th scope="col" class="text-end">Credit</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $total_debit_balance = $total_credit_balance = 0.00;
                            @endphp

                            @foreach ($records as $index => $record)
                                @php
                                    $current_balance = $record['debit_amount'] - $record['credit_amount'];
                                @endphp

                                @if ($current_balance != 0)
                                <tr>
                                    <td>{{ $record['account_name'] }} (# {{ str_pad($record['account_id'], 3, "0", STR_PAD_LEFT) }})</td>
                                    <td class="text-end">
                                        @if ($current_balance >= 0)
                                            {{ number_format(abs($current_balance), 2) }}

                                            @php
                                                $total_debit_balance += $current_balance;
                                            @endphp
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if ($current_balance < 0)
                                            {{ number_format(abs($current_balance), 2) }}

                                            @php
                                                $total_credit_balance += $current_balance;
                                            @endphp
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th class="text-end">Total</th>
                                <th class="text-end">{{ number_format(abs($total_debit_balance), 2) }}</th>
                                <th class="text-end">{{ number_format(abs($total_credit_balance), 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>