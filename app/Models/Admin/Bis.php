<?php

namespace App\Models\Admin;



use App\Models\Admin\Pool;
use App\Models\Admin\Rute;
use App\Models\Cso\Booking;
use App\Models\Operasi\Spjkeluar;
use App\Models\Operasi\JadwalArmada;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bis extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nobody',
        'nopolisi',
        'nochassis',
        'nomesin',
        'rute_id',
        'pool_id',
        'merk',
        'tahun',
        'jenis',
        'seat',
        'izintrayek',
        'nomor_uji',
        'tgl_stnk',
        'tgl_stnk2',
        'tgl_kir',
        'tgl_kps',
        'kondisi',
        'rasio',
        'status_harga',
        'status',
        'keterangan',
    ];

    // protected $dates = ['created_at'];

    public function pools()
    {
        return $this->belongsTo(Pool::class, 'pool_id');
    }

    public function rutes()
    {
        return $this->belongsTo(Rute::class, 'rute_id');
    }

    public function bookings()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function spjkeluars()
    {
        return $this->belongsTo(Spjkeluar::class, 'nospj_id');
    }

    public function jadwals()
    {
        return $this->belongsTo(JadwalArmada::class, 'jadwal_id');
    }
}
