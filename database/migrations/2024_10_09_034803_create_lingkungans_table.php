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
        Schema::create('lingkungans', function (Blueprint $table) {
            // $table->id();
            $table->integer('kode');
            $table->string('kode_kel');
            $table->string('uraian');
            $table->integer('rt');
            $table->integer('rw');
            $table->timestamps();

            $table->primary(['kode', 'kode_kel', 'uraian', 'rt', 'rw']);
            $table->index(['kode', 'kode_kel', 'uraian', 'rt', 'rw']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lingkungans');
    }
};
