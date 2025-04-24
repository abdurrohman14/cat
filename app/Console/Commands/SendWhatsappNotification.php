<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Pengaturan;
use Illuminate\Support\Carbon;
use App\Helpers\WhatsAppHelper;
use Illuminate\Console\Command;

class SendWhatsappNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-whatsapp-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirimkan Notifikasi Ke Peserta Ujian';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Carbon::setLocale('id');
        // ambil data dari tabel pengaturan
        $pengaturan = Pengaturan::first();

        if (!$pengaturan) {
            return redirect()->route('peserta')->with('error', 'Pengaturan belum diatur');
        }

        // $jadwalUjian = Carbon::parse($pengaturan->jadwal)->translatedFormat('l, d F Y');
        // $waktuMulai = $pengaturan->waktu_mulai;
        // $waktuSelesai = $pengaturan->waktu_selesai;

        $user = User::where('role', '!=', 'admin')->get();

        foreach ($user as $user) {
            $message = "Halo, {$user->name}. Silakan melakukan simulasi dengan menggunakan akun Anda.\n\n" .
                        // "Username: {$user->email}\n" .
                        // "Password: {$user->password}\n\n" .
                        // "📝 *Jadwal Ujian*: {$jadwalUjian}\n\n" .
                        // "⏰ *Waktu*: {$waktuMulai} - {$waktuSelesai}\n\n" .
                        'Gunakan *email* dan *password* yang telah didaftarkan untuk masuk ke sistem. Selamat belajar dan semoga sukses!';
            WhatsAppHelper::sendWhatsAppMessage($user->nomor_wa, $message);
        }
        // return redirect()->route('peserta')->with('success', 'Pesan Berhasil Dikirimkan');
        $this->info('Pesan Berhasil Dikirim');
    }
}
