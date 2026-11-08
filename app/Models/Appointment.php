<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'scheduled_at',
        'status',
    ];

    // Relasi balik: Jadwal ini milik siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}