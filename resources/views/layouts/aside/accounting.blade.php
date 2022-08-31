@php
    $currentRouteName = Route::currentRouteName();
    [$currentRoute, $routeName] = explode('.', $currentRouteName);
@endphp

<ul class="accordion" id="asideAccordion">
    <!-- Basic -->
    <li class="py-1 ps-3 fw-bold">
        Basic
    </li>

    <li class="accordion-item">
        <a href="{{ route('accounting.dashboard') }}" class="single-nav-link active">
            <i class="bi bi-house"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'journal') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#journal"
            aria-expanded="{{ ($currentRoute == 'journal') ? 'true' : 'false' }}"
            aria-controls="journal">
            <i class="bi bi-calculator"></i>
            <span>Transaction </span>
        </a>

        <ul id="journal"
            class="accordion-collapse collapse {{ ($currentRoute == 'journal') ? 'show' : '' }}"
            aria-labelledby="headingJournal"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('journal.index') }}" class="nav-link {{ ($currentRouteName == 'journal.index') ? 'active' : '' }}">
                    All Records
                </a>
            </li>

            <li>
                <a href="{{ route('journal.create') }}" class="nav-link {{ ($currentRouteName == 'journal.create') ? 'active' : '' }}">
                    New Entry
                </a>
            </li>
        </ul>
    </li>

    <!-- contact nav -->
    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'contact') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#contact"
            aria-expanded="{{ ($currentRoute == 'contact') ? 'true' : 'false' }}"
            aria-controls="contact">
            <i class="bi bi-people"></i>
            <span>Contact</span>
        </a>

        <ul id="contact"
            class="accordion-collapse collapse {{ ($currentRoute == 'contact') ? 'show' : '' }}"
            aria-labelledby="headingContact"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('contact.index') }}" class="nav-link {{ ($currentRouteName == 'contact.index') ? 'active' : '' }}">
                    All Records
                </a>

            </li>
            <li>
                <a href="{{ route('contact.create') }}" class="nav-link {{ ($currentRouteName == 'contact.create') ? 'active' : '' }}">
                    New Entry
                </a>
            </li>
        </ul>
    </li>
    <!-- contact nav end -->

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#banking" aria-expanded="false" aria-controls="banking">
            <i class="bi bi-credit-card"></i>
            <span>Banking</span>
        </a>

        <ul id="banking" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#asideAccordion">
            <li><a href="" class="nav-link">All Transaction</a></li>
            <li><a href="" class="nav-link">New Transaction</a></li>
        </ul>
    </li>

    <!-- report -->
    <li class="accordion-item">
        <a href="#" class="accordion-button {{ ($currentRoute == 'reports') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#reports" aria-expanded="{{ ($currentRoute == 'reports') ? 'true' : 'false' }}" aria-controls="reports">
            <i class="bi bi-graph-up"></i>
            <span>Reports</span>
        </a>

        <ul id="reports" class="accordion-collapse collapse {{ ($currentRoute == 'reports') ? 'show' : '' }}" aria-labelledby="headingReports" data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('reports.ledger') }}" class="nav-link {{ ($currentRouteName == 'reports.ledger') ? 'active' : '' }}">
                    Ledger
                </a>
            </li>
            <li>
                <a href="{{ route('reports.trialBalance') }}" class="nav-link {{ ($currentRouteName == 'reports.trialBalance') ? 'active' : '' }}">
                    Trial Balance
                </a>
            </li>
            <li>
                <a href="{{ route('reports.balanceSheet') }}" class="nav-link {{ ($currentRouteName == 'reports.balanceSheet') ? 'active' : '' }}">
                    Balance Sheet
                </a>
            </li>
            <li>
                <a href="{{ route('reports.incomeStatement') }}" class="nav-link {{ ($currentRouteName == 'reports.incomeStatement') ? 'active' : '' }}">
                    Income Statement
                </a>
            </li>

            {{--
            <li>
                <a href="#" class="nav-link {{ ($currentRouteName == 'reports.index') ? 'active' : '' }}">
                    Cash flow Sheet
                </a>
            </li>
            --}}

            <li>
                <a href="{{ route('reports.ownersEquity') }}" class="nav-link {{ ($currentRouteName == 'reports.ownersEquity') ? 'active' : '' }}">
                    OE Sheet
                </a>
            </li>
        </ul>
    </li>
    <!-- report -->
    <!-- Basic end -->

    <!-- Settings -->
    <li class="py-1 mt-2 ps-3 fw-bold">Settings</li>

    <!-- Element nav -->
    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'elements') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#element"
            aria-expanded="{{ ($currentRoute == 'elements') ? 'true' : 'false' }}"
            aria-controls="element">
            <i class="bi bi-columns-gap"></i>
            <span>Element </span>
        </a>

        <ul id="element"
            class="accordion-collapse collapse {{ ($currentRoute == 'elements') ? 'show' : '' }}"
            aria-labelledby="headingElement"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('elements.index') }}"
                    class="nav-link {{ ($currentRouteName == 'elements.index') ? 'active' : '' }}">
                    All Records
                </a>
            </li>
        </ul>
    </li>
    <!-- Element nav end -->

    <!-- Account nav -->
    <li class="accordion-item">
        <a href="#"
        class="accordion-button {{ ($currentRoute == 'accounts') ? '' : 'collapsed' }}"
        data-bs-toggle="collapse"
        data-bs-target="#account"
        aria-expanded="{{ ($currentRoute == 'accounts') ? 'true' : 'false' }}"
        aria-controls="account">
            <i class="bi bi-folder-plus"></i>
            <span>Account</span>
        </a>

        <ul id="account" class="accordion-collapse collapse {{ ($currentRoute == 'accounts') ? 'show' : '' }}" aria-labelledby="headingAccount" data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('accounts.index') }}" class="nav-link {{ ($currentRouteName == 'accounts.index') ? 'active' : '' }}">
                    All Records
                </a>
            </li>

            <li>
                <a href="{{ route('accounts.create') }}" class="nav-link {{ ($currentRouteName == 'accounts.create') ? 'active' : '' }}">
                    New Entry
                </a>
            </li>
        </ul>
    </li>
    <!-- Account nav end -->

    <!-- Group nav -->
    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'group') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#group"
            aria-expanded="{{ ($currentRoute == 'group') ? 'true' : 'false' }}"
            aria-controls="group">
            <i class="bi bi-collection"></i>
            <span>Group</span>
        </a>

        <ul id="group"
            class="accordion-collapse collapse {{ ($currentRoute == 'group') ? 'show' : '' }}"
            aria-labelledby="headingGroup"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('group.index') }}"
                    class="nav-link {{ ($currentRouteName == 'group.index') ? 'active' : '' }}">
                    All Records
                </a>
            </li>

            <li>
                <a href="{{ route('group.create') }}"
                    class="nav-link {{ ($currentRouteName == 'group.create') ? 'active' : '' }}">
                    New Entry
                </a>
            </li>
        </ul>
    </li>
    <!-- Group nav end -->

    <!-- Template nav -->
    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'template') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#template"
            aria-expanded="{{ ($currentRoute == 'template') ? 'true' : 'false' }}"
            aria-controls="template">
            <i class="bi bi-journal-album"></i>
            <span>Template</span>
        </a>

        <ul id="template"
            class="accordion-collapse collapse {{ ($currentRoute == 'template') ? 'show' : '' }}"
            aria-labelledby="headingTemplate"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('template.index') }}"
                    class="nav-link {{ ($currentRouteName == 'template.index') ? 'active' : '' }}">
                    All Records
                </a>
            </li>

            <li>
                <a href="{{ route('template.create') }}"
                    class="nav-link {{ ($currentRouteName == 'template.create') ? 'active' : '' }}">
                    New Entry
                </a>
            </li>
        </ul>
    </li>
    <!-- Template nav end -->

    <!-- bank & bank-account nav -->
    <li class="accordion-item">
            <a href="#"
            class="accordion-button {{ ($currentRoute == 'bank' || $currentRoute == 'bankAccount') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#bank"
            aria-expanded="{{ ($currentRoute == 'bank' || $currentRoute == 'bankAccount') ? 'true' : 'false' }}"
            aria-controls="banking">
            <i class="bi bi-credit-card"></i>
            <span>Bank</span>
        </a>

        <ul id="bank"
        class="accordion-collapse collapse {{ ($currentRoute == 'bank' || $currentRoute == 'bankAccount') ? 'show' : '' }}"
        aria-labelledby="headingThree"
        data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('bank.index') }}"
                class="nav-link {{ ($currentRouteName == 'bank.index') ? 'active' : '' }}">All Bank</a>
            </li>

              <li>
                <a href="{{ route('bankAccount.index') }}"
                class="nav-link {{ ($currentRouteName == 'bankAccount.index') ? 'active' : '' }}">All Accounts</a>
            </li>

            <li>
                <a href="{{ route('bank.create') }}"
                class="nav-link {{ ($currentRouteName == 'bank.create') ? 'active' : '' }}">New Bank</a>
            </li>

        </ul>
    </li>
    <!-- bank & bank-account nav end -->
    <!-- Settings end -->
</ul>
