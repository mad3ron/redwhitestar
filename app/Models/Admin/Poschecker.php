<?php

namespace App\Models\Admin;

use App\Models\Admin\Rute;
use App\Models\Admin\Tarif;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poschecker extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodepos',
        'namapos',
        'wilayah',
        'status',
    ];

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'rute_id');
    }

    public function tarifpnps()
    {
        return $this->belongsTo(Tarifpnp::class, 'tarifpnp_id');
    }

}
