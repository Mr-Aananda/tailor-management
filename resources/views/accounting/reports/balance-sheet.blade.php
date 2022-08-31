<x-app-layout>
    <x-slot name="title">Balance sheet</x-slot>

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
                    <h4 class="main-title">Balance sheet</h4>
                    <p><small>There is three(3) parts. One is <strong>Asset(A)</strong>, 2nd one is <strong>Liabilities(L)</strong> & the last one is <strong>Owner's Equity</strong>. The of balance sheet is: sum of <strong>assets accounts</strong> = sum of <strong>liabilities accounts</strong> + sum of <strong>OE accounts</strong>.</small></p>
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
                <form action="{{ route('reports.balanceSheet') }}" method="GET" class="print-none">
                    <input type="hidden" name="search" value="1"/>

                    <div class="row gy-1 gx-3">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <label for="balancesheet-year" class="form-label required">Year </label>
                            <select name="balanceSheetYear" class="form-control" id="balancesheet-year" required>
                                <option value="" selected disabled> -- </option>

                                @for ($year = $startYear; $year <= date('Y'); $year++)
                                    <option value="{{ $year }}" {{ (request()->balanceSheetYear == $year) ? 'selected' : '' }}> {{ $year }} </option>
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
                    <!-- assets table -->
                    <table class="table custom-table table-hover mb-4">
                        <thead>
                            <tr>
                                <th scope="col">Assets (A) </th>
                                <th scope="col" class="w-300p text-end">{{ $balanceSheetYear }} </th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $totalBalanceSheetAsset = 0.00;
                            @endphp

                            @foreach ($balanceSheetAssets as $balanceSheetAsset)
                                @php
                                    $total = $balanceSheetAsset['debit_amount'] - $balanceSheetAsset['credit_amount'];
                                    $totalBalanceSheetAsset += $total;
                                @endphp

                                @if ($total != 0)
                                <tr>
                                    <td>{{ $balanceSheetAsset['account_name'] }} (# {{ str_pad($balanceSheetAsset['account_id'], 3, "0", STR_PAD_LEFT) }})</td>
                                    <td class="text-end">{{ number_format(abs($total), 2) }} </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th scope="col">Total Assets </th>
                                <th scope="col" class="text-end">{{ number_format(abs($totalBalanceSheetAsset), 2) }}  </th>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- assets table end -->

                    <!-- liabilities table -->
                    <table class="table custom-table table-hover mb-4">
                        <thead>
                            <tr>
                                <th scope="col">Liabilities (L) </th>
                                <th scope="col" class="w-300p text-end">{{ $balanceSheetYear }} </th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $totalBalanceSheetLiabilities = 0.00;
                            @endphp

                            @foreach ($balanceSheetLiabilities as $balanceSheetLiabilitie)
                                @php
                                    $total = $balanceSheetLiabilitie['debit_amount'] - $balanceSheetLiabilitie['credit_amount'];
                                    $totalBalanceSheetLiabilities += $total;
                                @endphp

                                @if ($total != 0)
                                <tr>
                                    <td>{{ $balanceSheetLiabilitie['account_name'] }} (# {{ str_pad($balanceSheetLiabilitie['account_id'], 3, "0", STR_PAD_LEFT) }})</td>
                                    <td class="text-end">{{ number_format(abs($total), 2) }} </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th scope="col">Total Liabilities </th>
                                <th scope="col" class="text-end">{{ number_format(abs($totalBalanceSheetLiabilities), 2) }}  </th>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- liabilities table end -->

                    <!-- Owners Equities table -->
                    <table class="table custom-table table-hover mb-4">
                        <thead>
                            <tr>
                                <th scope="col">Owners Equities (OE) </th>
                                <th scope="col" class="w-300p text-end">{{ $balanceSheetYear }} </th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $totalBalanceSheetOwnersEquities = 0.00;
                            @endphp

                            @foreach ($balanceSheetOwnersEquities as $balanceSheetOwnersEquity)
                                @php
                                    $total = $balanceSheetOwnersEquity['debit_amount'] - $balanceSheetOwnersEquity['credit_amount'];
                                    $totalBalanceSheetOwnersEquities += $total;
                                @endphp

                                @if ($total != 0)
                                <tr>
                                    <td>{{ $balanceSheetOwnersEquity['account_name'] }} (# {{ str_pad($balanceSheetOwnersEquity['account_id'], 3, "0", STR_PAD_LEFT) }})</td>
                                    <td class="text-end">{{ number_format(abs($total), 2) }} </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th scope="col">Total Owner's Equities </th>
                                <th scope="col" class="text-end">{{ number_format(abs($totalBalanceSheetOwnersEquities), 2) }}  </th>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- Owners Equities table end -->

                    <!-- total liabilities & Owner's Equities -->
                    <table class="table custom-table table-hover">
                        <tr>
                            <th>Total liabilities & Owner's Equities</th>
                            <th class="text-end w-300p">{{ number_format(abs($totalBalanceSheetLiabilities + $totalBalanceSheetOwnersEquities), 2) }}</th>
                        </tr>
                    </table>
                    <!-- total liabilities & Owner's Equities end -->
                </div>
                <!-- data table end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>