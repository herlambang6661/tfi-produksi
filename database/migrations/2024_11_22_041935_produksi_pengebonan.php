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
        Schema::create('produksi_pengebonan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kodeproduksi');
            $table->string('operator')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status')->default(1); // 0 = deleted, 1 = open, 2 = progress, 3 = close
            $table->string('dibuat')->nullable();
            $table->timestamps();
        });

        Schema::create('produksi_pengebonanItm', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kodeproduksi');
            $table->string('subkode');
            $table->string('package')->nullable();
            $table->string('type')->nullable();
            $table->string('kategori')->nullable();
            $table->string('warna')->nullable();
            $table->decimal('berat', 13, 2)->nullable();
            $table->string('operator')->nullable();
            $table->string('status')->default(1); // 0 = deleted, 1 = open, 2 = progress, 3 = close
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
