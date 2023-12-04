<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Hrd\Biodata;
use App\Models\Hrd\Karyawan;
use App\Models\Hrd\Kondektur;
use App\Models\Hrd\Pengemudi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kodejab',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function biodatas()
    {
        return $this->belongsTo(Biodata::class, 'biodata_id','id');
    }

    public function personils()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function pengemudis()
    {
        return $this->belongsTo(Pengemudi::class);
    }

    public function kondekturs()
    {
        return $this->belongsTo(Kondektur::class);
    }
}
