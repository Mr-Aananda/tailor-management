<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'items.index') ? 'active' : '' }}" href="{{ route('items.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'items.create') ? 'active' : '' }}" href="{{ route('items.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'items.trash') ? 'active' : '' }}" href="{{ route('items.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
