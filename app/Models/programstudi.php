<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programstudi extends Model
{

    use HasFactory;

    protected $table = 'program_studi';

    protected $fillable = [
        'nama_program_studi',
        'kode_program_studi',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'program_studi_id');
    }
}
