<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jabatan extends Model
{
    protected $table = 'jabatan';

    protected $fillable = [
        'nama_jabatan',
        'deskripsi',
    ];

    public function guru(): HasMany
    {
        return $this->hasMany(Guru::class);
    }

    public function karyawan(): HasMany
    {
        return $this->hasMany(Karyawan::class);
    }
}
