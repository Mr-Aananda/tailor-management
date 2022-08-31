<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'due-payments.index') ? 'active' : '' }}" href="{{ route('due-payments.index') }}">All Records</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'due-payments.create') ? 'active' : '' }}" href="{{ route('due-payments.create') }}">New Entry</a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'due-payments.trash') ? 'active' : '' }}" href="{{ route('due-payments.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
