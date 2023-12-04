<?php

namespace App\Models\Admin;

use App\Models\Operasi\JadwalArmada;
use App\Models\Operasi\Spjkeluar;
use App\Models\Operasi\Spjmasuk;
use App\Models\Thk\Checkbis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kodeposisi',
    ];

    public function jadwals()
    {
        return $this->belongsTo(JadwalArmada::class);
    }

    public function spjkeluars()
    {
        return $this->belongsTo(Spjkeluar::class);
    }

    public function spjmasuks()
    {
        return $this->belongsTo(Spjmasuk::class);
    }

    public function checkbis()
    {
        return $this->belongsTo(Checkbis::class);
    }

}
