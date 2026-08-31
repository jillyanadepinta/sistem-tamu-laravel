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
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('no_hp', 20);
            $table->string('asal', 100);
            $table->string('jenis_kunjungan', 50);
            $table->text('keperluan')->nullable();
            $table->string('foto', 255);
            $table->date('tanggal');
            $table->time('jam');
            $table->integer('nomor_antrean');
            $table->string('status', 20)->default('Menunggu');
            $table->boolean('dilihat')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};