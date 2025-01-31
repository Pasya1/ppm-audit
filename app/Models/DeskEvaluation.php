<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'standart_id',
        'dokumen_terkait',
        'my',
        'mb',
        'm',
        'mp',
        'ob',
        'kts',
        'status_temuan',
        'catatan',
        'penanggung_jawab',
    ];
}
