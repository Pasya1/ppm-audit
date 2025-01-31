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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->text('kata_pengantar');
            $table->text('daftar_isi');
            $table->text('latar_belakang');
            $table->text('tujuan_pemeriksaan');
            $table->text('lingkup_pemeriksaan');
            $table->text('dasar_hukum');
            $table->text('batasan_pemeriksaan');
            $table->text('metode_pemeriksaan');
            $table->text('pengorganisasian_tim_audit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
