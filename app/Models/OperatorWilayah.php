<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorWilayah extends Model
{
    use HasFactory;

    protected $table = 'operator_wilayahs'; // Nama tabel di database

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'kode_kec',
    ];

    /**
     * Pivot to User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pivotOperator()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * Pivot to Wilayah model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pivotWilayah()
    {
        return $this->belongsTo(Wilayah::class, 'kode_kec', 'kode_full_kec');
    }
}
