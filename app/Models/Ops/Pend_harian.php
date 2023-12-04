<?php

namespace App\Models\Ops;

use App\Models\Admin\Pool;
use App\Models\Admin\Rute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pend_harian extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_pend',
        'rute_id',
        'ba',
        'bo',
        'setor',
        'rit',
        'pos1',
        'pos2',
        'pos3',
        'pos4',
        'pos5',
        'pnpt1',
        'pnpt2',
        'pnpt3',
        'pend_ops',
        'ang_kwa',
        'pend_bersih',
    ];

    public function rutes()
    {
        return $this->belongsTo(Rute::class, 'rute_id');
    }

    public function pool()
    {
        return $this->belongsTo(Pool::class, 'pool_id');
    }
}
