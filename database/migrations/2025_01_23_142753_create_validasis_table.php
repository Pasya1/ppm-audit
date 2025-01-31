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
        Schema::create('validasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_audit_id')->constrained()->onDelete('cascade');
            $table->text('tanda_tangan_auditor')->nullable();
            $table->text('tanda_tangan_auditor2')->nullable();
            $table->text('tanda_tangan_auditee')->nullable();
            $table->text('tanda_tangan_direktur')->nullable();
            $table->text('tanda_tangan_koordinator')->nullable();
            $table->unsignedTinyInteger('status_validasi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasis');
    }
};
