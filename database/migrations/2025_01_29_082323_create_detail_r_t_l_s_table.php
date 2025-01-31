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
        Schema::create('detail_r_t_l_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_r_t_l_id')->constrained('hasil_r_t_l_s')->onDelete('cascade');
            $table->text('pernyataan_standar')->nullable();
            $table->text('keterangan_hasil_AMI')->nullable();
            $table->text('rencana_tindak_lanjut')->nullable();
            $table->text('sumber_daya')->nullable();
            $table->text('hasil_RTL')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_r_t_l_s');
    }
};
