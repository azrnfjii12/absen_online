<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'shift_id',
        'jam_masuk',
        'jam_keluar',
        'status',
        'keterangan'
    ];

    protected $table = 'absensis';
}
