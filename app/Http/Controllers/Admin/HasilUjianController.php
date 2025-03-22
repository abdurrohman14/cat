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

    // public function edit($id) {
    //     $hasilUjian = pelaksanaanUjian::find($id);
    //     $user = User::all();
    //     return view('partials.admin.hasilUjian.edit', [
    //         'title' => 'Edit Hasil Ujian',
    //         'hasilUjian' => $hasilUjian,
    //         'user' => $user
    //         ]);
    // }

    // public function update(Request $request, $id) {
    //     try {
    //         $request->validate([
    //             'skor' => 'required|numeric|min:0|max:100',
    //         ]);
    //         $hasilUjian = pelaksanaanUjian::find($id);

    //         $status = $request->skor >= 61 ? 'Lulus' : 'Tidak Lulus';

    //         $hasilUjian->update([
    //             'skor' => $request->skor,
    //             'status' => $status,
    //         ]);

    //         return redirect()->route('hasil')->with('success', 'Data berhasil
    //         diupdate');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', $th->getMessage());
    //     }
    // }
}
