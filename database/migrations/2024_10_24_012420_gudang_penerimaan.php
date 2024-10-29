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
            $table->date('tanggal_kedatangan');
            $table->unsignedBigInteger('id_suratkontrak');
            $table->string('kodekontrak');
            $table->string('kodepenerimaan');
            $table->string('tipe')->nullable();
            $table->integer('qty')->nullable();
            $table->string('package')->nullable();
            $table->decimal('berat_trukpenuh', 13, 2)->nullable();
            $table->decimal('berat_trukkosong', 13, 2)->nullable();
            $table->string('nopol')->nullable();
            $table->string('driver')->nullable();
            $table->string('ktp')->nullable();
            $table->string('operator')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('signDriver')->nullable();
            $table->string('signOp')->nullable();
            $table->string('verified')->nullable();
            $table->string('status')->nullable();
            $table->string('status')->default(1); // 0 = deleted, 1 = open, 2 = signed, 3 = closed
            $table->string('dibuat')->nullable();
            $table->timestamps();

            $table->foreign('id_suratkontrak')->references('id')->on('kontrak_suratkontrak');
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
