<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    protected $fillable = [
        'kata_pengantar',
        'daftar_isi',
        'latar_belakang',
        'tujuan_pemeriksaan',
        'lingkup_pemeriksaan',
        'dasar_hukum',
        'batasan_pemeriksaan',
        'metode_pemeriksaan',
        'pengorganisasian_tim_audit',
    ];
}
