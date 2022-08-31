<x-app-layout>
    <x-slot name="title">Owner's Equity</x-slot>

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
            <div class="card-header p-0 border-0 d-md-flex align-items-center d-block print-none">
                <!-- page title -->
                <div class="mt-3 mb-2">
                    <h4 class="main-title">Owner's Equity</h4>
                    <p><small>A Statement of Owner's Equity (SOE) shows the owner's capital at the start of the period, the changes that affect capital, and the resulting capital at the end of the period. The formula is: <strong>OE = C + (Re - Ex - D)</strong>.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('reports.balanceSheet') }}" class="btn top-icon-button " title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="card-body p-0">
                <!-- search form -->
                <form action="{{ route('reports.ownersEquity') }}" method="GET" class="print-none">
                    <input type="hidden" name="search" value="1"/>

                    <div class="row gy-1 gx-3">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <label for="ownersequity-year" class="form-label required">Year </label>
                            <select name="ownersEquityYear" class="form-control" id="ownersequity-year" required>
                                <option value="" selected disabled> -- </option>

                                @for ($year = $startYear; $year <= date('Y'); $year++)
                                    <option value="{{ $year }}" {{ (request()->ownersEquityYear == $year) ? 'selected' : '' }}> {{ $year }} </option>
                                @endfor
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
                    <!-- Owners Equities table -->
                    <table class="table custom-table table-hover mb-4">
                        <thead>
                            <tr>
                                <th scope="col">Owners Equities (OE) </th>
                                <th scope="col" class="w-300p text-end">{{ $ownersEquityYear }} </th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $totalOwnersEquity = 0.00;
                            @endphp

                            @foreach ($ownersEquityDetails as $ownersEquity)
                                @php
                                    $total = $ownersEquity['debit_amount'] - $ownersEquity['credit_amount'];
                                    $totalOwnersEquity += $total;
                                @endphp

                                @if ($total != 0)
                                <tr>
                                    <td>{{ $ownersEquity['account_name'] }} (# {{ str_pad($ownersEquity['account_id'], 3, "0", STR_PAD_LEFT) }})</td>
                                    <td class="text-end">{{ ($total < 0) ? number_format(abs($total), 2) : number_format(0 - $total, 2) }} </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th scope="col">Total Owner's Equities </th>
                                <th scope="col" class="text-end">
                                    {{ ($totalOwnersEquity < 0) ? number_format(abs($totalOwnersEquity), 2) : number_format($totalOwnersEquity, 2) }}  
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- Owners Equities table end -->
                </div>
                <!-- data table end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>