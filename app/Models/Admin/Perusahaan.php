<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $dates = ['created_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
