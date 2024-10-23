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
        Schema::create('daftar_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('npwp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kopos')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('telp')->nullable();
            $table->string('email')->nullable();
            $table->string('mtuang')->nullable();
            $table->string('dibuat')->nullable();
            $table->timestamps();
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
