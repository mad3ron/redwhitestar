<?php

namespace App\Models\Admin;

use App\Models\Hrd\Biodata;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kotalahir extends Model
{
    use HasFactory;

    protected $fillable = [
        'tempat_lahir',
        'prov',
        ];

        public function biodatas()
        {
            return $this->belongsTo(Biodata::class);
        }
}
