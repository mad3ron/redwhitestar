<?php

namespace App\Models\Operasi;

use App\Models\User;
use App\Models\Admin\Bis;
use App\Models\Admin\Armada;
use App\Models\Admin\Posisi;
use App\Models\Admin\Tujuan;
use App\Models\Cso\Pemesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalArmada extends Model
{
    use HasFactory;

    protected $fillable = [
    'tanggal',
    'bis_id',
    'posisi_id',
    'pemesanan_id',
    'keterangan',
    'user_id',
    ];

    protected $guarded = [];
    protected $dates = ['created_at'];

    public function bis()
    {
        return $this->belongsTo(Bis::class, 'bis_id', 'id');
    }

    public function posisis()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id', 'id');
    }

    public function armadas()
    {
        return $this->belongsTo(Armada::class, 'armada_id', 'id');
    }

    public function tujuans()
    {
        return $this->belongsTo(Tujuan::class, 'tujuan_id', 'id');
    }

    public function pemesanans()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
