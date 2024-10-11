<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PendudukExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    // Mengambil data penduduk untuk diekspor dan menambahkan nomor urut
    public function collection()
    {
        $penduduks = Penduduk::all();

        // Tambahkan penomoran manual mulai dari 1
        return $penduduks->map(function ($penduduk, $index) {
            return [
                'id' => $index + 1,  // ID otomatis dimulai dari 1
                'nik' => "" . $penduduk->nik . " ", // Format NIK sebagai teks
                'name' => $penduduk->name,
                'jenis_kelamin' => $this->getJenisKelamin($penduduk->jenis_kelamin), // Ubah angka menjadi label
                'usia' => $penduduk->usia,
                'alamat' => $penduduk->alamat,
                'rt' => $penduduk->rt,
                'rw' => $penduduk->rw,
                'tps' => $penduduk->tps,
                'kode_kec' => $penduduk->kode_kec,
                'kode_kel' => $penduduk->kode_kel,
                // 'id_paslon' => $penduduk->id_paslon,
                // 'id_domisili' => $penduduk->id_domisili,
            ];
        });
    }

    public function columnFormats(): array
    {
        // $nik = "B2:B" . Penduduk::count();;
        $nik = "B2:B100";
        $tps = "I2:I100";
        // dd($columns);
        return [
            "$nik" => NumberFormat::FORMAT_TEXT,
            "$tps" => NumberFormat::FORMAT_TEXT,
        ];
    }

    // Menambahkan heading di bagian atas kolom
    public function headings(): array
    {
        return [
            'id',
            'nik',
            'name',
            'jenis_kelamin',
            'usia',
            'alamat',
            'rt',
            'rw',
            'tps',
            'kode_kec',
            'kode_kel'
        ];
    }

    // Fungsi untuk mengonversi angka jenis kelamin menjadi label
    private function getJenisKelamin($value)
    {
        // return $value === 1 ? 'Perempuan' : ($value === 0 ? 'Laki-laki' : 'Tidak Diketahui');
        return $value === 1 ? '1' : ($value === 0 ? '0' : 'Tidak Diketahui');
    }
}
