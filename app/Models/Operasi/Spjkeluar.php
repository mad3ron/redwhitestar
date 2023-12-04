<?php

namespace App\Models\Operasi;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\Bis;
use App\Models\Admin\Pool;
use App\Models\Admin\Rute;
use App\Models\Hrd\Biodata;
use App\Models\Admin\Posisi;
use App\Models\Cso\Pemesanan;
use App\Models\Hrd\Kondektur;
use App\Models\Hrd\Pengemudi;
use App\Models\Operasi\Spjmasuk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spjkeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomorspj',
        'tgl_klr',
        'nopesan_id',
        'posisi_id',
        'bis_id',
        'nopolisi',
        'rute_id',
        'pool_id',
        'nopengemudi_id',
        'nokondektur_id',
        'uang_jalan',
        'kmkeluar',
        'keterangan_spjklr',
        'user_id',
    ];

    protected $primaryKey = 'id';
    protected $dates = ['created_at'];

    public static function generateNoSpjkeluar()
    {
        // $year = Carbon::now()->format('y');
        // $month = Carbon::now()->format('m');
        $yearMonth = date('Ym');
        $latestSpjkeluar = self::where('nomorspj', 'like', "WST-$yearMonth%")
            ->orderBy('nomorspj', 'desc')
            ->first();

        if (!$latestSpjkeluar) {
            $newNoSpj = '00001';
        } else {
            $latestNumber = substr($latestSpjkeluar->nomorspj, -5); // Extract the last 5 digits
            $newNoSpj = str_pad($latestNumber + 1, 5, '0', STR_PAD_LEFT);
        }
        return "WST-$yearMonth-$newNoSpj";
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($spjkeluar) {
            $spjkeluar->nomorspj = $spjkeluar->generateNoSpjkeluar();
        });
    }

    public function pemesanans()
    {
        return $this->belongsTo(Pemesanan::class, 'nopesan_id', 'id');
    }

    public function posisis()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id', 'id');
    }

    public function bis()
    {
        return $this->belongsTo(Bis::class, 'bis_id', 'id');
    }

    public function rutes()
    {
        return $this->belongsTo(Rute::class, 'rute_id', 'id');
    }

    public function pools()
    {
        return $this->belongsTo(Pool::class, 'pool_id', 'id');
    }

    public function pengemudis()
    {
        return $this->belongsTo(Pengemudi::class, 'nopengemudi_id','id');
    }

    public function kondekturs()
    {
        return $this->belongsTo(Kondektur::class, 'nokondektur_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'biodata_id');
    }

    public function spjmasuks()
    {
        return $this->hasMany(Spjmasuk::class, 'nospj_id', 'nospj_id');
    }

    // public static function generateNoSpjkeluar()
    // {
    //     $today = Carbon::now();
    //     $lastSpj = SpjKeluar::whereYear('created_at', $today->year)
    //         ->whereMonth('created_at', $today->month)
    //         ->latest('nospjkeluar')
    //         ->first();

    //     if ($lastSpj) {
    //         $lastNumber = (int)substr($lastSpj->nospjkeluar, 7);
    //         $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
    //     } else {
    //         $newNumber = '00001';
    //     }

    //     $spjNumber = $today->format('ym') . '.' . $newNumber;

    //     // Simpan nomor SPJ baru ke dalam tabel
    //     $newSpj = new SpjKeluar();
    //     $newSpj->nospjkeluar = $spjNumber;
    //     //Tambahkan kolom lainnya sesuai kebutuhan
    //     $newSpj->save();

    //     return $spjNumber;
    // }


}
