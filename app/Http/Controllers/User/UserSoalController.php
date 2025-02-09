<?php

namespace App\Http\Controllers\User;

use App\Models\Soal;
use App\Models\Jawaban;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\soalAcak;
use Illuminate\Support\Facades\Auth;

class UserSoalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jumlahSoal = Pengaturan::first()->jumlah_soal;

        // Ambil soal acak dari tabel soal_acaks
        $soalAcaks = soalAcak::where('user_id', $user->id)->orderBy('index_soal')->take($jumlahSoal)->get();

        // Jika tidak ada soal acak, ambil dari database dan simpan ke soal_acaks
        if ($soalAcaks->isEmpty()) {
            // Ambil soal dari database
            $soals = Soal::with('kategori')->inRandomOrder()->take($jumlahSoal)->get();

            // Simpan index soal ke tabel soal_acaks
            foreach ($soals as $index => $soal) {
                soalAcak::create([
                    'user_id' => $user->id,
                    'soal_id' => $soal->id,
                    'index_soal' => $index,
                ]);
            }

            // Ambil kembali soal yang baru disimpan
            $soalAcaks = soalAcak::where('user_id', $user->id)->orderBy('index_soal')->take($jumlahSoal)->get();
        }

        // Ambil ID soal dari soal_acaks
        $soalIds = $soalAcaks->pluck('soal_id')->toArray();

        // Ambil soal berdasarkan ID yang diambil dari soal_acaks
        $soals = Soal::with('kategori')->whereIn('id', $soalIds)->get();

        // Urutkan soal berdasarkan urutan di soal_acaks
        $soals = $soals
            ->sortBy(function ($soal) use ($soalIds) {
                return array_search($soal->id, $soalIds);
            })
            ->values(); // Tambahkan ->values() untuk mengatur ulang indeks

        // Ambil jawaban yang sudah disimpan oleh user
        $jawabanUser = Jawaban::where('user_id', $user->id)->get();

        // Acak pilihan jawaban untuk setiap soal
        $soals = $soals->map(function ($soal) use ($jawabanUser) {
            // Hitung jumlah pilihan yang ada (pilihan_a sampai pilihan_e)
            $soal->length_pilihan = 0;
            $choices = [];

            // Menambahkan pilihan yang ada ke dalam array
            if ($soal->pilihan_a) {
                $choices[] = ['key' => 'a', 'value' => $soal->pilihan_a];
                $soal->length_pilihan++;
            }
            if ($soal->pilihan_b) {
                $choices[] = ['key' => 'b', 'value' => $soal->pilihan_b];
                $soal->length_pilihan++;
            }
            if ($soal->pilihan_c) {
                $choices[] = ['key' => 'c', 'value' => $soal->pilihan_c];
                $soal->length_pilihan++;
            }
            if ($soal->pilihan_d) {
                $choices[] = ['key' => 'd', 'value' => $soal->pilihan_d];
                $soal->length_pilihan++;
            }
            if ($soal->pilihan_e) {
                $choices[] = ['key' => 'e', 'value' => $soal->pilihan_e];
                $soal->length_pilihan++;
            }

            // Acak pilihan
            shuffle($choices);

            // Cek jawaban user untuk soal ini
            $jawaban = $jawabanUser->where('soal_id', $soal->id)->first();
            $soal->jawaban_user = $jawaban ? $jawaban->jawaban : null;

            // Menyimpan pilihan yang diacak kembali ke soal
            $soal->pilihan_acak = $choices;

            return $soal;
        });

        return view('user.userSoal', [
            'user' => $user,
            'soals' => $soals,
            'title' => 'CAT - Simulasi Ujian Kenaikan Pangkat',
        ]);
    }

    public function finish()
    {
        $user = Auth::user();
        Log::info('Menghitung skor untuk user_id: ' . $user->id);

        // Hitung skor
        $jawabanUser = Jawaban::where('user_id', $user->id)->get();
        Log::info('Jawaban user: ', $jawabanUser ->toArray());
        $soalIds = $jawabanUser->pluck('soal_acak_id')->toArray();
        $soals = soalAcak::with('soal')->whereIn('id', $soalIds)->where('user_id', $user->id)->get();

        $skor = 0;
        $totalSoal = $soals->count();

        foreach($soals as $soalAcak) {
            $soal = $soalAcak->soal;
            $jawaban = $jawabanUser->where('soal_acak_id', $soalAcak->id)->first();

            Log::info('ID soal acak: ' . $soalAcak->soal_id);
            Log::info('ID soal: ' . $soal->id);
            if ($jawaban && $jawaban->jawaban == $soal->jawaban_benar) {
                $skor++;
            }
        }
        Log::info('Skor untuk user_id ' . $user->id . ': ' . $skor);

        // Hapus session
        // session()->forget('soal');
        return view('user.liveScore', [
            'user' => $user,
            'skor' => $skor,
            'totalSoal' => $totalSoal,
            'title' => 'CAT - Simulasi Ujian Kenaikan Pangkat',
        ]);
    }

    // Simpan Jawaban Secara Real-Time
    public function simpanJawaban(Request $request)
    {
        $pengaturanId = Pengaturan::first()->id;
        foreach ($request->all() as $jawaban) {
            $soalAcak = soalAcak::where('index_soal', $jawaban['index_soal'])->where('user_id', $jawaban['user_id'])->first();

            if ($soalAcak) {
                $soalAcakId = $soalAcak->id;
                // Mengambil soal terkait dengan jawaban benar
                $soal = Soal::find($soalAcak->soal_id);

                // Tentukan jawaban benar dan salah
                $benar = ($jawaban['jawaban'] == $soal->jawaban_benar) ? 1 : 0;
                // Simpan ke database
                Jawaban::updateOrCreate(['user_id' => $jawaban['user_id'], 'soal_acak_id' => $soalAcakId], ['jawaban' => $jawaban['jawaban'], 'pengaturan_id' => $pengaturanId, 'benar' => $benar]);
            }
        }

        return response()->json(['message' => 'Jawaban berhasil disimpan']);
    }
}
