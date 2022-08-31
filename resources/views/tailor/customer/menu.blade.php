<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'customer.index') ? 'active' : '' }}" href="{{ route('customer.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'customer.create') ? 'active' : '' }}" href="{{ route('customer.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'customer.trash') ? 'active' : '' }}" href="{{ route('customer.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
