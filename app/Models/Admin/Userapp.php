<?php

namespace App\Models\Admin;

use App\Models\Hrd\Karyawan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Userapp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nokar_id',
        'password',
        'status'
    ];

    public function karyawans()
    {
        return $this->belongsTo(Karyawan::class, 'biodata_id', 'nik');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'password');
    }

    public function karyawan()
{
    return $this->belongsTo(Karyawan::class, 'nokar_id', 'id');
}

}
