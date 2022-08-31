<!-- container menu -->
<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'reports.ledger') ? 'active' : '' }}" href="{{ route('reports.ledger') }}">Ledger</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'reports.trialBalance') ? 'active' : '' }}" href="{{ route('reports.trialBalance') }}">Trial balance</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'reports.balanceSheet') ? 'active' : '' }}" href="{{ route('reports.balanceSheet') }}">Balance sheet</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'reports.incomeStatement') ? 'active' : '' }}" href="{{ route('reports.incomeStatement') }}">Income Statement</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'reports.ownersEquity') ? 'active' : '' }}" href="{{ route('reports.ownersEquity') }}">Owner's Equity</a>
        </li>
    </ul>
</div>
<!-- container menu end -->