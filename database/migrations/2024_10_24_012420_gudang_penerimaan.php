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
        Schema::create('gudang_penerimaan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('npb');
            $table->string('nopol')->nullable();
            $table->string('ktp')->nullable();
            $table->string('driver')->nullable();
            $table->string('operator')->nullable();
            $table->string('signDriver')->nullable();
            $table->string('signOp')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status')->default(1); // 0 = deleted, 1 = open, 2 = signed, 3 = partial, 4 = close
            $table->string('verified')->default(0);
            $table->string('dibuat')->nullable();
            $table->timestamps();
        });
        Schema::create('gudang_penerimaanitm', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('npb');
            $table->string('kodekontrak');
            $table->string('tipe')->nullable();
            $table->string('kategori')->nullable();
            $table->string('warna')->nullable();
            $table->integer('qty')->nullable();
            $table->string('package')->nullable();
            $table->integer('kedatangan_ke')->nullable();
            $table->integer('berat')->nullable();
            $table->decimal('berat_trukpenuh', 13, 2)->nullable();
            $table->decimal('berat_trukkosong', 13, 2)->nullable();
            $table->string('supplier')->nullable();
            $table->string('verified')->default(0);
            $table->string('status')->default(1); // 0 = deleted, 1 = open, 2 = needed approval, 3 = signed, 4 = closed
            $table->string('dibuat')->nullable();
            $table->timestamps();
        });
        Schema::create('gudang_penerimaanQrcode', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('npb');
            $table->string('kodekontrak');
            $table->string('subkode');
            $table->integer('nourut');
            $table->decimal('berat_satuan', 13, 2)->nullable();
            $table->decimal('berat_total', 13, 2)->nullable();
            $table->integer('qty_total')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->default(1); // 0 = deleted, 1 = open, 2 = used, 3 = proses, 4 = close,
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
