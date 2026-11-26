<div class="topbar">
    <h5 class="mb-0 fw-bold">
        @yield('title', 'Dashboard')
    </h5>
    <div class="d-flex align-items-center">
        <span class="me-3 text-muted">
            <i class="bi bi-person-circle fs-5 align-middle me-1"></i> 
            {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})
        </span>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button class="btn btn-sm btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>