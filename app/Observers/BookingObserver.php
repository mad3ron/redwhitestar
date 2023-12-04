<?php

namespace App\Observers;

use App\Models\Cso\Booking;
use Illuminate\Support\Facades\DB;

class BookingObserver
{
    public function creating(Booking $booking)
    {
        $sequence = $booking->getSequence();
        $year = date('Y');
        $month = date('m');

        if ($sequence) {
            $number = $sequence->value;
            $newNumber = $number + 1;

            // Update nilai urutan di database
            DB::table('sequences')->where('name', 'booking_number_sequence')->update(['value' => $newNumber]);

            $booking->booking_number = "PP/WST/$year$month/$number";
        }
    }
}
