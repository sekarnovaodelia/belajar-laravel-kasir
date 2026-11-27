<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kasir App</title>
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
            <div class="col-12 col-sm-9 col-md-6 col-lg-4">
                <div class="card auth-card">
                    <div class="card-body p-4 p-sm-5">
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-3 mb-3" style="width: 44px; height: 44px;">
                                <i class="bi bi-shop fs-5"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Masuk ke Kasir App</h5>
                            <p class="text-muted small mb-0">Masukkan email dan password Anda.</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success py-2 small border-0">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger py-2 small border-0">{{ $errors->first() }}</div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-dark">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold small text-dark">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="loginPassword" class="form-control" placeholder="Masukkan password" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('loginPassword', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                Masuk
                            </button>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top">
                            <span class="text-muted small">Belum punya akun?</span>
                            <a href="{{ route('register') }}" class="small fw-semibold text-decoration-none ms-1">Daftar Sekarang</a>
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