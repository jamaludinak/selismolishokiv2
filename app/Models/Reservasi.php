<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'servis',
        'namaLengkap',
        'alamatLengkap',
        'noTelp',
        'idJenisKerusakan',
        'deskripsi',
        'gambar',
        'video',
        'noResi',
        'status',
    ];

    // Relasi dengan model JenisKerusakan (many-to-one)
    public function jenisKerusakan()
    {
        return $this->belongsTo(JenisKerusakan::class, 'idJenisKerusakan');
    }

    // Relasi dengan model Jadwal (one-to-many)
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'idReservasi');
    }

    // Relasi dengan model Riwayat (one-to-many)
    public function riwayats()
    {
        return $this->hasMany(Riwayat::class, 'idReservasi');
    }
    
    public function reqJadwals()
    {
        return $this->hasMany(ReqJadwal::class, 'idReservasi');
    }

}