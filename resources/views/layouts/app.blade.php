<!DOCTYPE html>
<html>
<head>
    <title>Kasir App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Kasir App</a>
        <div class="d-flex align-items-center">
            <a href="{{ route('jenis.index') }}" class="btn btn-sm btn-outline-light me-1">Jenis</a>
            <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-light me-1">Barang</a>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-sm btn-outline-light me-1">Pelanggan</a>
            <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-light me-3">Transaksi</a>

            @auth
                <span class="text-white me-2">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button class="btn btn-sm btn-danger">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
    
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>