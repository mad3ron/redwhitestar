<?php

namespace App\Models\Admin;

use App\Models\Sdm\Biodata;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'kelurahans';

    protected $fillable = [
        'name',
        'kecamatan',
        'dapil',
        'kabkota',
        'provinsi',
        'kodepos',
    ];

    protected $dates = ['created_at'];

    public function biodatas()
    {
        return $this->belongsTo(Biodata::class, 'biodata_id');
    }
}
