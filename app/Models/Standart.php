<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standart extends Model
{
    use HasFactory;

    protected $table = 'standarts';
    protected $fillable = [
        'dokumen_acuan',
        'dokumen_audit_id',
    ];
}
