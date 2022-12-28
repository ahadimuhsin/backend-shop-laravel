<nav class="navbar navbar-expand navbar-light bg-white
topbar mb-4 static-top shadow">
    {{-- Sidebar Toggle (Topbar) --}}
    <button id="sidebarToggleTop" class="btn btn-link d-md-none
                    rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    {{-- Topbar Navbar --}}
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        {{-- Nav Item - User Information --}}
        <li class="nav-item dropdown no-arrow">
            <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase">
                    {{ auth()->user()->name }}
                </span>
                <img src="{{ auth()->user()->avatar_url }}" alt="" class="img-profile rounded-circle">
            </a>

            {{-- Dropdown - User Information --}}
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400 text-uppercase">
                        Logout
                    </i>
                </a>
            </div>
        </li>

    </ul>
</nav>
