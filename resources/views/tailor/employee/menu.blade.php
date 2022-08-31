<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'employee.index') ? 'active' : '' }}" href="{{ route('employee.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'employee.create') ? 'active' : '' }}" href="{{ route('employee.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'employee.trash') ? 'active' : '' }}" href="{{ route('employee.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
