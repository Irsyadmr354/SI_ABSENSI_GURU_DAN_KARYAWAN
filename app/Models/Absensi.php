<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status',
        'keterangan',
        'terlambat',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'terlambat' => 'integer',
        ];
    }

    public function getTerlambatDeskripsiAttribute(): ?string
    {
        // Handle null, 0, or negative delay (early/on time) as null (no description needed)
        if (!$this->terlambat || $this->terlambat <= 0) {
            return null; 
        }

        $minutes = $this->terlambat;
        
        if ($minutes < 60) {
            return "{$minutes} Menit";
        }

        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        
        if ($remainingMinutes > 0) {
            return "{$hours} Jam {$remainingMinutes} Menit";
        }
        
        return "{$hours} Jam";
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
