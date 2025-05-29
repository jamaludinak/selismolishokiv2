<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqJadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'idReservasi',
        'tanggal',
        'waktuMulai',
        'waktuSelesai',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'idReservasi');
    }
}