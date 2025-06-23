<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DataPelanggan extends Authenticatable
{
    protected $fillable = ['kode', 'nama', 'noHP', 'keluhan', 'password'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($dataPelanggan) {
            $dataPelanggan->kode = 'P' . (self::max('id') + 1);
        });
    }

    public function alamatPelanggan()
    {
        return $this->hasMany(AlamatPelanggan::class, 'data_pelanggan_id');
    }

    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class, 'data_pelanggan_id');
    }
}

