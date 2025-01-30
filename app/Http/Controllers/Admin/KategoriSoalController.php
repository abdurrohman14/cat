<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriSoal;
use Illuminate\Http\Request;

class KategoriSoalController extends Controller
{
    public function index() {
        $kategori_soal = KategoriSoal::all();
        return view('partials.admin.BankSoal.kategori.kategori', [
            'title' => 'Kategori Soal',
            'kategori_soal' => $kategori_soal
        ]);
    }

    public function create() {
        return view('partials.admin.BankSoal.kategori.kategori', [
            'title' => 'Tambah Kategori Soal',
        ]);
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'nama' => 'required|string',
                'deskripsi' => 'nullable|string',
            ]);
    
            KategoriSoal::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return redirect()->route('index.kategori')->with('success', 'Kategori Soal Berhasil Ditambahkan');
        } catch (\Throwable $e) {
            return redirect()->route('index.kategori')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id) {
        $kategori_soal = KategoriSoal::find($id);
        return view('partials.admin.BankSoal.kategori.kategori', [
            'title' => 'Edit Kategori Soal',
            'kategori_soal' => $kategori_soal
        ]);
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'nama' => 'required|string',
                'deskripsi' => 'nullable|string',
            ]);
            
            $kategori_soal = KategoriSoal::find($id);
            $kategori_soal->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return redirect()->route('index.kategori')->with('success', 'Kategori Soal Berhasil Diubah');
        } catch (\Throwable $e) {
            return redirect()->route('index.kategori')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id) {
        // $kategori_soal = KategoriSoal::find($id);
        // $kategori_soal->delete();
        // return redirect()->route('index.kategori')->with('success', 'Kategori Soal Berhasil Dihapus');
        try {
            $kategori_soal = KategoriSoal::find($id);
            if (!$kategori_soal) {
                return redirect()->route('index.kategori')->with('error', 'Kategori Soal tidak ditemukan');
            }
    
            $kategori_soal->delete();
            return redirect()->route('index.kategori')->with('success', 'Kategori Soal Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()->route('index.kategori')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
