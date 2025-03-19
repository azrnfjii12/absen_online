<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    protected $fillable = [
        'user_id',
        'no_hp',
        'jabatan_id',
        'tanggal_masuk',
        'status'
    ];

    protected $table = 'karyawans';

    public function jabatan()
    {
        return $this->belongsTo(jabatan::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
