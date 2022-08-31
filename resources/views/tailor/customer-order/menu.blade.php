<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'customer-order.index') ? 'active' : '' }}" href="{{ route('customer-order.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'customer-order.create') ? 'active' : '' }}" href="{{ route('customer-order.create') }}">New Entry</a>
        </li>
{{--
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'customer-order.previousRecords') ? 'active' : '' }}" href="{{ route('customer-order.previousRecords') }}">Previous records</a>
        </li> --}}

    </ul>
</div>
