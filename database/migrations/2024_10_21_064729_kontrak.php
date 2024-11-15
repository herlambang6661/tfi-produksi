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
        Schema::create('kontrak_suratkontrak', function (Blueprint $table) {
            $table->id();
            $table->string('entitas');
            $table->string('noform');
            $table->date('tanggal');
            $table->string('supplier');
            $table->string('dibeli');
            $table->longText('keterangan')->nullable();
            $table->integer('lock')->default(0);
            $table->integer('olahan')->default(0);
            $table->string('dibuat')->nullable();
            $table->timestamps();
        });
        Schema::create('kontrak_suratkontrakitm', function (Blueprint $table) {
            $table->id();
            $table->string('noform');
            $table->string('id_kontrak');
            $table->date('tanggal');
            $table->string('tipe');
            $table->string('kategori')->nullable();
            $table->string('warna')->nullable();
            $table->integer('berat');
            $table->decimal('harga', 13, 2);
            $table->integer('lock')->default(0);
            $table->string('status')->default(1); // 0 = deleted, 1 = open, 2 = progress, 3 = partial, 4 = used, 5 = close, 99 = processed
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
