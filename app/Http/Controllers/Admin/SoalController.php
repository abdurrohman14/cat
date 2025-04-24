<?php

namespace App\Http\Controllers\Admin;

use App\Models\Soal;
use App\Imports\SoalImport;
use App\Models\KategoriSoal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class SoalController extends Controller
{
    public function index() {
        $soal = Soal::with('kategori')->get();
        return view('partials.admin.BankSoal.soal.index',[
            'soal' => $soal,
            'title' => 'Soal'
        ]);
    }

    public function create() {
        $kategori_soal = KategoriSoal::all();
        return view('partials.admin.BankSoal.soal.create', [
            'kategori_soal' => $kategori_soal,
            'title' => 'Tambah Soal'
        ]);
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'kategori_soal' => 'required|exists:kategori_soals,id',
                'soal' => 'required|string',
                'pilihan_a' => 'nullable|string',
                'pilihan_b' => 'nullable|string',
                'pilihan_c' => 'nullable|string',
                'pilihan_d' => 'nullable|string',
                'pilihan_e' => 'nullable|string',
                'jawaban_benar' => 'required|in:a,b,c,d,e',
            ]);

            $jawabanKey = $request->jawaban_benar;
            $jawabanText = $request->input(['pilihan_' . $jawabanKey]);

            Soal::create([
                'kategori_soal' => $request->kategori_soal,
                'soal' => $request->soal,
                'pilihan_a' => $request->pilihan_a,
                'pilihan_b' => $request->pilihan_b,
                'pilihan_c' => $request->pilihan_c,
                'pilihan_d' => $request->pilihan_d,
                'pilihan_e' => $request->pilihan_e,
                'jawaban_benar' => $jawabanText,
            ]);
            return redirect()->route('index.soal')->with('success', 'Soal berhasil ditambah');
        } catch (\Throwable $e) {
            return redirect()->route('index.soal')->with('error', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }

    public function edit($id) {
        $kategori_soal = KategoriSoal::all();
        $soal = Soal::find($id);
        return view('partials.admin.BankSoal.soal.edit', [
            'kategori_soal' => $kategori_soal,
            'soal' => $soal,
            'title' => 'Edit Soal'
        ]);
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'kategori_soal' => 'required|exists:kategori_soals,id',
                'soal' => 'required|string',
                'pilihan_a' => 'nullable|string',
                'pilihan_b' => 'nullable|string',
                'pilihan_c' => 'nullable|string',
                'pilihan_d' => 'nullable|string',
                'pilihan_e' => 'nullable|string',
                'jawaban_benar' => 'required|in:a,b,c,d,e',
            ]);

            $soal = Soal::findOrFail($id);
            $jawabanKey = $request->jawaban_benar;
            $jawabanText = $request->input(['pilihan_' . $jawabanKey]);
            $soal->update([
                'kategori_soal' => $request->kategori_soal,
                'soal' => $request->soal,
                'pilihan_a' => $request->pilihan_a,
                'pilihan_b' => $request->pilihan_b,
                'pilihan_c' => $request->pilihan_c,
                'pilihan_d' => $request->pilihan_d,
                'pilihan_e' => $request->pilihan_e,
                'jawaban_benar' => $jawabanText,
            ]);
            return redirect()->route('index.soal')->with('success', 'Soal berhasil diupdate');
        } catch (\Throwable $e) {
            return redirect()->route('index.soal')->with('error', 'Terjadi kesalahan' . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $soal = Soal::find($id);
        $soal->delete();
        return redirect()->route('index.soal')->with('success', 'Soal berhasil dihapus');
        } catch (\Throwable $e) {
            return redirect()->route('index.soal')->with('error', 'Terjadi kesalahan' . $e->getMessage());
        }
    }

    public function upload() {
        return view('partials.admin.BankSoal.soal.upload', [
            'title' => 'Upload Soal'
        ]);
    }

    public function uploadFile(Request $request) {
        try {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new SoalImport, $request->file('file'));

        return redirect()->route('index.soal')->with('success', 'Kumpulan soal berhasil diupload.');
    } catch (\Exception $e) {
        // Tangani kesalahan umum
        return redirect()->route('upload')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
    }
}
