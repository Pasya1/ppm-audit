<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilAudit extends Model
{
    protected $table = 'hasil_audits';
    protected $fillable = [
        'cover',
        'surat_pengesahan',
        'daftar_hadir',
        'berita_acara',
        'tahun_pelaksanaan',
        'lembaga',
        'tanggal_laporan',
        'koordinator_nama',
        'koordinator_nip',
        'direktur',
        'periode',
        'hari_tanggal_visitasi',
        'waktu_pelaksanaan',
        'tempat_kegiatan',
        'ketua_auditor',
        'sekretaris_auditor',
        'auditee',
        'dokumentasi',
        'tanggal_desk',
        'jangka_waktu_perbaikan',
        'program_studi_id',
    ];
    public function validasi()
    {
        return $this->hasOne(Validasi::class);
    }
}
