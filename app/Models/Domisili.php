<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domisili extends Model
{
    protected $table = 'domisilis'; // Nama tabel di database

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'uraian',
    ];

    // Relasi domisili ke penduduk
    public function domisiliPenduduks()
    {
        return $this->hasMany(Domisili::class, 'id_domisili', 'id');
    }
}
