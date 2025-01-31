<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;
    protected $fillable = [
        'program_studi_id',
        'tanggal_audit',
        'tahun_audit',
        'judul_audit',
        'link_drive',
        'nama_auditee',
        'uploaded_by',
    ];
    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function programStudi()
    {
        return $this->belongsTo(programstudi::class, 'program_studi_id');
    }
}
