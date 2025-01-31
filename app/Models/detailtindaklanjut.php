<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailtindaklanjut extends Model
{
    use HasFactory;

    protected $table = 'detailtindaklanjuts';

    protected $fillable = [
        'hasil_audit_id',
        'standart_id',
        'tindak_lanjut',
        'link_drive',
        'program_studi_id',
    ];
}
