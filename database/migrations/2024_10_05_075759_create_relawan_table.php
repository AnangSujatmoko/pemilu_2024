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
        Schema::create('relawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('no_hp', 16);
            $table->string('kode_kel');
            $table->integer('kode_lingkungan');
            $table->integer('rt');
            $table->integer('rw');
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
        Schema::dropIfExists('relawans');
    }
};
