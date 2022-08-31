<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'fitting.index') ? 'active' : '' }}" href="{{ route('fitting.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'fitting.create') ? 'active' : '' }}" href="{{ route('fitting.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'fitting.trash') ? 'active' : '' }}" href="{{ route('fitting.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
