<?php

namespace App\Http\Controllers\Admin;

use App\Events\JadwalUjianDibuat;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PengaturanController extends Controller
{
    public function index() {
        $setting = Pengaturan::all();
        return view('partials.admin.setting.index', [
            'title' => 'Pengaturan',
            'setting' => $setting
        ]);
    }

    public function create() {
        return view('partials.admin.setting.create',[
            'title' => 'Pengaturan'
        ]);
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'jadwal' => 'required|date',
                'waktu_mulai' => 'required|date_format:H:i',
                'waktu_selesai' => 'required|date_format:H:i',
                'jumlah_soal' => 'required|integer',
                // 'durasi' => 'required|integer',
            ]);
    
            $waktuMulai = Carbon::createFromFormat('H:i', $request->waktu_mulai);
            $waktuSelesai = Carbon::createFromFormat('H:i', $request->waktu_selesai);
    
            // dalam format menit
            $durasi = $waktuMulai->diffInMinutes($waktuSelesai);
    
            $data = $request->all();
            $data['durasi'] = $durasi;
    
            $setting = Pengaturan::first();
            if($setting) {
                $setting->update($data);
            } else {
                $setting = Pengaturan::create($data);
            }
            
            event(new JadwalUjianDibuat($setting));
            return redirect()->route('setting-index')->with('success', 'Pengaturan berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id) {
        $setting = Pengaturan::find($id);
        return view('partials.admin.setting.edit', [
            'title' => 'Pengaturan',
            'setting' => $setting
        ]);
    }

    public function update(Request $request, $id) {
        try {
            // Validasi input
            $request->validate([
                'jadwal' => 'required|date',
                'waktu_mulai' => 'required|date_format:H:i',
                'waktu_selesai' => 'required|date_format:H:i',
                'jumlah_soal' => 'required|integer',
                // 'durasi' => 'required|integer', // durasi tidak perlu divalidasi karena akan dihitung
            ]);
    
            // Ambil pengaturan berdasarkan ID
            $setting = Pengaturan::findOrFail($id);
    
            // Menghitung durasi
            $waktuMulai = Carbon::createFromFormat('H:i', $request->waktu_mulai);
            $waktuSelesai = Carbon::createFromFormat('H:i', $request->waktu_selesai);
            $durasi = $waktuMulai->diffInMinutes($waktuSelesai);
    
            // Siapkan data untuk diperbarui
            $data = $request->all();
            $data['durasi'] = $durasi;
    
            // Perbarui pengaturan
            $setting->update($data);
    
            return redirect()->route('setting-index')->with('success', 'Pengaturan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
