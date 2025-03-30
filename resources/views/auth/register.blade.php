<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 100vh;
        }

        .logo {
            margin-bottom: 10px;
            text-align: center;
        }

        .logo img {
            width: 80px;
        }

        .login {
            color: #fdb407;
            font-size: 1rem;
        }

        .login-subtitle-card {
            color: #002855;
            font-weight: 400;
        }

        .login-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #fdb407;
            text-align: center;
        }

        .login-subtitle {
            font-size: 1rem;
            color: #002855;
            margin-bottom: 10px;
            text-align: center;
            font-weight: 500;
        }

        .btn-login {
            background-color: #fdb407;
            border: none;
            color: #002855;
            font-weight: 500;
        }

        .btn-login:hover {
            background-color: #e0a800;
        }

        .card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .input-group-text i {
            color: #aaa;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="{{ asset('assets/dist/img/logo-polresta.png') }}" alt="Logo Polresta" />
    </div>
    <h2 class="login-title">Computer Assisted Test</h2>
    <p class="login-subtitle">
        Simulasi Ujian Kenaikan Pangkat <br />
        Polresta Banyuwangi
    </p>
    <div class="card mb-4">
        <div class="title mb-3">
            <h4 class="login fw-bold">REGISTER</h4>
            <p class="login-subtitle-card">Silahkan isi form registrasi dibawah ini!</p>
        </div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama lengkap"
                        required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-card-list"></i>
                    </span>
                    <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                        required />
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                    <input type="text" class="form-control" id="nomor_wa" name="nomor_wa" placeholder="Nomor WA"
                        required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                        placeholder="Tempat Lahir" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>            
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-house"></i></span>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                        required>
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required />
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Konfirmasi Password" required />
                </div>
            </div>
            <button type="submit" class="btn btn-login w-100 mt-3">Register</button>
        </form>
        <div class="already-account mt-2"><span>Sudah memiliki akun?</span><a href="{{ route('login') }}" class="text-decoration-none"> Login</a></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Register Gagal',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</body>

</html>
