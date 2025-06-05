<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login', ['title'=>'Login - CAT Polresta Banyuwangi']);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();

            $request->session()->regenerate();

            // cek email terverifikasi kecuali admin
            if (Auth::user()->email_verified_at == null && Auth::user()->role != 'admin') {
                return redirect()->route('login')->with('error', 'Email Anda Belum Diverifikasi!')->withInput();
            }

            $role = Auth::user()->role;

            if ($role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role == 'peserta') {
                return redirect()->route('peserta.dashboard');
            } else {
                return redirect()->route('login');
            }
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', 'Email atau Pasword Salah!')->withInput();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
