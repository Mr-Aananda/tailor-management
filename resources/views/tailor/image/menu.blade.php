<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'image.index') ? 'active' : '' }}" href="{{ route('image.index') }}">All Images</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'image.create') ? 'active' : '' }}" href="{{ route('image.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'fitting.trash') ? 'active' : '' }}" href="{{ route('fitting.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
