<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'expense-subcategory.index') ? 'active' : '' }}" href="{{ route('expense-subcategory.index') }}">All Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'expense-subcategory.create') ? 'active' : '' }}" href="{{ route('expense-subcategory.create') }}">New Entry</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'expense-subcategory.trash') ? 'active' : '' }}" href="{{ route('expense-subcategory.trash') }}">Recycle Bin</a>
        </li> --}}
    </ul>
</div>
