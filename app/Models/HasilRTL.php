<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilRtl extends Model
{
    use HasFactory;

    protected $table = 'hasil_r_t_l_s';

    protected $fillable = [
        'tanggal_laporan',
        'hasil_audit_id',
        'jadwal_perbaikan',
        'Minor',
        'Major',
        'OB',
        'KTS',
        'program_studi_id',
    ];
    public function hasilAudit()
    {
        return $this->belongsTo(HasilAudit::class, 'hasil_audit_id')->withDefault();
    }
}
