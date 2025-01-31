<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarTilik extends Model
{
    use HasFactory;

    protected $table = 'daftar_tiliks';

    protected $fillable = [
        'document_id',
        'standart_id',
        'pertanyaan_tilik',
        'tanggapan_audit',
        'dokumen_terkait_tilik',
        'hasil_audit',
        'my_tilik',
        'mb_tilik',
        'm_tilik',
        'mp_tilik',
        'rekomendasi',
    ];
}
