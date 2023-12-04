<?php

namespace App\Models\Admin;

use App\Models\Admin\Bis;
use App\Models\Admin\Rute;
use App\Models\Operasi\Spjkeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pool extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pool',
        'alamat',
        'phone',
        'status',
    ];

    // protected $dates = ['created_at'];

    public function rutes()
    {
        return $this->belongsTo(Rute::class, 'rute_id');
    }

    public function biss()
    {
        return $this->belongsTo(Bis::class, 'bis_id');
    }

    public function spjkeluars()
    {
        return $this->belongsTo(Spjkeluar::class, 'nospj_id');
    }
}
