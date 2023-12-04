<?php

namespace App\Models\Hrd;

use App\Models\User;
use App\Models\Hrd\Biodata;
use App\Models\Admin\Jabatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nokaryawan',
        'nik',
        'jabatan_id',
        'user_id',
        'tgl_kp',
        'tgl_masuk',
        'pendidikan',
        'gol_darah',
        'tinggi',
        'nojamsostek',
        'tgl_jamsos',
        'password',
        'status',
        'keterangan',
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'nik', 'nik');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function biodatas()
    {
        return $this->hasOne(Biodata::class, 'nokar_id');
    }

    public function biodataByNik()
    {
        return $this->belongsTo(Biodata::class, 'nik', 'nik');
    }

    public function biodataByNokarId()
    {
        return $this->hasOne(Biodata::class, 'nokar_id');
    }

    public function buschecks()
    {
        return $this->belongsTo(Buscheck::class, 'nokar_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
