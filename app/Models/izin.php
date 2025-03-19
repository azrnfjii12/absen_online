<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class izin extends Model
{
    protected $fillable = [
        'karyawan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'status',
    ];

    protected $table = 'izins';
}
