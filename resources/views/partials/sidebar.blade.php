<div class="sidebar">
    <div class="sidebar-header">
        <h4><i class="bi bi-shop"></i> KASIR APP</h4>
    </div>
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