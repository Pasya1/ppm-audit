<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $table = 'validasis';

    protected $fillable = [
        'hasil_audit_id',
        'tanda_tangan_auditor',
        'tanda_tangan_auditee',
        'status_validasi',
    ];

    public function hasilAudit()
    {
        return $this->belongsTo(HasilAudit::class);
    }
}
