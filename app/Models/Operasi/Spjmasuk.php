<?php

namespace App\Models\Operasi;

use App\Models\User;
use App\Models\Admin\Posisi;
use App\Models\Operasi\Spjkeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spjmasuk extends Model
{
    use HasFactory;

    protected $fillable = [
    'nospj_id',
    'tgl_masuk',
    'kmmasuk',
    'biaya_bbm',
    'uang_makan',
    'biaya_tol',
    'parkir',
    'biaya_lain',
    'keterangan_spjmasuk',
    'user_id',
    ];

    protected $primaryKey = 'id';
    protected $dates = ['created_at'];

    public function spjkeluars()
    {
        return $this->belongsTo(Spjkeluar::class, 'nospj_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posisis()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id', 'id');
    }
}
