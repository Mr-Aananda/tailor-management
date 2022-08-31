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
        <a href="{{ route('tailor.dashboard') }}" class="single-nav-link active">
            <i class="bi bi-house"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'customer') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#customer"
            aria-expanded="{{ ($currentRoute == 'customer') ? 'true' : 'false' }}"
            aria-controls="customer">
            <i class="bi bi-person"></i>
            <span>Customer</span>
        </a>

        <ul id="customer"
            class="accordion-collapse collapse {{ ($currentRoute == 'customer') ? 'show' : '' }}"
            aria-labelledby="headingCustomer"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('customer.index') }}" class="nav-link {{ ($currentRouteName == 'customer.index') ? 'active' : '' }}">
                    All customers
                </a>
            </li>

            <li>
                <a href="{{ route('customer.create') }}" class="nav-link {{ ($currentRouteName == 'customer.create') ? 'active' : '' }}">
                    New customer
                </a>
            </li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'customer-order') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#customer-order"
            aria-expanded="{{ ($currentRoute == 'customer-order') ? 'true' : 'false' }}"
            aria-controls="customer-order">
            <i class="bi bi-people"></i>
            <span>Customer Order </span>
        </a>

        <ul id="customer-order"
            class="accordion-collapse collapse {{ ($currentRoute == 'customer-order') ? 'show' : '' }}"
            aria-labelledby="headingCustomer-order"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('customer-order.index') }}" class="nav-link {{ ($currentRouteName == 'customer-order.index') ? 'active' : '' }}">
                    All Records
                </a>
            </li>

            <li>
                <a href="{{ route('customer-order.create') }}" class="nav-link {{ ($currentRouteName == 'customer-order.create') ? 'active' : '' }}">
                    New Order
                </a>
            </li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'distribution') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#distribution"
            aria-expanded="{{ ($currentRoute == 'distribution') ? 'true' : 'false' }}"
            aria-controls="distribution">
            <i class="bi bi-arrow-right-square"></i>
            <span>Distribution</span>
        </a>

        <ul id="distribution"
            class="accordion-collapse collapse {{ ($currentRoute == 'distribution') ? 'show' : '' }}"
            aria-labelledby="headingDistribution"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('distribution.index') }}" class="nav-link {{ ($currentRouteName == 'distribution.index') ? 'active' : '' }}">
                    All distribute & received
                </a>
            </li>

            <li>
                <a href="{{ route('distribution.create') }}" class="nav-link {{ ($currentRouteName == 'distribution.create') ? 'active' : '' }}">
                    New distribute
                </a>
            </li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'due-payments') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#due-payments"
            aria-expanded="{{ ($currentRoute == 'due-payments') ? 'true' : 'false' }}"
            aria-controls="due-payments">
           <i class="bi bi-cash"></i>
            <span>Payments</span>
        </a>

        <ul id="due-payments"
            class="accordion-collapse collapse {{ ($currentRoute == 'due-payments') ? 'show' : '' }}"
            aria-labelledby="headingDue-payments"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('due-payments.index') }}" class="nav-link {{ ($currentRouteName == 'due-payments.index') ? 'active' : '' }}">
                    All Records
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('due-payments.create') }}" class="nav-link {{ ($currentRouteName == 'due-payments.create') ? 'active' : '' }}">
                    New Entry
                </a>
            </li> --}}
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'expense' || $currentRoute == 'expense-category' || $currentRoute ==  'expense-subcategory') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#expense"
            aria-expanded="{{ ($currentRoute == 'expense' || $currentRoute == 'expense-category' || $currentRoute == 'expense-subcategory') ? 'true' : 'false' }}"
            aria-controls="expense">
            <i class="bi bi-wallet2"></i>
            <span>Daily Expenses </span>
        </a>

        <ul id="expense"
            class="accordion-collapse collapse {{ ($currentRoute == 'expense' || $currentRoute == 'expense-category' || $currentRoute ==  'expense-subcategory') ? 'show' : '' }}"
            aria-labelledby="headingExpense"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('expense.index') }}" class="nav-link {{ ($currentRouteName == 'expense.index') ? 'active' : '' }}">
                    All Expenses
                </a>
            </li>

            <li>
                <a href="{{ route('expense.create') }}" class="nav-link {{ ($currentRouteName == 'expense.create') ? 'active' : '' }}">
                    New Entry
                </a>
            </li>

            <li>
                <a href="{{ route('expense-category.index') }}" class="nav-link {{ ($currentRouteName == 'expense-category.index') ? 'active' : '' }}">
                    Category
                </a>
            </li>

            <li>
                <a href="{{ route('expense-subcategory.index') }}" class="nav-link {{ ($currentRouteName == 'expense-subcategory.index') ? 'active' : '' }}">
                    Subcategory
                </a>
            </li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#"
            class="accordion-button {{ ($currentRoute == 'employee-salary' || $currentRoute == 'worker-salary' || $currentRoute == 'advanced-salary' || $currentRoute == 'loan') ? '' : 'collapsed' }}"
            data-bs-toggle="collapse"
            data-bs-target="#payroll"
            aria-expanded="{{ ($currentRoute == 'employee-salary' || $currentRoute == 'worker-salary' || $currentRoute == 'advanced-salary' || $currentRoute == 'loan') ? 'true' : 'false' }}"
            aria-controls="payroll">
            <i class="bi bi-credit-card-2-front"></i>
            <span>Payroll </span>
        </a>

        <ul id="payroll"
            class="accordion-collapse collapse {{ ($currentRoute == 'employee-salary' || $currentRoute == 'worker-salary' || $currentRoute == 'advanced-salary' || $currentRoute == 'loan') ? 'show' : '' }}"
            aria-labelledby="headingPayroll"
            data-bs-parent="#asideAccordion">
            <li>
                <a href="{{ route('employee-salary.index') }}" class="nav-link {{ ($currentRouteName == 'employee-salary.index') ? 'active' : '' }}">
                     Employee salary
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('employee-salary.create') }}" class="nav-link {{ ($currentRouteName == 'employee-salary.create') ? 'active' : '' }}">
                    Employee salary
                </a>
            </li> --}}

           <li>
                <a href="{{ route('advanced-salary.index') }}" class="nav-link {{ ($currentRouteName == 'advanced-salary.index') ? 'active' : '' }}">
                    Advanced
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('advanced-salary.create') }}" class="nav-link {{ ($currentRouteName == 'advanced-salary.create') ? 'active' : '' }}">
                    New advanced
                </a>
            </li> --}}

            <li>
                <a href="{{ route('loan.index') }}" class="nav-link {{ ($currentRouteName == 'loan.index') ? 'active' : '' }}">
                    Loan
                </a>
            </li>

            <li>
                <a href="{{ route('worker-salary.index') }}" class="nav-link {{ ($currentRouteName == 'worker-salary.index') ? 'active' : '' }}">
                    Worker Payments
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('worker-salary.create') }}" class="nav-link {{ ($currentRouteName == 'worker-salary.create') ? 'active' : '' }}">
                    Worker payments
                </a>
            </li> --}}
        </ul>
    </li>


    <!-- report -->

    <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'ledger-report') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#ledger-report" aria-expanded="{{ ($currentRoute == 'ledger-report') ? 'true' : 'false' }}" aria-controls="ledger-report">
            <i class="bi bi-card-heading"></i>
            <span>Reports</span>
        </a>

        <ul id="ledger-report" class="accordion-collapse collapse {{ ($currentRoute == 'ledger-report') ? 'show' : '' }}" aria-labelledby="headingLedger-report" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('ledger-report.customer') }}" class="nav-link {{ ($currentRouteName == 'ledger-report.customer') ? 'active' : '' }}">Customer ledger</a></li>
            <li><a href="{{ route('ledger-report.worker') }}" class="nav-link {{ ($currentRouteName == 'ledger-report.worker') ? 'active' : '' }}">Worker ledger</a></li>
        </ul>
    </li>

    <!-- report -->

     <!-- SMS -->

    {{-- <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'sms' || $currentRoute == 'sms') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#sms" aria-expanded="{{ ($currentRoute == 'sms'|| $currentRoute == 'sms') ? 'true' : 'false' }}" aria-controls="sms">
            <i class="bi bi-envelope"></i>
            <span>SMS</span>
        </a>

        <ul id="sms" class="accordion-collapse collapse {{ ($currentRoute == 'sms'|| $currentRoute == 'sms') ? 'show' : '' }}" aria-labelledby="headingSms" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('sms.groupSms') }}" class="nav-link {{ ($currentRouteName == 'sms.groupSms') ? 'active' : '' }}">Group sms</a></li>
            <li><a href="{{ route('sms.customSms') }}" class="nav-link {{ ($currentRouteName == 'sms.customSms') ? 'active' : '' }}">Custom sms</a></li>
        </ul>
    </li> --}}

    <!-- SMS -->
    <!-- Basic end -->

    <!-- Settings -->
    <li class="py-1 mt-2 ps-3 fw-bold">Settings</li>

    <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'items') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#items" aria-expanded="{{ ($currentRoute == 'items') ? 'true' : 'false' }}" aria-controls="items">
            <i class="bi bi-columns-gap"></i>
            <span>Items</span>
        </a>

        <ul id="items" class="accordion-collapse collapse {{ ($currentRoute == 'items') ? 'show' : '' }}" aria-labelledby="headingItems" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('items.index') }}" class="nav-link {{ ($currentRouteName == 'items.index') ? 'active' : '' }}">All Records</a></li>
            <li><a href="{{ route('items.create') }}" class="nav-link {{ ($currentRouteName == 'items.create') ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'design') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#design" aria-expanded="{{ ($currentRoute == 'design') ? 'true' : 'false' }}" aria-controls="design">
            <i class="bi bi-grid-3x3"></i>
            <span>Design</span>
        </a>

        <ul id="design" class="accordion-collapse collapse {{ ($currentRoute == 'design') ? 'show' : '' }}" aria-labelledby="headingDesign" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('design.index') }}" class="nav-link {{ ($currentRouteName == 'design.index') ? 'active' : '' }}">All Records</a></li>
            <li><a href="{{ route('design.create') }}" class="nav-link {{ ($currentRouteName == 'design.create') ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'fitting') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#fitting" aria-expanded="{{ ($currentRoute == 'fitting') ? 'true' : 'false' }}" aria-controls="fitting">
            <i class="bi bi-box"></i>
            <span>Fitting</span>
        </a>

        <ul id="fitting" class="accordion-collapse collapse {{ ($currentRoute == 'fitting') ? 'show' : '' }}" aria-labelledby="headingFitting" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('fitting.index') }}" class="nav-link {{ ($currentRouteName == 'fitting.index') ? 'active' : '' }}">All Records</a></li>
            <li><a href="{{ route('fitting.create') }}" class="nav-link {{ ($currentRouteName == 'fitting.create') ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'worker') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#worker" aria-expanded="{{ ($currentRoute == 'worker') ? 'true' : 'false' }}" aria-controls="worker">
            <i class="bi bi-people"></i>
            <span>Worker</span>
        </a>

        <ul id="worker" class="accordion-collapse collapse {{ ($currentRoute == 'worker') ? 'show' : '' }}" aria-labelledby="headingWorker" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('worker.index') }}" class="nav-link {{ ($currentRouteName == 'worker.index') ? 'active' : '' }}">All Records</a></li>
            <li><a href="{{ route('worker.create') }}" class="nav-link {{ ($currentRouteName == 'worker.create') ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'employee') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#employee" aria-expanded="{{ ($currentRoute == 'employee') ? 'true' : 'false' }}" aria-controls="employee">
            <i class="bi bi-person-badge"></i>
            <span>Employee</span>
        </a>

        <ul id="employee" class="accordion-collapse collapse {{ ($currentRoute == 'employee') ? 'show' : '' }}" aria-labelledby="headingEmployee" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('employee.index') }}" class="nav-link {{ ($currentRouteName == 'employee.index') ? 'active' : '' }}">All Employee</a></li>
            <li><a href="{{ route('employee.create') }}" class="nav-link {{ ($currentRouteName == 'employee.create') ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li>

     <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'cash') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#cash" aria-expanded="{{ ($currentRoute == 'cash') ? 'true' : 'false' }}" aria-controls="cash">
            <i class="bi bi-cash-stack"></i>
            <span>Cash</span>
        </a>

        <ul id="cash" class="accordion-collapse collapse {{ ($currentRoute == 'cash') ? 'show' : '' }}" aria-labelledby="headingCash" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('cash.index') }}" class="nav-link {{ ($currentRouteName == 'cash.index') ? 'active' : '' }}">All Records</a></li>
            {{-- <li><a href="{{ route('cash.create') }}" class="nav-link {{ ($currentRouteName == 'cash.create') ? 'active' : '' }}">New Entry</a></li> --}}
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'voucher') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#voucher" aria-expanded="{{ ($currentRoute == 'voucher') ? 'true' : 'false' }}" aria-controls="voucher">
            <i class="bi bi-upc-scan"></i>
            <span>Voucher</span>
        </a>

        <ul id="voucher" class="accordion-collapse collapse {{ ($currentRoute == 'voucher') ? 'show' : '' }}" aria-labelledby="headingVoucher" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('voucher.index') }}" class="nav-link {{ ($currentRouteName == 'voucher.index') ? 'active' : '' }}">All Records</a></li>
            <li><a href="{{ route('voucher.create') }}" class="nav-link {{ ($currentRouteName == 'voucher.create') ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li>

    {{-- <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'payment-type') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#payment-type" aria-expanded="{{ ($currentRoute == 'payment-type') ? 'true' : 'false' }}" aria-controls="payment-type">
            <i class="bi bi-credit-card-2-back"></i>
            <span>Payment Type</span>
        </a>

        <ul id="payment-type" class="accordion-collapse collapse {{ ($currentRoute == 'payment-type') ? 'show' : '' }}" aria-labelledby="headingPayment-type" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('payment-type.index') }}" class="nav-link {{ ($currentRouteName == 'payment-type.index') ? 'active' : '' }}">All Records</a></li>
            <li><a href="{{ route('payment-type.create') }}" class="nav-link {{ ($currentRouteName == 'payment-type.create') ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li> --}}

    <li class="accordion-item">
        <a href="#" class="accordion-button  {{ ($currentRoute == 'image') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#image" aria-expanded="{{ ($currentRoute == 'image') ? 'true' : 'false' }}" aria-controls="image">
            <i class="bi bi-image"></i>
            <span>Images</span>
        </a>

        <ul id="image" class="accordion-collapse collapse {{ ($currentRoute == 'image') ? 'show' : '' }}" aria-labelledby="headingImage" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('image.index') }}" class="nav-link {{ ($currentRouteName == 'image.index') ? 'active' : '' }}">All Images</a></li>
            <li><a href="{{ route('image.create') }}" class="nav-link {{ ($currentRouteName == 'image.create') ? 'active' : '' }}">New Entry</a></li>
        </ul>
    </li>

    <!-- Settings end -->
</ul>
