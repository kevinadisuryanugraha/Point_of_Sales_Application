<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" style="text-decoration: none" href="{{ url('dashboard') }}">
            <span class="text-white">Warung MaVins</span>
        </a>
        <a class="sidebar-brand brand-logo-mini" href="{{ url('dashboard') }}">
            <span class="text-white">Warung MaVins</span>
        </a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{ asset('assets/assets/images/profil_mavins.png') }}"
                            alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ auth()->user()->name }}</h5>
                        <span>{{ auth()->user()->roles->pluck('name')->implode(', ') }}</span>
                    </div>
                </div>
                <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                    aria-labelledby="profile-dropdown">
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ url('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item preview-item"
                            style="border: none; background: none; width: 100%; text-align: left;">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-logout text-danger"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">Log out</p>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </li>

        {{-- Menu untuk semua role --}}
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('dashboard') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- Menu untuk Admin + Kasir --}}
        @if (auth()->user()->hasAnyRole(['Admin', 'Kasir']))
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('products.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-package-variant-closed"></i>
                    </span>
                    <span class="menu-title">Product</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">Categories</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-cash-multiple"></i>
                    </span>
                    <span class="menu-title">Kasir</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('transaksi.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-file-document-box"></i>
                    </span>
                    <span class="menu-title">Transaksi</span>
                </a>
            </li>
        @endif

        {{-- Menu untuk Admin + Manajemen --}}
        @if (auth()->user()->hasAnyRole(['Admin', 'Manajemen']))
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('keuangan.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-chart-line"></i>
                    </span>
                    <span class="menu-title">Laporan Keuangan</span>
                </a>
            </li>
        @endif
    </ul>

</nav>
