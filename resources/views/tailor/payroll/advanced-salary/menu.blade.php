<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'advanced-salary.index') ? 'active' : '' }}" href="{{ route('advanced-salary.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'advanced-salary.create') ? 'active' : '' }}" href="{{ route('advanced-salary.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'worker.trash') ? 'active' : '' }}" href="{{ route('worker.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>

