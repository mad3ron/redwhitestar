<?php

namespace App\Models\Cso;

use App\Models\User;
use App\Models\Admin\Bis;
use App\Models\Admin\Tujuan;
use App\Observers\BookingObserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'nobooking',
        'tanggal',
        'bis_id',
        'nama_konsumen',
        'phone',
        'tujuan_id',
        'keterangan',
        'user_id',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            $booking->noBooking = $booking->generateNoBooking();
        });
    }

    public static function generateNoBooking()
    {
        $yearMonth = date('Ym'); // Get the current year and month
        $latestBooking = self::where('noBooking', 'like', "INV-$yearMonth%")
            ->orderBy('noBooking', 'desc')
            ->first();

        if (!$latestBooking) {
            // If there are no records for the current year and month, start from 00001
            $newNoBooking = '00001';
        } else {
            $latestNumber = substr($latestBooking->noBooking, -5); // Extract the last 5 digits
            $newNoBooking = str_pad($latestNumber + 1, 5, '0', STR_PAD_LEFT);
        }

        return "PP/WST-$yearMonth-$newNoBooking";
    }

    public function bis()
    {
        return $this->belongsTo(Bis::class, 'bis_id');
    }

    public function tujuans()
    {
        return $this->belongsTo(Tujuan::class, 'tujuan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
