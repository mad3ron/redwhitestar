<?php

namespace App\Models\Cso;

use App\Models\User;
use App\Models\Admin\Pool;
use App\Models\Admin\Armada;
use App\Models\Admin\Tujuan;
use App\Models\Cso\Pembayaran;
use App\Models\Operasi\JadwalArmada;
use App\Models\Operasi\Spjkeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_pesan',
        'nama_pemesan',
        'phone',
        'tujuan_id',
        'harga',
        'alamat',
        'tgl_brkt',
        'tgl_pulang',
        'jam_jemput',
        'jml_bis',
        'biaya_jemput',
        'armada_id',
        'pool_id',
        'user_id',
        'status',
    ];
        protected $table = 'pemesanans';

        protected $dates = ['created_at'];


        public function armadas()
        {
            return $this->belongsTo(Armada::class, 'armada_id', 'id');
        }

        public function tujuans()
        {
            return $this->belongsTo(Tujuan::class, 'tujuan_id', 'id');
        }

        public function pools()
        {
            return $this->belongsTo(Pool::class, 'pool_id', 'id');
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function jadwals()
        {
            return $this->belongsTo(JadwalArmada::class);
        }

        public function pembayaran()
        {
            return $this->hasMany(Pembayaran::class, 'nopesan_id', 'id');
        }

        public function spjkeluar()
        {
            return $this->belongsTo(Spjkeluar::class, 'nospj_id','id');
        }

        public static function boot()
        {
            parent::boot();

            static::creating(function ($pemesanan) {

                 // Isi field "jenis_armada" dengan data dari tabel "armadas"
                 $jenisArmada = $pemesanan->armadas->jenis_armada;

                // Isi field "harga" dengan data dari tabel "tujuan"
                $hargaDasar = $pemesanan->tujuans->harga_dasar;

                // Gabungkan data dari "tujuan" dan "armadas" untuk field "harga"
                $pemesanan->harga = $hargaDasar ;
            });
        }

}
