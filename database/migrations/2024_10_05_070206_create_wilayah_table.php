<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wilayahs', function (Blueprint $table) {
            // $table->id();
            $table->integer('kode_provinsi');
            $table->integer('kode_kota');
            $table->integer('kode_kecamatan');
            $table->integer('kode_kelurahan');
            $table->string('nama_provinsi')->nullable();
            $table->string('nama_kota')->nullable();
            $table->string('nama_kecamatan')->nullable();
            $table->string('nama_kelurahan')->nullable();
            $table->integer('is_deleted');
            $table->string('kode_full_kec');
            $table->string('kode_full_kel');
            $table->timestamps();

            // $table->unique(['kode_provinsi', 'kode_kota', 'kode_kecamatan', 'kode_kelurahan'], 'kode_index_unique');
            $table->primary(['kode_provinsi', 'kode_kota', 'kode_kecamatan', 'kode_kelurahan']);

            // $table->index([
            //     // 'id',
            //     'kode_provinsi',
            //     'kode_kota',
            //     'kode_kecamatan',
            //     'kode_kelurahan'
            // ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayahs');
    }
};
