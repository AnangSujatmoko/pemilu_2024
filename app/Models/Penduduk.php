<?php

namespace App\Models;

use App\Enums\JenisKelaminEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Menggunakan model biasa, bukan Authenticatable

class Penduduk extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'penduduks'; // Pastikan nama tabel sudah benar

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'usia',
        'alamat',
        'rt',
        'rw',
        'tps',
        'kode_kec',
        'kode_kel',
        'id_paslon',
        'id_domisili',
        'keterangan',
    ];

    protected $cast = [
        'jenis_kelamin' => JenisKelaminEnum::class,
    ];

    /**
     * Accessor untuk label jenis kelamin
     *
     * @return string
     */
    public function getJenisKelaminLabelAttribute(): string
    {
        return $this->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
    }

    // Relasi kecamatan ke penduduk
    public function pendudukWilayah()
    {
        return $this->belongsTo(Wilayah::class, 'kode_kel', 'kode_full_kel');
    }

    // Relasi paslon ke penduduk
    public function pendudukPaslon()
    {
        return $this->belongsTo(Paslon::class, 'id_paslon', 'id');
    }

    // Relasi domisili ke penduduk
    public function pendudukDomisili()
    {
        return $this->belongsTo(Domisili::class, 'id_domisili', 'id');
    }
}
