<ul class="accordion" id="asideAccordion">
    <!-- Basic -->
    <li class="ps-3 py-1 fw-bold">Basic</li>

    <li class="accordion-item">
        <a href="{{ route('role-policy') }}" class="single-nav-link {{ \Request::route()->getName() == 'role-policy' ? 'active' : ''}}">
            <i class="bi bi-house"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#policy" aria-expanded="false" aria-controls="policy">
            <i class="bi bi-person-lines-fill"></i>
            <span>Add Policy</span>
        </a>

        <ul id="policy" class="accordion-collapse collapse" aria-labelledby="headingPolicy" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('policy.index', ['service' => 'accounting']) }}" class="nav-link">Accounting</a></li>
            <li><a href="{{ route('policy.index', ['service' => 'crm']) }}" class="nav-link">CRM</a></li>
            <li><a href="{{ route('policy.index', ['service' => 'hrms']) }}" class="nav-link">HRMS</a></li>
            <li><a href="{{ route('policy.index', ['service' => 'settings']) }}" class="nav-link">Settings</a></li>
        </ul>
    </li>
    <!-- Basic end -->

    <!-- Settings -->
    <li class="ps-3 py-1 mt-2 fw-bold">Settings</li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu" aria-expanded="false" aria-controls="menu">
            <i class="bi bi-person-lines-fill"></i>
            <span>Menu </span>
        </a>

        <ul id="menu" class="accordion-collapse collapse" aria-labelledby="headingMenu" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('menu.index') }}" class="nav-link">All Records</a></li>
            <li><a href="{{ route('menu.create') }}" class="nav-link">New Entry</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#user" aria-expanded="false" aria-controls="user">
            <i class="bi bi-person-lines-fill"></i>
            <span>User </span>
        </a>

        <ul id="user" class="accordion-collapse collapse" aria-labelledby="headingUser" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('user.index') }}" class="nav-link">All Records</a></li>
            <li><a href="{{ route('user.create') }}" class="nav-link">New Entry</a></li>
        </ul>
    </li>

    <li class="accordion-item">
        <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#role" aria-expanded="false" aria-controls="role">
            <i class="bi bi-card-checklist"></i>
            <span>Role</span>
        </a>

        <ul id="role" class="accordion-collapse collapse" aria-labelledby="headingRole" data-bs-parent="#asideAccordion">
            <li><a href="{{ route('role.index') }}" class="nav-link">All Records</a></li>
            <li><a href="{{ route('role.create') }}" class="nav-link">New Entry</a></li>
        </ul>
    </li>
    <!-- Settings end -->
</ul>
