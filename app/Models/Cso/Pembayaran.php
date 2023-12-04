<?php

namespace App\Models\Cso;

use PDO;
use App\Models\User;
use App\Models\Admin\Pool;
use App\Models\Admin\Armada;
use App\Models\Admin\Tujuan;
use App\Models\Cso\Pemesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nopesan_id',
        'nomorPembayaran',
        'tgl_bayar',
        'kode_pembayaran',
        'jml_bayar',
        'discount',
        'jenis_bayar',
        'keterangan',
        'user_id',
    ];

    protected $dates = ['created_at'];

    public function pools()
    {
        return $this->belongsTo(Pool::class, 'pool_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'nopesan_id', 'id');
    }


    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'nopesan_id', 'id');
    }


    public function armadas()
    {
        return $this->belongsTo(Armada::class, 'armada_id', 'id');
    }

    public function tujuans()
    {
        return $this->belongsTo(Tujuan::class, 'tujuan_id', 'id');
    }

    public static function generateNoPembayaran()
    {
        $yearMonth = date('Ym'); // Get the current year and month
        $latestPembayaran = self::where('nomorPembayaran', 'like', "INV-$yearMonth%")
            ->orderBy('nomorPembayaran', 'desc')
            ->first();

        if (!$latestPembayaran) {
            // If there are no records for the current year and month, start from 00001
            $newNoPembayaran = '00001';
        } else {
            $latestNumber = substr($latestPembayaran->nomorPembayaran, -5); // Extract the last 5 digits
            $newNoPembayaran = str_pad($latestNumber + 1, 5, '0', STR_PAD_LEFT);
        }

        return "INV-$yearMonth-$newNoPembayaran";
    }

    public function getPemesanDetails($id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json(['error' => 'Pembayaran not found']);
        }

        $paymentDetails = $pembayaran->getPaymentDetails();

        return response()->json($paymentDetails);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pembayaran) {
            $pembayaran->nomorPembayaran = $pembayaran->generateNoPembayaran();
        });
    }


}
