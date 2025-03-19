<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shift_kerja extends Model
{
    protected $fillable = [
        'nama_shift',
        'jam_masuk',
        'jam_keluar'
    ];

    protected $table = 'shift_kerjas';
}
