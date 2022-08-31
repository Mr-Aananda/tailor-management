<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'payment-type.index') ? 'active' : '' }}" href="{{ route('payment-type.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'payment-type.create') ? 'active' : '' }}" href="{{ route('payment-type.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'payment-type.trash') ? 'active' : '' }}" href="{{ route('payment-type.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
