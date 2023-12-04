<?php

namespace App\Enums;

enum TableActive: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Disable = 'Disable';
}
