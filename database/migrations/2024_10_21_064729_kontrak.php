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
            $table->string('id_kontrak');
            $table->string('entitas');
            $table->date('tanggal');
            $table->string('supplier');
            $table->string('dibeli');
            $table->integer('berat');
            $table->decimal('harga', 13, 2);
            $table->string('tipe');
            $table->string('warna')->nullable();
            $table->longText('cacatan')->nullable();
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
