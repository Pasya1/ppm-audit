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
        Schema::create('detail_hasil_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('standart_id')->constrained()->onDelete('cascade');
            $table->foreignId('hasil_audit_id')->constrained()->onDelete('cascade');
            $table->string('dokumen_acuan')->nullable();
            $table->string('deskripsi_temuan')->nullable();
            $table->boolean('OPEN')->default(false);
            $table->boolean('CLOSE')->default(false);
            $table->boolean('OB')->default(false);
            $table->string('permintaan_tindakan_koreksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_hasil_audits');
    }
};
