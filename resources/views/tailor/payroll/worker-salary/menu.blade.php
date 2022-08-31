<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'worker-salary.index') ? 'active' : '' }}" href="{{ route('worker-salary.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'worker-salary.create') ? 'active' : '' }}" href="{{ route('worker-salary.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'employee.trash') ? 'active' : '' }}" href="{{ route('employee.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
