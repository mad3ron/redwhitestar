<?php

namespace App\Models\Thk;

use App\Models\User;
use App\Models\Admin\Bis;
use App\Models\Admin\Posisi;
use App\Models\Hrd\Karyawan;
use App\Models\Admin\Userapp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkbis extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_checkbis',
        'password',
        'userapp_id',
        'bis_id',
        'posisi_id',
        'ket_posisi'
    ];

    public function userapps()
    {
        return $this->hasOne(Userapp::class, 'id', 'userapp_id');
    }

    public function bises()
    {
        return $this->belongsTo(Bis::class, 'bis_id');
    }

    public function posisis()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'password');
    }

    public function karyawans()
    {
        return $this->belongsTo(Karyawan::class, 'nokar_id', 'nokaryawan');
    }
}
