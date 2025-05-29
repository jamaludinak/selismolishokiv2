<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayats';

    protected $fillable = [
        'idReservasi',
        'status',
    ];

    // Relasi dengan model Reservasi (many-to-one)
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'idReservasi');
    }
}
