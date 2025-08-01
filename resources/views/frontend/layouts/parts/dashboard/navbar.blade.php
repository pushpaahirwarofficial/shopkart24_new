<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src=" {{ asset('/assets/dashboard/img/user-dummy.png') }}"
                            alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('/assets/dashboard/img/user-dummy.png') }}"
                                            alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                 <div class="flex-grow-1">
                                            <span class="fw-medium d-block">
                                               Admin
                                                </span>
                                        </div>
                            </div>
                        </a>
                    </li>
                     <li><hr class="dropdown-divider"></li>
                            <li>
        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                  
                </ul>
            </li>





            <!--/ User -->
        </ul>
    </div>
</nav>

<!-- / Navbar -->