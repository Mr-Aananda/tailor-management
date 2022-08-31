<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'expense.index') ? 'active' : '' }}" href="{{ route('expense.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'expense.create') ? 'active' : '' }}" href="{{ route('expense.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'expense.trash') ? 'active' : '' }}" href="{{ route('expense.trash') }}">Recycle Bin</a>
        </li> --}}
    </ul>
</div>
