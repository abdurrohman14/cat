<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\pelaksanaanUjian;
use App\Http\Controllers\Controller;

class HasilUjianController extends Controller
{
    public function index() {
        $hasilUjian = pelaksanaanUjian::all();
        $user = User::all();

        return view('partials.admin.hasilUjian.index', [
            'title' => 'Hasil Ujian',
            'hasilUjian' => $hasilUjian,
            'user' => $user
        ]);
    }
}
