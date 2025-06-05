<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
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
            <div class="card-header bg-warning text-center fw-bold">Anda telah selesai ujian</div>
            <div class="card-body">
                <div class="alert text-center">
                    <p>Hasil Ujian</p>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-7">
                        <div class="row mb-2">
                            <div class="col-5 col-md-4 fw-bold">Tanggal Ujian</div>
                            <div class="col-1">:</div>
                            <div class="col-6 col-md-7">{{ $pelaksanaanUjian->formatted_created_at }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 col-md-4 fw-bold">Nama</div>
                            <div class="col-1">:</div>
                            <div class="col-6 col-md-7">{{ $user->name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 col-md-4 fw-bold">Skor</div>
                            <div class="col-1">:</div>
                            <div class="col-6 col-md-7">{{ number_format($skor, 2) }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 col-md-4 fw-bold">Benar</div>
                            <div class="col-1">:</div>
                            <div class="col-6 col-md-7">{{ $totalBenar }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 col-md-4 fw-bold">Salah</div>
                            <div class="col-1">:</div>
                            <div class="col-6 col-md-7">{{ $totalSalah }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 col-md-4 fw-bold">Status</div>
                            <div class="col-1">:</div>
                            <div class="col-6 col-md-7 fw-bold {{ $skor >= 61 ? 'text-success' : 'text-danger' }}">
                                {{ $skor >= 61 ? 'Lulus' : 'Tidak Lulus' }}
                            </div>
                        </div>
                        @if ($skor >= 61)
                            <p class="text-success fw-bold text-center">Selamat anda telah lulus ujian!</p>
                        @else
                            <p class="text-danger fw-bold text-center">Maaf anda belum lulus ujian. Silahkan coba lagi
                            </p>
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button class="btn btn-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                </div>
                <!-- logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
                <div class="accordion mt-4" id="detailJawabanAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingDetailJawaban">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseDetailJawaban" aria-expanded="true"
                                aria-controls="collapseDetailJawaban">
                                Detail Jawaban
                            </button>
                        </h2>
                        <div id="collapseDetailJawaban" class="accordion-collapse collapse show"
                            aria-labelledby="headingDetailJawaban" data-bs-parent="#detailJawabanAccordion">
                            <div class="accordion-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pertanyaan</th>
                                            <th>Jawaban Anda</th>
                                            <th>Jawaban Benar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailJawaban as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item['pertanyaan'] }}</td>
                                                <td>{{ $item['jawaban_user'] }}</td>
                                                <td>{{ $item['jawaban_benar'] }}</td>
                                                <td
                                                    class="{{ $item['status'] == 'Benar' ? 'text-success' : 'text-danger' }}">
                                                    {{ $item['status'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
