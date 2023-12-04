<?php

namespace App\Models\Thk;

use App\Models\Admin\Bis;
use App\Models\Admin\Userapp;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Edp\UserAppController;
use App\Models\Admin\Posisi;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thkchecing extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl_checking',
        'userapp_id',
        'bis_id',
        'posisi_id',
        'ket_posisi',
    ];

    public function userapps()
    {
        return $this->belongsTo(Userapp::class, 'userapp_id');
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
