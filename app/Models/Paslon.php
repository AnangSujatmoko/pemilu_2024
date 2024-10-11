<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paslon extends Model
{
    protected $table = 'paslons'; // Nama tabel di database

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'uraian',
    ];

    // Relasi paslon ke penduduk
    public function paslonPenduduks()
    {
        return $this->hasMany(Penduduk::class, 'id_paslon', 'id');
    }
}
