<?php

namespace App\Models\Admin;

use App\Models\Admin\Rute;
use App\Models\Admin\Poschecker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarifpnp extends Model
{
    use HasFactory;

    protected $fillable = [
        'rute_id',
        'poschecker_id',
        'kota_id',
        'tarif',
        'tabri',
        'status',
        'keterangan'
    ];

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'rute_id');
    }

    public function poscheckers()
    {
        return $this->belongsTo(Poschecker::class, 'poschecker_id');
    }

    public function kotas()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }
}
