@php
use Illuminate\Support\Str;
$nomor_wa = Str::replaceFirst('+62', '0', $user->nomor_wa);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Biodata Ujian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 100vh;
            padding: 20px 0;
        }

        .info-item {
            display: grid;
            grid-template-columns: 300px 10px auto;
            /* Label, titik dua, dan nilai */
            gap: 10px;
            margin-bottom: 10px;
        }

        .info-item .label {
            font-weight: bold;
            /* width: 250px; */
        }

        .logo {
            margin-bottom: 20px;
            text-align: center;
        }

        .logo img {
            width: 80px;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fdb407;
            text-align: center;
        }

        .login-subtitle {
            font-size: 1rem;
            color: #002855;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 500;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
        }

        .card-header {
            border: none;
            color: #002855;
        }

        .alert {
            background-color: #fcefc5;
            /* opacity: 0.4; */
            padding: 10px;
            border-radius: 5px;
        }

        .alert p {
            color: #002855;
            margin: 0;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="{{ asset('assets/dist/img/logo-polresta.png') }}" alt="Logo Polresta Banyuwangi" />
    </div>
    <h2 class="login-title">Computer Assisted Test</h2>
    <p class="login-subtitle">
        Simulasi Ujian Kenaikan Pangkat <br />
        Polresta Banyuwangi
    </p>

    <div class="container mt-2">
        <div class="card mb-3">
            <div class="card-header bg-warning text-center fw-bold">Periksa Biodata Anda</div>
            <div class="card-body">
                <div class="alert text-center">
                    <p>Periksa kembali biodata Anda. Jika sudah benar, klik Mulai Ujian. Jika salah, klik Batal Ujian.
                    </p>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-7">
                        <div class="info-item">
                            <div class="label">Nama</div>
                            <div>:</div>
                            <div>{{ $user->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Tempat & Tanggal Lahir</div>
                            <div>:</div>
                            <div>{{ $user->tempat_lahir }},
                                {{ Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Email</div>
                            <div>:</div>
                            <div>{{ $user->email }}</div>
                        </div>
                        <div class="info-item">
                            <div class="label">No. Telpon</div>
                            <div>:</div>
                            <div>{{ $nomor_wa }}</div>
                        </div>
                        <div class="info-item">
                            <div class="label">Alamat</div>
                            <div>:</div>
                            <div>{{ $user->alamat }}</div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around gap-3 mt-3">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mulaiUjian">Mulai
                        Ujian</button>
                    <button class="btn btn-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Batal
                        Ujian</button>
                </div>
                <!-- logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="mulaiUjian" tabindex="-1" aria-labelledby="mulaiUjianModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mulaiUjianModal">Konfirmasi Ujian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda sudah siap melakukan ujian?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Belum</button>
                    <button type="button" class="btn btn-primary" onclick="mulaiUjian()">Siap</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function mulaiUjian() {
        window.location.href = '/soal-ujian';
      }
    </script>
  </body>

</html>
