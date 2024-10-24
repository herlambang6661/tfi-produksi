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
        Schema::create('gudang_penerimaanitm', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_kedatangan');
            $table->string('kodepenerimaan');
            $table->string('subkode');
            $table->integer('nourut');
            $table->string('status')->default(1); // 0 = deleted, 1 = open, 2 = used, 3 = close,
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
