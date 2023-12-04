<?php

namespace App\Models\Hrd;

use App\Models\Admin\Jabatan;
use App\Models\Hrd\Kondektur;
use App\Models\Hrd\Pengemudi;
use App\Models\Admin\Kelurahan;
use App\Models\Admin\Kotalahir;
use App\Models\Operasi\Spjkeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nokk',
        'nama',
        'kotalahir_id',
        'tgl_lahir',
        'status',
        'agama',
        'jenis',
        'alamat',
        'rt',
        'rw',
        'kelurahan_id',
        'phone',
        'jabatan_id',
        'is_visible',
    ];


    public function kelurahans()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

    public function kotalahirs()
    {
        return $this->belongsTo(Kotalahir::class, 'kotalahir_id', 'id');
    }

    public function karyawans()
    {
        return $this->belongsTo(Karyawan::class, 'nik', 'nik');
    }

    public function pengemudi()
    {
        return $this->belongsTo(Pengemudi::class, 'nik', 'nik');
    }

    public function kondektur()
    {
        return $this->belongsTo(Kondektur::class, 'nik', 'nik');
    }

    public function jabatans()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    public function spjkeluars()
    {
        return $this->belongsTo(Spjkeluar::class, 'nospj_id', 'id');
    }

    public function buschecks()
    {
        return $this->hasMany(Buscheck::class, 'nokar_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastId = static::max('id');
            $newId = ($lastId ?? 0) + 1;
            $model->id = $model->nik_id . str_pad($newId, 3, '0', STR_PAD_LEFT);
        });
    }

}
