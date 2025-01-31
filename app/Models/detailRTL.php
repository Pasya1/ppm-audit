<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailRTL extends Model
{
    protected $table = 'detail_r_t_l_s';

    protected $fillable = [
        'pernyataan_standar',
        'keterangan_hasil_AMI',
        'rencana_tindak_lanjut',
        'sumber_daya',
        'hasil_RTL',
        'hasil_r_t_l_id',
    ];
}
