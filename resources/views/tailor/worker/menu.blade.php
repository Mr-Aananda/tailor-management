<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'worker.index') ? 'active' : '' }}" href="{{ route('worker.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'worker.create') ? 'active' : '' }}" href="{{ route('worker.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'worker.trash') ? 'active' : '' }}" href="{{ route('worker.trash') }}">Recycle Bin</a>
        </li> --}}

    </ul>
</div>
