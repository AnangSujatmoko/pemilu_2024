<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Relawan extends Model
{
    use HasFactory, Compoships;

    protected $table = 'relawans'; // Nama tabel di database

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'no_hp',
        'kode_kel',
        'kode_lingkungan',
        'rt',
        'rw',
    ];


    // Relasi relawan ke lingkungan
    public function relawanLingkungan()
    {
        return $this->belongsTo(Lingkungan::class, ['kode_lingkungan', 'kode_kel', 'rt', 'rw'], ['kode', 'kode_kel', 'rt', 'rw']);
    }

    // Relasi kelurahan ke relawan
    public function relawanWilayah()
    {
        return $this->belongsTo(Wilayah::class, 'kode_kel', 'kode_full_kel');
    }
}
