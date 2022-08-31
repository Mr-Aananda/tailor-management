<header>
    <nav class="navbar page-navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Aside expand button -->
            <div class="expand-button">
                <button class="btn btn-success p-1" onclick="asideExpand()">
                    <i class="bi bi-list-nested"></i>
                </button>
            </div>
            <!-- End aside expand button -->

            <!-- Responsive button -->
            <div class="service-dropdown ms-3">
                <div class="button dropdown-toggle" type="button" id="services" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <a href="#">Services </a>
                </div>

                <div class="dropdown-menu" aria-labelledby="services">
                  <div class="container-fluid">
                    <div class="service-wrapper dropdown">
                      <div class="row g-4">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                          <div class="row gy-2">
                            <div class="col-12">
                              <a href="{{ route('tailor.dashboard') }}" class="service">
                                <i class="bi bi-bag-check"></i>
                                <p>Tailor</p>
                              </a>
                            </div>
                            <div class="col-12">
                              <a href="{{ route('tailor.dashboard') }}" class="service">
                                <i class="bi bi-basket"></i>
                                <p>CRM</p>
                              </a>
                            </div>
                            <div class="col-12">
                              <a href="{{ route('tailor.dashboard') }}" class="service">
                                <i class="bi bi-people"></i>
                                <p>Developer</p>
                              </a>
                            </div>
                            <div class="col-12">
                              <a href="{{ route('tailor.dashboard') }}" class="service">
                                <i class="bi bi-calculator"></i>
                                <p>Role & Policy</p>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Responsive button -->

            <button class="navbar-toggler p-1 ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
            <!-- End responsive button -->

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav my-2 text-end ms-auto mb-lg-0 py-3 py-lg-0">
                    <!-- Help -->
                    {{-- <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">
                            <span class=" me-3 me-lg-1">Help</span>
                            <i class="bi bi-info-circle"></i>
                        </a>
                    </li> --}}
                    <!-- Search -->
                    {{-- <li class="nav-item ">
                        <a class="nav-link" href="#" id="search-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-lg-none me-3">Search</span>
                            <i class="bi bi-search"></i>
                        </a>
                        <div class="dropdown-menu search-dropdown p-2"  aria-labelledby="search-dropdown">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search ....">
                                <button class="btn" type="submit"><i class="bi bi-search"></i></button>
                            </form>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">
                                    <i class="bi bi-search"></i>
                                    <span>Dapibus ac facilisis in</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <i class="bi bi-search"></i>
                                    <span>Dapibus ac facilisis in</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <i class="bi bi-search"></i>
                                    <span>Dapibus ac facilisis in</span>
                                </a>
                            </div>
                        </div>
                    </li> --}}
                    <!-- Notification -->
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="notification-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-lg-none me-3">Notification</span>
                            <i class="bi bi-bell"></i>
                        </a>
                        <ul class="dropdown-menu notification-dropdown py-2" aria-labelledby="notification-dropdown">
                            <h5 class="ms-3 mb-1">Notification</h5>
                            <hr>
                            <li><a class="dropdown-item " href="#">Dapibus ac facilisis in</a></li>
                            <li><a class="dropdown-item " href="#">Morbi leo risus</a></li>
                            <li><a class="dropdown-item " href="#">Porta ac consectetur ac</a></li>
                            <li><a class="dropdown-item " href="#">Vestibulum at eros</a></li>
                            <hr>
                            <div class="text-center mt-1">
                                <a href="#">See all</a>
                            </div>

                        </ul>
                    </li> --}}
                    <!-- Settings -->
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link " href="#"  id="settings-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-lg-none me-3">Settings</span>
                            <i class="bi bi-gear"></i>
                        </a>

                        <div class="dropdown-menu settings-dropdown"  aria-labelledby="settings-dropdown">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item pb-2"><strong>Company </strong></li>
                                        <li class="list-group-item"><a href="company_profile.html" class="list-group-item-action">Company Profile</a></li>
                                        <li class="list-group-item"><a href="employee_list.html" class="list-group-item-action">Employees</a></li>
                                        <li class="list-group-item"><a href="about_us.html" class="list-group-item-action">About Us</a></li>
                                        <li class="list-group-item"><a href="services.html" class="list-group-item-action">Services</a></li>
                                        <li class="list-group-item"><a href="#" class="list-group-item-action">Role</a></li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item pb-2"><strong>Cras justo odio</strong></li>
                                        <li class="list-group-item"><a href="terms.html" class="list-group-item-action">Terms & Conditions</a></li>
                                        <li class="list-group-item"><a href="asked_question.html" class="list-group-item-action">FAQs</a></li>
                                        <li class="list-group-item"><a href="license.html" class="list-group-item-action">License</a></li>
                                        <li class="list-group-item"><a href="copyright.html" class="list-group-item-action">Copyright</a></li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item pb-2"><strong>Cras justo odio</strong></li>
                                        <li class="list-group-item"><a href="#" class="list-group-item-action">Cras justo odio</a></li>
                                        <li class="list-group-item"><a href="#" class="list-group-item-action">Cras justo odio</a></li>
                                        <li class="list-group-item"><a href="#" class="list-group-item-action">Cras justo odio</a></li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item pb-2"><strong>Cras justo odio</strong></li>
                                        <li class="list-group-item"><a href="#" class="list-group-item-action">Cras justo odio</a></li>
                                        <li class="list-group-item"><a href="#" class="list-group-item-action">Cras justo odio</a></li>
                                        <li class="list-group-item"><a href="#" class="list-group-item-action">Cras justo odio</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-lg-none me-3">Profile</span>
                            <i class="bi bi-person"></i>
                        </a>
                        <ul class="dropdown-menu"  aria-labelledby="user-dropdown">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex align-items-center my-2">
                                        <img src="{{ asset('images/user/user2.png') }}" class="user-icon" alt="avatar">
                                        <div class="ms-2">
                                            <h6>{{ \Illuminate\Support\Facades\Auth::user()->name }}</h6>
                                            <div class="text-small">
                                                {{ \Illuminate\Support\Facades\Auth::user()->email }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <hr>
                            {{-- <li><a class="dropdown-item" href="user_settings.html">Settings</a></li> --}}
                            {{-- <li><a class="dropdown-item" href="attendance.html">Attendance</a></li> --}}
                            <li><a class="dropdown-item" href="{{ route('password.reset') }}">Change Password</a></li>
                            <hr>
                            <li>
                                <a href="#" class="list-group-item list-group-item-action" onclick="document.getElementById('top-logout-form').submit(); return false;"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                                <form action="{{ route('logout') }}" method="POST" id="top-logout-form">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>


