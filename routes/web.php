<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\KategoriSoalController;
use App\Http\Controllers\User\UserSoalController;

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['role:admin']], function() {
    Route::get('/admin', [RoleController::class, 'admin'])->name('admin.dashboard');

    // Kategori Soal
    Route::prefix('kategori-soal')->group(function () {
        Route::get('/', [KategoriSoalController::class, 'index'])->name('index.kategori');
        Route::get('/create', [KategoriSoalController::class, 'create'])->name('create.kategori');
        Route::post('/store', [KategoriSoalController::class, 'store'])->name('store.kategori');
        Route::get('/edit/{id}', [KategoriSoalController::class, 'edit'])->name('edit.kategori');
        Route::put('/update/{id}', [KategoriSoalController::class, 'update'])->name('update.kategori');
        Route::delete('/{id}', [KategoriSoalController::class, 'delete'])->name('delete.kategori');
    });

    // Soal
    Route::prefix('soal')->group(function () {
        Route::get('/', [SoalController::class, 'index'])->name('index.soal');
        Route::get('/create', [SoalController::class, 'create'])->name('create.soal');
        Route::post('/store', [SoalController::class, 'store'])->name('store.soal');
        Route::get('/{id}/edit', [SoalController::class, 'edit'])->name('edit.soal');
        Route::post('/{id}/update', [SoalController::class, 'update'])->name('update.soal');
        Route::delete('/{id}', [SoalController::class, 'delete'])->name('delete.soal');
        // Upload Soal
        Route::get('/upload', [SoalController::class, 'upload'])->name('upload');
        Route::post('/upload', [SoalController::class, 'uploadFile'])->name('upload-soal');
    });

    // Peserta Ujian
    Route::prefix('peserta-ujian')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('peserta');
        Route::get('/create', [UserController::class, 'create'])->name('create.peserta');
        Route::post('/store', [UserController::class, 'store'])->name('store.peserta');
        Route::post('/', [UserController::class, 'sendNotif'])->name('send-notif');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit.peserta');
        Route::post('/{id}/update',[UserController::class, 'update'])->name('update.peserta');
    });

    // Hasil Ujian
    Route::prefix('hasil-ujian')->group(function () {
        Route::get('/', [UserController::class, 'hasilUjian'])->name('hasil');
    });

    // Pengaturan
    Route::prefix('pengaturan-ujian')->group(function () {
        Route::get('/', [PengaturanController::class, 'index'])->name('setting-index');
        Route::get('/create', [PengaturanController::class, 'create'])->name('setting-create');
        Route::post('/store', [PengaturanController::class, 'store'])->name('setting-store');
    });
});

Route::group(['middleware' => ['role:peserta']], function() {
    Route::get('/peserta', [RoleController::class, 'peserta'])->name('peserta.dashboard');

    // Soal
    Route::get('/soal-ujian',[UserSoalController::class, 'index'])->name('soal-ujian');
    Route::post('/simpan-jawaban',[UserSoalController::class, 'simpanJawaban'])->name('simpan-jawaban');
    Route::get('/finish-ujian',[UserSoalController::class, 'finish'])->name('finish-ujian');
});
