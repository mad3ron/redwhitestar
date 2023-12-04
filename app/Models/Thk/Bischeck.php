<?php

namespace App\Models\Thk;

use App\Models\Admin\Bis;
use App\Models\Admin\Posisi;
use App\Models\Hrd\Karyawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bischeck extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_checkbis',
        'nokar_id',
        'bis_id',
        'posisi_id',
        'ket_posisi'
    ];

    public function karyawans()
    {
        return $this->belongsTo(Karyawan::class, 'nokar_id', 'password');
    }

    public function bises()
    {
        return $this->belongsTo(Bis::class, 'bis_id');
    }

    public function posisis()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id');
    }

}
