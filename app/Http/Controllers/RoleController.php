<?php

namespace App\Http\Controllers;

use App\Models\pelaksanaanUjian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function admin() {
        $totalPeserta = User::where('role', '!=', 'admin')->count();
        $lulus = pelaksanaanUjian::where('status', 'lulus')->count();
        $tidakLulus = pelaksanaanUjian::where('status', 'tidak lulus')->count();
        $belumUjian = User::where('role', '!=', 'admin')->whereDoesntHave('pelaksanaanUjian')->count();
        return view('partials.adminDashboard', [
            'title' => 'Admin Dashboard',
            'totalPeserta' => $totalPeserta,
            'lulus' => $lulus,
            'tidakLulus' => $tidakLulus,
            'belumUjian' => $belumUjian
        ]);
    }

    public function peserta() {
        $user = Auth::user();
        return view('partials.pesertaDashboard', compact([
            'user',
        ]));
    }
}
