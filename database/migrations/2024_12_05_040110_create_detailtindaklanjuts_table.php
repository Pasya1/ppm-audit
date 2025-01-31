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
        Schema::create('detailtindaklanjuts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_audit_id')->constrained()->onDelete('cascade');
            $table->string('tindak_lanjut');
            $table->string('link_drive');
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
        Schema::dropIfExists('detailtindaklanjuts');
    }
};
