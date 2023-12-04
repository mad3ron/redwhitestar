<?php

namespace App\Models\Hrd;

use Carbon\Carbon;
use App\Models\Admin\Rute;
use App\Models\Hrd\Biodata;
use App\Models\Operasi\Spjkeluar;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengemudi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nopengemudi',
        'nik',
        'rute_id',
        'tgl_kp',
        'nosim',
        'jenis_sim',
        'tgl_sim',
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

        static::creating(function ($pengemudi) {
            // Cek apakah 'nopengemudi' sudah diisi
            if (empty($pengemudi->nopengemudi)) {
                $yearMonth = Carbon::now()->format('Ym');
                $existingPengemudi = static::where('nik', $pengemudi->nik)
                    ->orderByDesc('nopengemudi')
                    ->first();

                if ($existingPengemudi) {
                    $lastNumber = substr($existingPengemudi->nopengemudi, -3);
                    $number = intval($lastNumber) + 1;
                } else {
                    $number = 1;
                }

                $pengemudi->nopengemudi = 'P-' . $yearMonth . str_pad($number, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    // Model Pengemudi berapa kali masuk
    public function countUniqueNopengemudi()
    {
        return $this->select('nopengemudi')->distinct()->count();
    }

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'rute_id', 'id');
    }

    public function biodata()
    {
        return $this->hasOne(Biodata::class, 'nik', 'nik');
    }

    public function spjkeluars()
    {
        return $this->belongsTo(Spjkeluar::class, 'nopengemudi', 'id');
    }

}
