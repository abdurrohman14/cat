<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', ['title' => 'Daftar - CAT Polresta Banyuwangi']);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $nomor_wa = $request->nomor_wa;
            if (substr($nomor_wa, 0, 1) === '0') {
                $nomor_wa = '+62' . substr($nomor_wa, 1);
            }

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'nomor_wa' => ['required', 'string', 'max:15', 'unique:' . User::class],
                'tempat_lahir' => ['required', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'alamat' => ['required', 'string', 'max:255'],
                'nrp' => ['required', 'string', 'max:20'],
                'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            ],
            [
                'email.unique' => 'Email sudah terdaftar.',
                'nomor_wa.unique' => 'Nomor WhatsApp sudah terdaftar.',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nomor_wa' => $nomor_wa,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'nrp' => $request->nrp,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            // event(new Registered($user));

            // Auth::login($user);

            // return redirect(route('login', absolute: false));
            return redirect()->route('login')->with('success', 'Registrasi Berhasil');
        } catch (\Throwable $e) {
            return redirect()->route('register')->with('error', $e->getMessage());
        }
    }
}
