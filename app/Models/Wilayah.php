<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory, Compoships;

    protected $table = 'wilayahs'; // Nama tabel di database

    protected $fillable = [
        'kode_provinsi',
        'kode_kota',
        'kode_kecamatan',
        'kode_kelurahan',
        'nama_provinsi',
        'nama_kota',
        'nama_kecamatan',
        'nama_kelurahan',
        'is_deleted',
        'kode_full_kec',
        'kode_full_kell'
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = [
        'kode_provinsi',
        'kode_kota',
        'kode_kecamatan',
        'kode_kelurahan'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    /**
     * Relasi pivot kecamatan ke operator
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wilayahPivots()
    {
        return $this->hasOne(OperatorWilayah::class, 'kode_kec', 'kode_full_kec');
    }

    // Relasi kecamatan ke penduduk
    public function kecamatanPenduduks()
    {
        return $this->hasMany(Penduduk::class, 'nama_kecamatan', 'nama_kecamatan');
    }

    // Relasi kelurahan ke penduduk
    public function kelurahanPenduduks()
    {
        return $this->hasMany(Penduduk::class, 'nama_kelurahan', 'nama_kelurahan');
    }
}
