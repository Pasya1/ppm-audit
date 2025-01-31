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
        Schema::create('tindaklanjuts', function (Blueprint $table) {
            $table->id();
            $table->string('cover', 255)->nullable();
            $table->string('surat_pengesahan', 255)->nullable();
            $table->string('daftar_hadir', 255)->nullable();
            $table->string('berita_acara', 255)->nullable();
            $table->string('periode', 255)->nullable();
            $table->year('tahun_pelaksanaan')->nullable();
            $table->string('lembaga', 255)->nullable();
            $table->date('tanggal_laporan')->nullable();
            $table->string('koordinator_nama', 255)->nullable();
            $table->string('koordinator_nip', 255)->nullable();
            $table->string('hari_tanggal_visitasi', 255)->nullable();
            $table->string('waktu_pelaksanaan', 255)->nullable();
            $table->string('tempat_kegiatan', 255)->nullable();
            $table->string('ketua_auditor', 255)->nullable();
            $table->string('sekretaris_auditor', 255)->nullable();
            $table->string('auditee', 255)->nullable();
            $table->string('dokumentasi', 255)->nullable();
            $table->string('jurusan', 255)->nullable();
            $table->date('tanggal_desk')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->unsignedBigInteger('program_studi_id')->nullable();
            $table->foreign('program_studi_id')->references('id')->on('program_studi')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindaklanjuts');
    }
};
