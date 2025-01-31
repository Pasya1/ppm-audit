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
        Schema::create('daftar_tiliks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained()->onDelete('cascade');
            $table->foreignId('standart_id')->constrained()->onDelete('cascade');
            $table->text('pertanyaan_tilik')->nullable();
            $table->text('tanggapan_audit')->nullable();
            $table->text('dokumen_terkait_tilik')->nullable();
            $table->text('hasil_audit')->nullable();
            $table->boolean('my_tilik')->default(false);
            $table->boolean('mb_tilik')->default(false);
            $table->boolean('m_tilik')->default(false);
            $table->boolean('mp_tilik')->default(false);
            $table->text('rekomendasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_tiliks');
    }
};
