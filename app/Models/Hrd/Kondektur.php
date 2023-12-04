<?php

namespace App\Models\Hrd;

use Carbon\Carbon;
use App\Models\Admin\Rute;
use App\Models\Hrd\Biodata;
use App\Models\Operasi\Spjkeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kondektur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nokondektur',
        'nik',
        'rute_id',
        'tgl_kp',
        'nojamsostek',
        'tgl_jamsos',
        'status',
        'keterangan',
    ];

    protected $primaryKey = 'id';
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kondektur) {
            // Cek apakah 'nokondektur' sudah diisi
            if (empty($kondektur->nokondektur)) {
                $yearMonth = Carbon::now()->format('Ym');
                $existingKondetur = static::where('nik', $kondektur->nik)
                    ->orderByDesc('nokondektur')
                    ->first();

                if ($existingKondetur) {
                    $lastNumber = substr($existingKondetur->nokondektur, -3);
                    $number = intval($lastNumber) + 1;
                } else {
                    $number = 1;
                }

                $kondektur->nokondektur = 'K-' . $yearMonth . str_pad($number, 3, '0', STR_PAD_LEFT);
            }
        });
    }

     // Model Kondetur berapa kali masuk
     public function countUniqueNokondektur()
     {
         return $this->select('nokondektur')->distinct()->count();
     }

    public function biodata()
    {
        return $this->hasOne(Biodata::class, 'nik', 'nik');
    }

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'rute_id', 'id');
    }

    public function spjkeluars()
    {
        return $this->belongsTo(Spjkeluar::class, 'nokondektur','id');
    }

}
