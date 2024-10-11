<?php

namespace App\Imports;

use App\Models\Penduduk; // Ganti dengan model Penduduk
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PendudukImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cek apakah kolom 'nik', 'name', 'usia', dan 'alamat' ada
        // if (!isset($row['nik']) || !isset($row['name']) || !isset($row['jenis_kelamin']) || !isset($row['usia']) || !isset($row['alamat']) || !isset($row['rt']) || !isset($row['rw']) || !isset($row['tps']) || !isset($row['kode_kec']) || !isset($row['kode_kel']) || !isset($row['id_paslon']) || !isset($row['id_domisili'])) {
        //     // Jika kolom tidak ada, skip row ini
        //     return null;
        // }

        if (!isset($row['nik']) || !isset($row['name']) || !isset($row['jenis_kelamin']) || !isset($row['usia']) || !isset($row['alamat']) || !isset($row['rt']) || !isset($row['rw']) || !isset($row['tps']) || !isset($row['kode_kec']) || !isset($row['kode_kel'])) {
            // Jika kolom tidak ada, skip row ini
            return null;
        }

        // Cek apakah penduduk sudah ada berdasarkan nik
        $penduduk = Penduduk::where('nik', $row['nik'])->first();

        if ($penduduk) {
            // Update jika data berbeda
            $penduduk->update([
                'name'  => $row['name'],
                'jenis_kelamin'  => $row['jenis_kelamin'],
                'usia'  => $row['usia'],
                'alamat' => $row['alamat'],
                'rt'  => $row['rt'],
                'rw' => $row['rw'],
                'tps'  => $row['tps'],
                'kode_kec' => $row['kode_kec'],
                'kode_kel'  => $row['kode_kel'],
                // 'id_paslon' => $row['id_paslon'],
                // 'id_domisili'  => $row['id_domisili'],
            ]);
        } else {
            // Buat penduduk baru
            $penduduk = Penduduk::create([
                'nik'   => $row['nik'],
                'name'  => $row['name'],
                'jenis_kelamin'  => $row['jenis_kelamin'],
                'usia'  => $row['usia'],
                'alamat' => $row['alamat'],
                'rt'  => $row['rt'],
                'rw'  => $row['rw'],
                'tps' => $row['tps'],
                'kode_kec'  => $row['kode_kec'],
                'kode_kel' => $row['kode_kel'],
                // 'id_paslon'  => $row['id_paslon'],
                // 'id_domisili' => $row['id_domisili'],
            ]);
        }

        // Kembalikan model penduduk untuk pencatatan
        return $penduduk;
    }
}
