<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = [
        'data_pelanggan_id',
        'merk',
        'jenis_kendaraan',
        'tipe',
        'nomor_rangka',
        'tahun_pembelian',
        'status_garansi'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'data_pelanggan_id');
    }

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'kendaraan_id');
    }
}
