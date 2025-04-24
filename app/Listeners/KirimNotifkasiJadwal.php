<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Carbon;
use App\Helpers\WhatsAppHelper;
use App\Events\JadwalUjianDibuat;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class KirimNotifkasiJadwal
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(JadwalUjianDibuat $event)
    {
        $pengaturan = $event->pengaturan;

        Carbon::setLocale('id');
        // $jadwalUjian = Carbon::parse($pengaturan->jadwal)->translatedFormat('l, d F Y');
        // $waktuMulai = $pengaturan->waktu_mulai;
        // $waktuSelesai = $pengaturan->waktu_selesai;

        $users = User::where('role', '!=', 'admin')->get();

        foreach ($users as $user) {
            $message = "Halo, {$user->name}. Silakan melakukan simulasi dengan menggunakan akun Anda.\n\n" .
                    //    "📝 *Jadwal Ujian*: {$jadwalUjian}\n" .
                    //    "⏰ *Waktu*: {$waktuMulai} - {$waktuSelesai}\n\n" .
                       "Gunakan *email* dan *password* yang telah didaftarkan untuk masuk ke sistem. Selamat belajar dan semoga sukses!";

            WhatsAppHelper::sendWhatsAppMessage($user->nomor_wa, $message);
        }
    }
}
