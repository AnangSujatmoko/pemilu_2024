<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SurveyPendudukExport implements FromCollection, WithHeadings, WithColumnFormatting
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
                'nama' => $penduduk->nama,
                'jenis_kelamin' => $this->getJenisKelamin($penduduk->jenis_kelamin), // Ubah angka menjadi label
                'usia' => $penduduk->usia,
                'alamat' => $penduduk->alamat,
                'rt' => $penduduk->rt,
                'rw' => $penduduk->rw,
                'tps' => $penduduk->tps,
                // 'kode_kec' => $penduduk->kode_kec,
                // 'kode_kel' => $penduduk->kode_kel,
                // 'id_paslon' => $penduduk->id_paslon,
                // 'id_domisili' => $penduduk->id_domisili,
                'kode_kec' => $penduduk->pendudukWilayah->nama_kecamatan ?? '', // Ambil nama kecamatan dari relasi
                'kode_kel' => $penduduk->pendudukWilayah->nama_kelurahan ?? '', // Ambil nama kelurahan dari relasi
                'id_paslon' => $penduduk->pendudukPaslon->uraian ?? '', // Ambil uraian dari relasi paslon
                'id_domisili' => $penduduk->pendudukDomisili->uraian ?? '', // Ambil uraian dari relasi domisili
                'keterangan' => $penduduk->keterangan,
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
        // return [
        //     'id',
        //     'nik',
        //     'nama',
        //     'jenis_kelamin',
        //     'usia',
        //     'alamat',
        //     'rt',
        //     'rw',
        //     'tps',
        //     'kode_kec',
        //     'kode_kel',
        //     'id_paslon',
        //     'id_domisili',
        //     'keterangan'
        // ];

        return [
            'NO',
            'NIK',
            'NAMA',
            'JENIS KELAMIN',
            'USIA',
            'ALAMAT',
            'RT',
            'RW',
            'TPS',
            'KECAMATAN',
            'KELURAHAN',
            'PASLON',
            'DOMISILI',
            'KETERANGAN'
        ];
    }

    // Fungsi untuk mengonversi angka jenis kelamin menjadi label 0 atau 1
    // private function getJenisKelamin($value)
    // {
    //     // return $value === 1 ? 'Perempuan' : ($value === 0 ? 'Laki-laki' : 'Tidak Diketahui');
    //     return $value === 1 ? '1' : ($value === 0 ? '0' : 'Tidak Diketahui');
    // }

    // Fungsi untuk mengonversi angka jenis kelamin menjadi label laki - lai atau perempuan
    private function getJenisKelamin($value)
    {
        return $value === 1 ? 'Perempuan' : ($value === 0 ? 'Laki-laki' : 'Tidak Diketahui');
    }
}
