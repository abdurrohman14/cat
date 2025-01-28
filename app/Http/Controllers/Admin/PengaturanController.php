<?php

namespace App\Http\Controllers\Admin;

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
            Pengaturan::create($data);
        }

        return redirect()->route('setting-index')->with('success', 'Pengaturan berhasil disimpan');
    }
}
