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
        Schema::create('daftar_tipe_subkategori', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipe');
            $table->string('kode_kategori');
            $table->string('nama_kategori');
            $table->string('dibuat')->nullable();
            $table->timestamps();

            $table->foreign('id_tipe')->references('id')->on('daftar_tipe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_tipe_subkategori');
    }
};
