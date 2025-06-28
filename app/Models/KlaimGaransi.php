<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KlaimGaransi extends Model
{
    protected $table = 'klaim_garansis';
    protected $fillable = [
        'reservasi_id',
        'bukti',
        'keterangan',
        'status',
        'id_pelanggan',
        'tanggal_diproses'
    ];

    protected $casts = [
        'tanggal_diproses' => 'datetime'
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }

    public function dataPelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'id_pelanggan');
    }
}
