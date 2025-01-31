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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_studi_id')->nullable(); // Relasi ke program_studi
            $table->string('tanggal_audit'); // Tanggal audit
            $table->string('judul_audit'); // Judul audit
            $table->text('link_drive'); // Link drive sebagai text karena URL panjang
            $table->string('tahun_audit'); // Tahun audit menggunakan tipe year
            $table->string('nama_auditee');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->timestamps();
            // Foreign key ke tabel program_studi
            $table->foreign('program_studi_id')->references('id')->on('program_studi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
