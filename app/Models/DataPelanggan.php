<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPelanggan extends Model
{
    protected $fillable = ['kode', 'nama', 'noHP', 'alamat', 'keluhan'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($dataPelanggan) {
            $dataPelanggan->kode = 'P' . (self::max('id') + 1);
        });
    }
}

