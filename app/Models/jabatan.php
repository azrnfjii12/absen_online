<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    protected $fillable = [
        'nama_jabatan',
        'deskripsi',
    ];

    protected $table = 'jabatans';

    public function karyawan()
    {
        return $this->hasMany(karyawan::class);
    }
}
