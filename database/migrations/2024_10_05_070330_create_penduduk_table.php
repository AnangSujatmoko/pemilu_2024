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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->nullable();
            $table->string('nama');
            $table->integer('jenis_kelamin')->nullable()->unsigned();
            $table->integer('usia')->nullable()->unsigned();
            $table->text('alamat');
            $table->integer('rt')->unsigned();
            $table->integer('rw')->unsigned();
            $table->integer('tps',)->nullable()->unsigned();
            $table->string('kode_kec');
            $table->string('kode_kel');
            $table->integer('id_paslon')->nullable()->unsigned();
            $table->integer('id_domisili')->nullable()->unsigned();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->primary(['id']);
            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
