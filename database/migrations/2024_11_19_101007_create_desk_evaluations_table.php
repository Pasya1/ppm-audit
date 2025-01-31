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
        Schema::create('desk_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained()->onDelete('cascade');
            $table->foreignId('standart_id')->constrained()->onDelete('cascade');
            $table->string('dokumen_terkait')->nullable();
            $table->boolean('my')->default(false);
            $table->boolean('mb')->default(false);
            $table->boolean('m')->default(false);
            $table->boolean('mp')->default(false);
            $table->boolean('ob')->default(false);
            $table->boolean('kts')->default(false);
            $table->boolean('OPEN')->default(false);
            $table->boolean('CLOSE')->default(false);
            $table->text('catatan')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desk_evaluations');
    }
};
