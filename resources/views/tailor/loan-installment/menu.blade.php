<div class="print-none">
    <ul class="mt-2 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'loan.index') ? 'active' : '' }}" href="{{ route('loan.index') }}">All Loan</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'loan.create') ? 'active' : '' }}" href="{{ route('loan.create') }}">New loan</a>
        </li>

         <li class="nav-item">
            <a class="nav-link {{ (Route::currentRouteName() == 'loan-installment.index') ? 'active' : '' }}" href="{{ route('loan-installment.index') }}">Installments</a>
        </li>

    </ul>
</div>
