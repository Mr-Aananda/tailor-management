<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'distribution.index') ? 'active' : '' }}" href="{{ route('distribution.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'distribution.create') ? 'active' : '' }}" href="{{ route('distribution.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'distribution.trash') ? 'active' : '' }}" href="{{ route('distribution.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
