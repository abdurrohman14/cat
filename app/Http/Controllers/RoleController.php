<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function admin() {
        $totalPeserta = User::where('role', '!=', 'admin')->count();
        return view('partials.adminDashboard', [
            'title' => 'Admin Dashboard',
            'totalPeserta' => $totalPeserta,
        ]);
    }

    public function peserta() {
        $user = Auth::user();
        return view('partials.pesertaDashboard', compact([
            'user',
        ]));
    }
}
