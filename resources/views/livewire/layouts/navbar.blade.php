    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html"
                target="_blank">
                <img src="{{ asset('assets/admin') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Soft UI Dashboard</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.dashboard') === 0 ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-dashboard text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Users</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.users') === 0 ? 'active' : '' }}"
                        href="{{ route('admin.users') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manage Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ strpos(Route::currentRouteName(), 'admin.contact') === 0 ? 'active' : '' }}"
                        href="{{ route('admin.contact') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-address-book text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manage Contact</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Tables List</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ strpos(Route::currentRouteName(), 'table.kerja.index') === 0 ? 'active' : '' }}"
                        href="{{ route('table.kerja.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-briefcase text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Table Kerja</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ strpos(Route::currentRouteName(), 'table.kuliah.index') === 0 ? 'active' : '' }}"
                        href="{{ route('table.kuliah.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-university text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Table Kuliah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ strpos(Route::currentRouteName(), 'table.kerja-kuliah.index') === 0 ? 'active' : '' }}"
                        href="{{ route('table.kerja-kuliah.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-globe text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Table Kerja dan Kuliah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ strpos(Route::currentRouteName(), 'table.mencari-kerja.index') === 0 ? 'active' : '' }}"
                        href="{{ route('table.mencari-kerja.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-search-dollar text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Table Mencari Kerja</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ strpos(Route::currentRouteName(), 'table.usaha.index') === 0 ? 'active' : '' }}"
                        href="{{ route('table.usaha.index') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-building text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Table Membuka Usaha</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ strpos(Route::currentRouteName(), 'profile') === 0 ? 'active' : '' }}"
                        href="{{ route('profile') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
