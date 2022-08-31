<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'expense-category.index') ? 'active' : '' }}" href="{{ route('expense-category.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'expense-category.create') ? 'active' : '' }}" href="{{ route('expense-category.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'expense-category.trash') ? 'active' : '' }}" href="{{ route('expense-category.trash') }}">Recycle Bin</a>
        </li> --}}
    </ul>
</div>
