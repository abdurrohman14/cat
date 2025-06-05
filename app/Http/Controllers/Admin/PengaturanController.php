<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Pengaturan;
use App\Models\KategoriSoal;
use Illuminate\Http\Request;
use App\Models\PengaturanDetail;
use App\Events\JadwalUjianDibuat;
use App\Http\Controllers\Controller;

class PengaturanController extends Controller
{
    public function index()
    {
        $setting = Pengaturan::all();
        $kategori = KategoriSoal::all();
        return view('partials.admin.setting.index', [
            'title' => 'Pengaturan',
            'setting' => $setting,
            'kategori' => $kategori,
        ]);
    }

    public function create()
    {
        $kategori = KategoriSoal::all();
        return view('partials.admin.setting.create', [
            'title' => 'Pengaturan',
            'kategori' => $kategori,
        ]);
    }

    public function store(Request $request)
    {
        try {
            // cek apakah ada kategori soal yang sudah ada
            if (KategoriSoal::count() == 0) {
                return redirect()->back()->with('error', 'Tidak bisa membuat pengaturan. Kategori soal belum tersedia.');
            }
            $request->validate([
                // 'durasi' => 'required|integer',
                'kategori_soal_id' => 'required|array',
                'kategori_soal_id.*' => 'required|integer|exists:kategori_soals,id',

                'jumlah_soal' => 'required|array',
                'jumlah_soal.*' => 'required|integer|min:1',
            ]);

            $totalDurasi = 0;

            foreach ($request->jumlah_soal as $jumlah) {
                $totalDurasi += $jumlah; // Atau bisa pakai collect()->sum()
            }

            // Simpan ke tabel pengaturans
            $setting = Pengaturan::create([
                'durasi' => $totalDurasi
            ]);

            // Simpan detail per kategori soal
            foreach ($request->kategori_soal_id as $index => $kategoriSoalId) {
                PengaturanDetail::create([
                    'pengaturan_id' => $setting->id,
                    'kategori_soal_id' => $kategoriSoalId,
                    'jumlah_soal' => $request->jumlah_soal[$index],
                ]);
            }
            event(new JadwalUjianDibuat($setting));

            return redirect()->route('setting-index')->with('success', 'Pengaturan berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // public function edit($id) {
    //     $setting = Pengaturan::find($id);
    //     return view('partials.admin.setting.edit', [
    //         'title' => 'Pengaturan',
    //         'setting' => $setting
    //     ]);
    // }

    // public function update(Request $request, $id) {
    //     try {
    //         // Validasi input
    //         $request->validate([
    //             'durasi' => 'required|integer',
    //             'jumlah_soal' => 'required|integer',
    //         ]);

    //         // Ambil pengaturan berdasarkan ID
    //         $setting = Pengaturan::findOrFail($id);

    //         $data = $request->only(['durasi', 'jumlah_soal']);

    //         // Perbarui pengaturan
    //         $setting->update($data);

    //         return redirect()->route('setting-index')->with('success', 'Pengaturan berhasil diperbarui');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }
}
