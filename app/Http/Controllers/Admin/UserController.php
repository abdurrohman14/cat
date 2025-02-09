<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Jawaban;
use Twilio\Rest\Client;
use App\Models\Pengaturan;
use App\Helpers\TokenHelper;
use Illuminate\Http\Request;
use App\Helpers\WhatsAppHelper;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role', '!=', 'admin')->get();
        return view('partials.admin.peserta.index', [
            'user' => $user,
            'title' => 'Peserta Ujian',
        ]);
    }

    public function create()
    {
        return view('partials.admin.peserta.create', [
            'title' => 'Tambah Peserta Ujian',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            // 'password' => 'required|string|min:8',
            'nomor_wa' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nrp' => 'required|integer',
        ]);

        $nomor_wa = $request->nomor_wa;
        if (substr($nomor_wa, 0, 1) === '0') {
            $nomor_wa = '+62' . substr($nomor_wa, 1);
        }

        // TokenUjian
        // $token = TokenHelper::generateToken();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->nrp),
            'nomor_wa' => $nomor_wa,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nrp' => $request->nrp,
        ]);

        return redirect()->route('peserta')->with('success', 'Peserta Ujian Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('partials.admin.peserta.edit', [
            'user' => $user,
            'title' => 'Edit Peserta Ujian',
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'nomor_wa' => 'required|string',
                'tempat_lahir' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string',
                'nrp' => 'required|integer',
            ]);
            $nomor_wa = $request->nomor_wa;
            if (substr($nomor_wa, 0, 1) === '0') {
                $nomor_wa = '+62' . substr($nomor_wa, 1);
            }
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'nomor_wa' => $nomor_wa,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'nrp' => $request->nrp,
            ]);
    
            return redirect()->route('peserta')->with('success', 'Peserta Ujian Berhasil Diupdate');
        } catch (\Throwable $e) {
            return redirect()->route('peserta')->with('error', 'Terjadi kesalahan' . $e->getMessage());
        }
    }

    public function sendNotif(Request $request)
    {
        // ambil data dari tabel pengaturan
        $pengaturan = Pengaturan::first();

        if (!$pengaturan) {
            return redirect()->route('peserta')->with('error', 'Pengaturan belum diatur');
        }

        $jadwalUjian = Carbon::parse($pengaturan->jadwal)->translatedFormat('l, d F Y');
        $waktuMulai = $pengaturan->waktu_mulai;
        $waktuSelesai = $pengaturan->waktu_selesai;

        $user = User::where('role', '!=', 'admin')->get();

        foreach ($user as $user) {
            $message = "Halo, {$user->name}. Berikut adalah informasi penting.\n\n" . "Username: {$user->email}\n" . "Password: {$user->nrp}\n\n" . "Jadwal Ujian: {$jadwalUjian}\n\n" . "Waktu: {$waktuMulai} - {$waktuSelesai}\n\n" . 'Selamat Mengerjakan. Good Luck!';
            WhatsAppHelper::sendWhatsAppMessage($user->nomor_wa, $message);
        }
        return redirect()->route('peserta')->with('success', 'Pesan Berhasil Dikirimkan');
    }

    // Hasil Ujian
    public function hasilUjian()
    {
        $hasilUjian = Jawaban::all();
        return view('partials.admin.jawaban.index', [
            'title' => 'Hasil Ujian',
            'hasilUjian' => $hasilUjian,
        ]);
    }
}
