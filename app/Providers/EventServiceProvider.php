<?php

namespace App\Providers;

use App\Events\JadwalUjianDibuat;
use App\Listeners\KirimNotifkasiJadwal;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        JadwalUjianDibuat::class => [
            KirimNotifkasiJadwal::class,
        ],
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
