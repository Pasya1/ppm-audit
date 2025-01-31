<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tindaklanjut extends Model
{
    use HasFactory;

    protected $table = 'tindaklanjuts';

    protected $fillable = [
        'cover',
        'surat_pengesahan',
        'daftar_hadir',
        'berita_acara',
        'periode',
        'tahun_pelaksanaan',
        'lembaga',
        'tanggal_laporan',
        'koordinator_nama',
        'koordinator_nip',
        'hari_tanggal_visitasi',
        'waktu_pelaksanaan',
        'tempat_kegiatan',
        'ketua_auditor',
        'sekretaris_auditor',
        'auditee',
        'dokumentasi',
        'jurusan',
        'tanggal_desk',
        'kesimpulan',
    ];
}
