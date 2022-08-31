<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'voucher.index') ? 'active' : '' }}" href="{{ route('voucher.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'voucher.create') ? 'active' : '' }}" href="{{ route('voucher.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'worker.trash') ? 'active' : '' }}" href="{{ route('worker.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
