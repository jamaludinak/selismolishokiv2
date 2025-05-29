<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';

    protected $fillable = [
        'idReservasi',
        'tanggal',
        'waktuMulai',
        'waktuSelesai',
    ];

    // Relasi dengan model Reservasi (many-to-one)
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'idReservasi');
    }
}
