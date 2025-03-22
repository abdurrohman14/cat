<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #ffb200;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #002855;
            font-weight: 600;
        }

        .navbar-brand:hover {
            color: #001f40;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .question-number button {
            margin: 5px;
            width: 40px;
            height: 40px;
            font-weight: 500;
            font-size: 14px;
            padding: 4px;
        }

        .question-number .btn-success {
            background-color: #6bc74a;
            /* Hijau */
            color: #fff;
            /* Teks putih */
            border: 1px solid #fff;
            /* Border putih */
        }

        .button-finish .btn {
            width: 100%;
            font-weight: 400;
            margin-top: 20px;
            background-color: #6bc74a;
            color: white;
        }

        h5,
        h6 {
            font-weight: 600;
        }

        .timer {
            color: #ff4b4b;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('assets/dist/img/logo-polresta.png') }}" alt="Logo" width="40" height="50"
                    class="me-2" />
                <div style="line-height: 1">
                    <span style="font-weight: 600; color: #002855">Computer Assisted Test</span><br />
                    <span style="font-size: 14px; color: #fff">Polresta Banyuwangi</span>
                </div>
            </a>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        {{-- <h3>Silakan klik tombol di bawah ini untuk masuk ke mode fullscreen.</h3>
        <button id="fullscreen-btn" class="btn btn-warning">Masuk Fullscreen</button> --}}
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <!-- Judul Test -->
                    <h5 class="mb-0">Simulasi Ujian Kenaikan Pangkat</h5>
                    <!-- Nama Test -->
                    <p class="text-center fw-bold mb-0">Test</p>
                    <!-- Sisa Waktu -->
                    <p class="timer-exam fw-bold mb-0 text-end">Sisa Waktu :</p>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Nama Peserta -->
                    <p class="mb-0">Nama : {{ $user->name }}</p>
                    <!-- Jenis Test -->
                    @if ($soals->isNotEmpty())
                        <p class="text-center mb-0" id="kategori-soal">{{ $soals->first()->kategori->nama }}</p>
                    @endif
                    <!-- Sisa Waktu -->
                    <p class="timer mb-0 text-end">00:00:00</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Left Section -->
            <div class="col-md-8">
                <div id="soal-container">
                    @foreach ($soals as $index => $soal)
                        <form action="{{ route('simpan-jawaban') }}" method="POST" class="d-inline">
                            <div class="card soal-card" id="soal{{ $index + 1 }}"
                                style="{{ $index === 0 ? '' : 'display: none;' }}">
                                <div class="card-body">
                                    <h6>Soal {{ $index + 1 }}</h6>
                                    <p>{!! $soal->soal !!}</p>
                                    <div class="mt-3">
                                        @foreach ($soal->pilihan_acak as $choice)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="answer{{ $index }}"
                                                    id="answer{{ $index }}{{ $choice['key'] }}"
                                                    value="{{ $choice['value'] }}"
                                                    @if ($soal->jawaban_user === $choice['key']) checked @endif />
                                                <label class="form-check-label"
                                                    for="answer{{ $index }}{{ $choice['key'] }}">
                                                    {{ $choice['value'] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <button class="btn btn-secondary" id="prev-btn" disabled>Sebelumnya</button>
                    <button class="btn btn-primary" id="next-btn" onclick="simpanDanLanjutkan()">Simpan &
                        Lanjutkan</button>
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div id="toggle-btn" class="toggle-btn">
                            <i id="icon-toggle" class="fas fa-bars"></i>
                            <!-- Initial icon: burger menu -->
                        </div>
                        <div id="right-content" class="question-number">
                            @foreach ($soals as $index => $soal)
                                <button class="btn btn-outline-danger"
                                    data-index="{{ $index }}">{{ $index + 1 }}</button>
                            @endforeach
                        </div>
                        <div class="button-finish">
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#selesaiUjian">Akhiri
                                Ujian</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="selesaiUjian" tabindex="-1" aria-labelledby="selesaiUjianModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selesaiUjianModal">Perhatian !!!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin mengakhiri simulasi ujian ini?
                    Jika "Ya" maka Anda sudah dinyatakan selesai mengikuti simulasi ujian, dan Anda tidak bisa
                    memperbaiki lembar kerja Anda. Jika "Tidak" maka anda akan kembali ke lembar kerja dan silahkan
                    untuk melanjutkan menjawab atau memperbaiki jawaban anda.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-primary" id="selesaiUjian" onclick="selesaiUjian()">Ya</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let selesaiUjian = false;
            // Fungsi untuk mengunci layar
            function lockScreen() {
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) {
                    document.documentElement.msRequestFullscreen();
                }
            }

            // Mencegah keluar dari fullscreen
            document.addEventListener("fullscreenchange", function() {
                if (!document.fullscreenElement) {
                    alert("Anda keluar dari mode fullscreen! Ujian dihentikan.");
                    window.location.href =
                        "{{ route('finish-ujian') }}"; // Redirect ke halaman finish ujian
                }
            });

            // Cegah tombol keluar
            document.addEventListener("keydown", function(e) {
                if (e.key === "Escape" || e.key === "F11" ||
                    (e.ctrlKey && e.key === "w") ||
                    (e.ctrlKey && e.shiftKey && e.key === "T") ||
                    (e.altKey && e.key === "Tab")) {
                    e.preventDefault();
                }
            });

            document.getElementById("selesaiUjian").addEventListener("click", function() {
                let selesaiUjian = true;
            });

            // Cegah perubahan tab
            document.addEventListener("visibilitychange", function() {
                if (document.hidden && !selesaiUjian) {
                    const userConfirm = confirm("Anda berpindah tab! Ujian dihentikan.");
                    if (userConfirm) {
                        window.location.href = "{{ route('finish-ujian') }}";
                    } else {
                        window.location.href =
                        "{{ route('soal-ujian') }}"; // Redirect ke halaman finish ujian
                    }
                }
            });

            // Cegah klik kanan & inspect element
            document.addEventListener("contextmenu", function(e) {
                e.preventDefault();
            });

            document.addEventListener("keydown", function(e) {
                if (e.key === "F12" || (e.ctrlKey && e.shiftKey && e.key === "I")) {
                    e.preventDefault();
                }
            });

            // Tombol mulai fullscreen saat ujian dimulai
            // document.getElementById("fullscreen-btn").addEventListener("click", function() {
            //     lockScreen();
            // });
            document.addEventListener("dblclick", function() {
                lockScreen();
            });

            const soalCards = document.querySelectorAll(".soal-card");
            const buttons = document.querySelectorAll('.question-number button');
            let currentSoal = 0;
            const prevBtn = document.getElementById("prev-btn");
            const nextBtn = document.getElementById("next-btn");

            // Fungsi untuk memperbarui tampilan soal
            function updateSoal() {
                soalCards.forEach((card, index) => {
                    card.style.display = index === currentSoal ? "" : "none";

                    // Tetapkan visibilitas untuk pilihan berdasarkna jumlah pilihan
                    const choices = card.querySelectorAll('.form-check');
                    const soal = @json($soals); // Ambil data soal dalam format JSON
                    const currentSoalData = soal[currentSoal];

                    choices.forEach((choice, idx) => {
                        if (idx >= currentSoalData.length_pilihan) {
                            choice.style.display =
                                "none"; // Menyembunyikan pilihan jika melebihi jumlah opsi yang tersedia
                        } else {
                            choice.style.display = ""; // Menunjukkan pilihannya
                        }
                    });
                });

                // Update kategori soal
                const kategoriSoalElement = document.getElementById("kategori-soal");
                const currentSoalData =
                    @json($soals); // Ambil data soal dalam format JSON
                kategoriSoalElement.textContent = currentSoalData[currentSoal].kategori
                    .nama; // Update kategori

                prevBtn.disabled = currentSoal === 0;
                nextBtn.disabled = false;
            }

            // Button Selanjutnya (next question)
            nextBtn.addEventListener("click", function() {
                simpanJawaban();
                if (currentSoal < soalCards.length - 1) {
                    currentSoal++;
                    updateSoal();
                } else {
                    $('#selesaiUjian').modal('show');
                }
            });

            // Button sebelumnya (previous question)
            prevBtn.addEventListener("click", function() {
                if (currentSoal > 0) {
                    currentSoal--;
                    updateSoal();
                }
            });

            // Button soal (click on question number)
            buttons.forEach((button) => {
                button.addEventListener('click', () => {
                    currentSoal = parseInt(button.getAttribute('data-index'));
                    updateSoal();

                    // Tambahkan kelas aktif ke tombol saat ini
                    buttons.forEach((btn) => btn.classList.remove('btn-success'));
                    button.classList.add('btn-success');
                });
            });

            // Tambahkan pendengar acara ke setiap masukan radio untuk menandai pertanyaan telah terjawab
            const radioButtons = document.querySelectorAll('.form-check-input');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    const questionIndex = parseInt(this.name.replace('answer', ''), 10);
                    buttons[questionIndex].classList.add(
                        'btn-success'); // Tandai tombol sebagai hijau
                });
            });

            // Inisialisasi dengan pertanyaan pertama yang ditampilkan
            updateSoal();
        });

        // Simpan dan Lanjutkan
        function simpanDanLanjutkan() {
            // Simpan jawaban terlebih dahulu
            simpanJawaban();

            // Then go to the next question
            // const nextBtn = document.getElementById("next-btn");
            // nextBtn.click();
        }

        // Simpan Jawaban
        function simpanJawaban() {
            const jawaban = [];
            document.querySelectorAll('.form-check-input:checked').forEach(input => {
                const soalAcakId = input.closest('.soal-card').id.replace('soal', '');
                const indexSoal = Array.from(document.querySelectorAll('.soal-card')).indexOf(input.closest(
                    '.soal-card')); // Ambil index soal
                jawaban.push({
                    user_id: {{ Auth::id() }},
                    index_soal: indexSoal,
                    jawaban: input.value
                });
            });

            fetch('/simpan-jawaban', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(jawaban)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                })
                .catch(error => console.error('Error:', error));
        }
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil durasi dari backend (dalam menit)
            let waktuUjian = {{ $durasi }}; // Misalnya, 60 menit
            let totalDetik = waktuUjian * 60; // Konversi ke detik

            // Fungsi untuk memperbarui timer
            function updateTimer() {
                const jam = Math.floor(totalDetik / 3600);
                const menit = Math.floor((totalDetik % 3600) / 60);
                const detik = totalDetik % 60;

                // Tampilkan waktu di elemen dengan class "timer"
                document.querySelector('.timer').textContent =
                    `${String(jam).padStart(2, '0')}:${String(menit).padStart(2, '0')}:${String(detik).padStart(2, '0')}`;

                // Kurangi totalDetik setiap detik
                if (totalDetik > 0) {
                    totalDetik--;
                } else {
                    // Jika waktu habis, lakukan sesuatu (misalnya, redirect)
                    alert("Waktu habis! Ujian dihentikan.");
                    window.location.href = "{{ route('finish-ujian') }}"; // Redirect ke halaman finish ujian
                }
            }

            // Panggil updateTimer setiap detik
            setInterval(updateTimer, 1000);
        });
    </script>
    <script>
        function selesaiUjian() {
            simpanJawaban();
            window.location.href = '/finish-ujian';
        }
    </script>
</body>

</html>
