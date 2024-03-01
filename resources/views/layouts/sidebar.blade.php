<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/guestbook" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('bm-old.png') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('bm-old-long.png') }}" alt="" height="45">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/beranda" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('bm-old.png') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('bm-old-long.png') }}" alt="" height="45">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav d-flex justify-content-between" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link fw-medium {{ Request::routeIs('beranda.index') ? 'active fw-bold' : '' }}"
                        href="{{ route('beranda.index') }}" role="button" aria-expanded="false"
                        aria-controls="sidebarApps">
                        <i class="ri-home-4-line"></i> <span>@lang('Halaman Utama')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#menuAdmin" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="menuAdmin">
                        <i class=" ri-admin-line"></i> <span>Menu Admin</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Request::routeIs('jabatan.index') || Request::routeIs('pejabat.index') || Request::routeIs('database.index') ? 'show' : '' }}" id="menuAdmin">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link fw-medium {{ Request::routeIs('jabatan.index') ? 'active fw-bold' : '' }}"
                                    href="{{ route('jabatan.index') }}" role="button" aria-expanded="false"
                                    aria-controls="sidebarApps">
                                    <i class="ri-briefcase-4-line"></i> <span>@lang('Referensi Jabatan')</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link fw-medium {{ Request::routeIs('pejabat.index') ? 'active fw-bold' : '' }}"
                                    href="{{ route('pejabat.index') }}" role="button" aria-expanded="false"
                                    aria-controls="sidebarApps">
                                    <i class="ri-user-star-line"></i> <span>@lang('Pejabat BUMDes')</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link menu-link fw-medium {{ Request::routeIs('setting.index') ? 'active fw-bold' : '' }}"
                                    href="{{ route('setting.index') }}" role="button" aria-expanded="false"
                                    aria-controls="sidebarApps">
                                    <i class="ri-settings-3-line"></i> <span>@lang('Setting')</span>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link fw-medium {{ Request::routeIs('database.index') ? 'active fw-bold' : '' }}"
                                    href="{{ route('database.index') }}" role="button" aria-expanded="false"
                                    aria-controls="sidebarApps">
                                    <i class="ri-database-2-line"></i> <span>@lang('Database')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#menuPeminjam" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="menuPeminjam">
                        <i class="ri-contacts-book-line"></i> <span>Data Peminjam</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Request::routeIs('peminjam-kelompok.index') || Request::routeIs('peminjam-single.index') || Request::is('peminjam-kelompok/*') || Request::is('peminjam-single/*') ? 'show' : '' }}" id="menuPeminjam">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link fw-medium {{ Request::routeIs('peminjam-kelompok.index') || Request::is('peminjam-kelompok/*') ? 'active fw-bold' : '' }}"
                                    href="{{ route('peminjam-kelompok.index') }}" role="button" aria-expanded="false"
                                    aria-controls="sidebarApps">
                                    <i class="ri-team-fill"></i> <span>@lang('Kelompok')</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link fw-medium {{ Request::routeIs('peminjam-single.index') || Request::is('peminjam-single/*') ? 'active fw-bold' : '' }}"
                                    href="{{ route('peminjam-single.index') }}" role="button" aria-expanded="false"
                                    aria-controls="sidebarApps">
                                    <i class="ri-user-search-fill"></i> <span>@lang('Perorangan')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#menuAngsuran" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="menuAngsuran">
                        <i class="ri-money-dollar-circle-line"></i> <span>Angsuran</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Request::routeIs('angsuran-kelompok.daftar-peminjam') || Request::routeIs('angsuran-single.daftar-peminjam') || Request::is('angsuran-kelompok/*') || Request::is('angsuran-single/*') ? 'show' : '' }}" id="menuAngsuran">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link fw-medium {{ Request::routeIs('angsuran-kelompok.daftar-peminjam') || Request::is('angsuran-kelompok/*') ? 'active fw-bold' : '' }}"
                                    href="{{ route('angsuran-kelompok.daftar-peminjam') }}" role="button" aria-expanded="false"
                                    aria-controls="sidebarApps">
                                    <i class="ri-team-line"></i> <span>@lang('Kelompok')</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link fw-medium {{ Request::routeIs('angsuran-single.daftar-peminjam') || Request::is('angsuran-single/*') ? 'active fw-bold' : '' }}"
                                    href="{{ route('angsuran-single.daftar-peminjam') }}" role="button" aria-expanded="false"
                                    aria-controls="sidebarApps">
                                    <i class="ri-user-search-line"></i> <span>@lang('Perorangan')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link fw-medium {{ Request::routeIs('inventaris.index') ? 'active fw-bold' : '' }}"
                        href="{{ route('inventaris.index') }}" role="button" aria-expanded="false"
                        aria-controls="sidebarApps">
                        <i class="ri-tools-fill"></i> <span>@lang('Data Inventaris')</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
