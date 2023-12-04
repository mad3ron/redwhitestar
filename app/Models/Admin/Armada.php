<?php

namespace App\Models\Admin;

use App\Models\Admin\Tujuan;
use App\Models\Admin\BiayaOperasional;
use App\Models\Cso\Pembayaran;
use App\Models\Operasi\JadwalArmada;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Armada extends Model
{
    use HasFactory;

    protected $fillable = [
    'jenis_armada',
    'seat',
    'descripsi',
    'photo',
    ];

    protected $dates = ['created_at'];

    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class);
    }

    public function boperasionals()
    {
        return $this->belongsTo(BiayaOperasional::class);
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function jadwals()
    {
        return $this->belongsTo(JadwalArmada::class);
    }
}
