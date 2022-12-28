{{-- Sidebar --}}
<ul class="navbar-nav bg-gradient-primary sidebar
sidebar-dark accordion" id="accordionSidebar">
    {{-- Sidebar Brand --}}
    <a href="index.html" class="sidebar-brand d-flex
    align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <i class="fab fa-apple"></i>
        </div>
        <div class="sidebar-brand-text mx-3">APPLE STORE</div>
    </a>

    {{-- Divider --}}
    <hr class="sidebar-divider my-0">

    {{-- Nav Item - Dashboard --}}
    <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span class="text-uppercase">Dashboard</span>
        </a>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider">

    {{-- Heading --}}
    <div class="sidebar-heading text-uppercase">
        Produk
    </div>

    {{-- Nav Item - Page Collapse Menu --}}
    <li class="nav-item {{ Request::is('admin/categories*') ? 'active' : '' }}
    {{ Request::is('admin/product*') ? 'active' : '' }}">
        <a href="#" class="nav-link collapsed" data-toggle="collapse"
        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-shopping-bag"></i>
            <span class="text-uppercase">Produk</span>
        </a>
        <div id="collapseTwo" class="collapse {{ Request::is('admin/categories*') ? 'show' : '' }}
        {{ Request::is('admin/products*') ? 'show' : '' }}"
        aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header text-uppercase">Kategori & Produk</h6>
                <a href="{{ route('admin.categories.index') }}" class="collapse-item text-uppercase {{ Request::is('admin/category*') ? 'active' : '' }}">Kategori</a>
                <a href="{{ route('admin.products.index') }}" class="collapse-item text-uppercase {{ Request::is('admin/product*') ? 'active' : '' }}">Produk</a>
            </div>
        </div>
    </li>

    <div class="sidebar-heading text-uppercase">
        Orders
    </div>

    <li class="nav-item {{ Request::is('admin/order*') ? 'active' : '' }}">
        <a href="{{ route('admin.orders.index') }}" class="nav-link">
            <i class="fas fa-shopping-cart"></i>
            <span class="text-uppercase">Orders</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/customer*') ? 'active' : '' }}">
        <a href="{{ route('admin.customer.index') }}" class="nav-link">
            <i class="fas fa-users"></i>
            <span class="text-uppercase">Customers</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/slider*') ? 'active' : '' }}">
        <a href="{{ route('admin.sliders.index') }}" class="nav-link">
            <i class="fas fa-laptop"></i>
            <span class="text-uppercase">Sliders</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/profile*') ? 'active' : '' }}">
        <a href="{{ route('admin.profile.index') }}" class="nav-link">
            <i class="fas fa-user-circle"></i>
            <span class="text-uppercase">Profile</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/user*') ? 'active' : '' }}">
        <a href="{{ route('admin.users.index') }}" class="nav-link">
            <i class="fas fa-users"></i>
            <span class="text-uppercase">Users</span>
        </a>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider d-none d-md-block">

    {{-- Sidebar Toggler --}}
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
