<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailHasilAudit extends Model
{
    use HasFactory;

    protected $table = 'detail_hasil_audits';

    protected $fillable = [
        'standart_id',
        'hasil_audit_id',
        'dokumen_acuan',
        'deskripsi_temuan',
        'OPEN',
        'CLOSE',
        'OB',
        'permintaan_tindakan_koreksi',
    ];
}
