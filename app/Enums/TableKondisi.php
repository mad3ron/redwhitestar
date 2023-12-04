<?php

namespace App\Enums;

enum TableKondisi: string
{
    case Baik = 'Baik';
    case Sedang = 'Sedang';
    case Buruk = 'Buruk';
    case Rusak = 'Rusak';
    case Upkir = 'Upkir';
}
