<?php

namespace App\Models\Admin;

use App\Models\Admin\Bis;
use App\Models\Admin\Pool;
use App\Models\Admin\Product;
use App\Models\Hrd\Kondektur;
use App\Models\Hrd\Pengemudi;
use App\Models\Admin\Tarifpnp;
use App\Models\Operasi\Spjkeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rute extends Model
{
    use HasFactory;

    protected $fillable = [
        'koderute',
        'namarute',
        'jenis',
        'stdrit',
        'pool_id',
        'product_id',
        'status',
    ];

    protected $dates = ['created_at'];

    public function pools()
    {
        return $this->belongsTo(Pool::class, 'pool_id', 'id');
    }

    public function pengemudi()
    {
        return $this->hasMany(Pengemudi::class);
    }

    public function kondektur()
    {
        return $this->hasMany(Kondektur::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function bises()
    {
        return $this->belongsTo(Bis::class, 'bis_id');
    }

    public function poscheckers()
    {
        return $this->belongsTo(Poschecker::class, 'poschecker_id');
    }

    public function tarifpnps()
    {
        return $this->belongsTo(Tarifpnp::class, 'tarifpnp_id');
    }

    public function spjkeluars()
    {
        return $this->belongsTo(Spjkeluar::class, 'nospj_id');
    }

}
