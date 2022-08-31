<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'cash.index') ? 'active' : '' }}" href="{{ route('cash.index') }}">All Records</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'cash.create') ? 'active' : '' }}" href="{{ route('cash.create') }}">New Entry</a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'employee.trash') ? 'active' : '' }}" href="{{ route('employee.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
