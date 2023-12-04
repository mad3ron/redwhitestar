<?php

namespace App\Models\Admin;

use App\Models\Admin\Tarifpnp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kota extends Model
{
    use HasFactory;

    protected $table = 'kotas'; // Menyebutkan nama tabel yang sesuai

    protected $fillable = [
        'kota',
    ];

    public function tarifpnps()
    {
        return $this->belongsTo(Tarifpnp::class, 'tarif_id');
    }
}
