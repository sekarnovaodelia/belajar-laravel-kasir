<div class="sidebar">
    <div class="sidebar-header">
        <h4><i class="bi bi-shop"></i> KASIR APP</h4>
    </div>

    {{-- PROFIL AKUN & LOGOUT DI ATAS MENU DASHBOARD --}}
    @auth
    <div class="px-3 py-2 border-bottom border-secondary border-opacity-25">
        <div class="dropdown">
            <button class="btn btn-dark border border-secondary border-opacity-50 w-100 btn-sm d-flex align-items-center justify-content-between px-2 py-2 rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-flex align-items-center gap-2 text-truncate">
                    <i class="bi bi-person-circle text-primary fs-6"></i>
                    <div class="text-start text-truncate" style="line-height: 1.2;">
                        <span class="d-block fw-semibold text-white small text-truncate">{{ auth()->user()->name }}</span>
                        <span class="d-block text-secondary" style="font-size: 0.7rem;">{{ ucfirst(auth()->user()->role ?? 'User') }}</span>
                    </div>
                </div>
                <i class="bi bi-chevron-down text-secondary small ms-1"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-dark w-100 shadow-sm border-secondary border-opacity-25 mt-1">
                <li>
                    <span class="dropdown-item-text text-secondary small text-truncate">
                        {{ auth()->user()->email }}
                    </span>
                </li>
                <li><hr class="dropdown-divider border-secondary border-opacity-25 my-1"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger small fw-semibold">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    @endauth

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="sidebar-menu-title">Transaksi</li>
        <li>
            <a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.index') || request()->routeIs('transaksi.create') ? 'active' : '' }}">
                <i class="bi bi-cart"></i> Kasir
            </a>
        </li>
        <li>
            <a href="{{ route('pelanggan.index') }}" class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Pelanggan
            </a>
        </li>
        @if(auth()->user()->role === 'admin')
        <li class="sidebar-menu-title">Master Data</li>
        <li>
            <a href="{{ route('jenis.index') }}" class="{{ request()->routeIs('jenis.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Jenis Barang
            </a>
        </li>
        <li>
            <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Barang
            </a>
        </li>
        <li>
            <a href="{{ route('supplier.index') }}" class="{{ request()->routeIs('supplier.*') ? 'active' : '' }}">
                <i class="bi bi-truck"></i> Supplier
            </a>
        </li>
        <li class="sidebar-menu-title">Inventori</li>
        <li>
            <a href="{{ route('stok-masuk.index') }}" class="{{ request()->routeIs('stok-masuk.*') ? 'active' : '' }}">
                <i class="bi bi-box-arrow-in-down"></i> Stok Masuk
            </a>
        </li>
        <li class="sidebar-menu-title">Laporan</li>
        <li>
            <a href="{{ route('transaksi.laporan') }}" class="{{ request()->routeIs('transaksi.laporan') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Laporan Transaksi
            </a>
        </li>
        @endif
    </ul>
</div>