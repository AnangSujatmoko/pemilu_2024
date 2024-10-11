<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lingkungan extends Model
{
    use HasFactory, Compoships;

    protected $table = 'lingkungans'; // Nama tabel di database

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode',
        'kode_kel',
        'uraian',
        'rt',
        'rw',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = [
        'kode',
        'kode_kel',
        'uraian',
        'rt',
        'rw'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    // Relasi lingkungan ke relawan
    public function lingkunganRelawans()
    {
        return $this->hasMany(Relawan::class, 'id_lingkungan', 'id');
    }
}
