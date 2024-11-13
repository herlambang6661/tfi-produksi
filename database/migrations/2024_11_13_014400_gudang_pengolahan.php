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
        Schema::create('gudang_pengolahan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kodeolah');
            $table->string('operator')->nullable();
            $table->string('status')->default(1);
            $table->string('dibuat')->nullable();
            $table->timestamps();
        });

        Schema::create('gudang_pengolahanItm', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kodeolah');
            $table->string('kodekontrak');
            $table->string('package');
            $table->decimal('berat', 13, 2)->nullable();
            $table->string('operator')->nullable();
            $table->string('status')->default(1);
            $table->string('dibuat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gudang_pengolahan');
    }
};
