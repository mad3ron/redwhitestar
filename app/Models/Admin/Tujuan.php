<?php

namespace App\Models\Admin;

use App\Models\Cso\Booking;
use App\Models\Admin\Armada;
use App\Models\Cso\Pemesanan;
use App\Models\Cso\Pembayaran;
use App\Models\Operasi\JadwalArmada;
use App\Models\Admin\BiayaOperasional;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tujuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'armada_id',
        'tujuan',
        'pemakaian',
        'harga_dasar',
        ];

        protected $dates = ['created_at'];

        public function armadas()
        {
            return $this->belongsTo(Armada::class, 'armada_id', 'id');
        }

        public function bokings()
        {
            return $this->belongsTo(Booking::class, 'booking_id', 'id');
        }

        public function pemesanans()
        {
            return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'id');
        }

        public function boperasionals()
        {
            return $this->belongsTo(BiayaOperasional::class, 'boperasinals', 'id');
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
