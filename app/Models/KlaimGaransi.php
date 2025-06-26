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
        'status'
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
}
