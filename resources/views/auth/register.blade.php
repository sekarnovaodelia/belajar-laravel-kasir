<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kasir App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .auth-card {
            background-color: #ffffff;
            border: none;
            border-radius: 0.85rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.45);
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5">
                <div class="card auth-card">
                    <div class="card-body p-4 p-sm-5">
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-3 mb-3" style="width: 44px; height: 44px;">
                                <i class="bi bi-person-plus fs-5"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Buat Akun Baru</h5>
                            <p class="text-muted small mb-0">Daftarkan akun untuk mulai mengelola kasir.</p>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger py-2 small border-0">
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-dark">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-dark">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                    <label class="form-label fw-semibold small text-dark">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="regPassword" class="form-control" placeholder="Min. 8 karakter" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePass('regPassword', this)">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                            </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-dark">Konfirmasi</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="regPasswordConfirm" class="form-control" placeholder="Ulangi password" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePass('regPasswordConfirm', this)">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                Daftar Akun
                            </button>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top">
                            <span class="text-muted small">Sudah punya akun?</span>
                            <a href="{{ route('login') }}" class="small fw-semibold text-decoration-none ms-1">Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePass(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>
</html>