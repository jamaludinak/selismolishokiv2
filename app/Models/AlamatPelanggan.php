<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlamatPelanggan extends Model
{
    protected $fillable = [
        'data_pelanggan_id', 'alamat', 'longitude', 'latitude'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'data_pelanggan_id');
    }
} 