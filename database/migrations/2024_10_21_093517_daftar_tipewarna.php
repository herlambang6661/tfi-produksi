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
        Schema::create('daftar_tipewarna', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipe');
            $table->string('kode');
            $table->string('warna');
            $table->string('dibuat')->nullable();
            $table->timestamps();

            $table->foreign('id_tipe')->references('id')->on('daftar_tipe')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
