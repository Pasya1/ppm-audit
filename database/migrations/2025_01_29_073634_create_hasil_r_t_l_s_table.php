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
        Schema::create('hasil_r_t_l_s', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_laporan')->nullable();
            $table->foreignId('hasil_audit_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('jadwal_perbaikan')->nullable();
            $table->boolean('Minor')->default(false);
            $table->boolean('Major')->default(false);
            $table->boolean('OB')->default(false);
            $table->boolean('KTS')->default(false);
            $table->unsignedBigInteger('program_studi_id')->nullable();
            $table->foreign('program_studi_id')->references('id')->on('program_studi')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_r_t_l_s');
    }
};
