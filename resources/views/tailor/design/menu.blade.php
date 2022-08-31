<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'design.index') ? 'active' : '' }}" href="{{ route('design.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'design.create') ? 'active' : '' }}" href="{{ route('design.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'design.trash') ? 'active' : '' }}" href="{{ route('design.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
