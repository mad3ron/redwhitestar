<?php

namespace App\Models\Thk;

use App\Models\Admin\Bis;
use App\Models\Admin\Pool;
use App\Models\Admin\Rute;
use App\Models\Hrd\Biodata;
use App\Models\Admin\Posisi;
use App\Models\Admin\Post;
use App\Models\Hrd\Karyawan;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buscheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_bischeck',
        'nokar_id',
        'bis_id',
        'posisi_id',
        'ket_posisi',
    ];

    protected $casts = [
        'tgl_bischeck' => 'datetime:Y-m-d', // Specify the date format of tgl_bischeck field
    ];

    public function getPasswordAttribute()
    {
        return $this->karyawanData->password;
    }

    public function getNamaUserAttribute()
    {
        return $this->karyawanData->biodata->role->name;
    }

    public function bis()
    {
        return $this->belongsTo(Bis::class, 'bis_id', 'id');
    }

    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'nokar_id', 'nik');
    }

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'bis_id', 'rute_id');
    }

    public function pool()
    {
        return $this->belongsTo(Pool::class, 'rute_id', 'pool_id');
    }

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id', 'id');
    }

    public function karyawanData()
    {
        return $this->belongsTo(Karyawan::class, 'nokar_id', 'id');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
