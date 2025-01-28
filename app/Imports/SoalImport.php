<?php

namespace App\Imports;

use App\Models\Soal;
use App\Models\KategoriSoal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class SoalImport implements ToModel, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $kategori = KategoriSoal::where('nama', $row[0])->firstOrCreate(['nama' => $row[0]]);

        // Periksa apakah soal dengan kategori yang sama sudah ada
        $existingSoal = Soal::where('kategori_soal', $kategori->id)
                            ->where('soal', $row[1])
                            ->first();

        // Jika soal sudah ada, jangan simpan lagi
        if ($existingSoal) {
            return null; // Soal sudah ada, tidak disimpan
        }

        return new Soal([
            'kategori_soal' => $kategori->id,
            'soal'          => $row[1],
            'pilihan_a'     => $row[2],
            'pilihan_b'     => $row[3],
            'pilihan_c'     => $row[4],
            'pilihan_d'     => $row[5],
            'pilihan_e'     => $row[6],
            'jawaban_benar' => $row[7],
        ]);
        // return new Soal([
        //     //
        // ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string|max:255', // Validasi nama kategori
            '1' => 'required|string',         // Validasi soal
            '2' => 'nullable|string',         // Validasi pilihan A
            '3' => 'nullable|string',         // Validasi pilihan B
            '4' => 'nullable|string',         // Validasi pilihan C
            '5' => 'nullable|string',         // Validasi pilihan D
            '6' => 'nullable|string',         // Validasi pilihan E
            '7' => 'required|string',         // Validasi jawaban benar
        ];
    }
}
