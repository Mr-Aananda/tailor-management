<ul class="accordion" id="asideAccordion">
    <!-- Basic -->
    <li class="ps-3 py-1 fw-bold">Basic</li>

    <li class="accordion-item">
        <a href="{{ route('crm') }}" class="single-nav-link {{ \Request::route()->getName() == 'crm' ? 'active' : ''}}">
            <i class="bi bi-house"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#dailyTransaction" aria-expanded="false" aria-controls="dailyTransaction">
            <i class="bi bi-calculator"></i>
            <span>Employees</span>
        </a>

        <ul id="dailyTransaction" class="accordion-collapse collapse" aria-labelledby="headingDailyTransaction" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('dailyTransaction.index') }}" class="nav-link">All Records</a></li>
            <li><a href="{{ route('dailyTransaction.create') }}" class="nav-link">New Entry</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#parties" aria-expanded="false" aria-controls="parties">
            <i class="bi bi-people"></i>
            <span>Attendance</span>
        </a>

        <ul id="parties" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('party.index') }}" class="nav-link">All Party</a></li>
            <li><a href="{{ route('party.create') }}" class="nav-link">New Party</a></li>
        </ul>
    </li>
    <!-- Basic end -->

    <!-- Settings -->
    <li class="ps-3 py-1 mt-2 fw-bold">Settings</li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#element" aria-expanded="false" aria-controls="element">
            <i class="bi bi-columns-gap"></i>
            <span>Element</span>
        </a>

        <ul id="element" class="accordion-collapse {{ (\Illuminate\Support\Facades\Route::currentRouteName() == 'element.index' OR \Illuminate\Support\Facades\Route::currentRouteName() == 'element.create') ? 'active' : 'collapse' }}" aria-labelledby="headingElement" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('element.index') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'element.index' ? 'active' : '' }}">All Records</a></li>
            <li><a href="{{ route('element.create') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'element.create' ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#account" aria-expanded="false" aria-controls="account">
            <i class="bi bi-folder-plus"></i>
            <span>Ledger account</span>
        </a>

        <ul id="account" class="accordion-collapse {{ (\Illuminate\Support\Facades\Route::currentRouteName() == 'ledger-account.index' OR \Illuminate\Support\Facades\Route::currentRouteName() == 'ledger-account.create') ? 'active' : 'collapse' }}" aria-labelledby="headingAccount" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('ledger-account.index') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'ledger-account.index' ? 'active' : '' }}">All Records</a></li>
            <li><a href="{{ route('ledger-account.create') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'ledger-account.create' ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#journal" aria-expanded="false" aria-controls="journal">
            <i class="bi bi-card-list"></i>
            <span>Journal</span>
        </a>

        <ul id="journal" class="accordion-collapse {{ (\Illuminate\Support\Facades\Route::currentRouteName() == 'journal.index' OR \Illuminate\Support\Facades\Route::currentRouteName() == 'journal.create') ? 'active' : 'collapse' }}" aria-labelledby="headingJournal" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('journal.index') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'journal.index' ? 'active' : '' }}">All Records</a></li>
            <li><a href="{{ route('journal.create')  }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'journal.create' ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#cash" aria-expanded="false" aria-controls="cash">
            <i class="bi bi-cash"></i>
            <span>Cash</span>
        </a>

        <ul id="cash" class="accordion-collapse {{ (\Illuminate\Support\Facades\Route::currentRouteName() == 'cash.index' OR \Illuminate\Support\Facades\Route::currentRouteName() == 'cash.create') ? 'active' : 'collapse' }}" aria-labelledby="headingAccount" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('cash.index') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'cash.index' ? 'active' : '' }}">All Cash</a></li>
            <li><a href="{{ route('cash.create') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'cash.create' ? 'active' : '' }}">New Cash</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#bank" aria-expanded="false" aria-controls="banking">
            <i class="bi bi-credit-card"></i>
            <span>Bank</span>
        </a>

        <ul id="bank" class="accordion-collapse {{ (\Illuminate\Support\Facades\Route::currentRouteName() == 'bank.index' OR \Illuminate\Support\Facades\Route::currentRouteName() == 'bank.create') ? 'active' : 'collapse' }}" aria-labelledby="headingThree" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('bank.index') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'bank.index' ? 'active' : '' }}">All Bank</a></li>
            <li><a href="{{ route('bank.create') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'bank.create' ? 'active' : '' }}">New Bank</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#bank-account" aria-expanded="false" aria-controls="banking">
            <i class="bi bi-credit-card"></i>
            <span>Bank Account</span>
        </a>

        <ul id="bank-account" class="accordion-collapse {{ (\Illuminate\Support\Facades\Route::currentRouteName() == 'bank-account.index' OR \Illuminate\Support\Facades\Route::currentRouteName() == 'bank-account.create') ? 'active' : 'collapse' }}" aria-labelledby="headingThree" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('bank-account.index') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'bank-account.index' ? 'active' : '' }}">All Bank Account</a></li>
            <li><a href="{{ route('bank-account.create') }}" class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'bank-account.create' ? 'active' : '' }}">New Bank Account</a></li>
        </ul>
    </li>
    <!-- Settings end -->
</ul>