<?php

namespace App\Http\Controllers\Cso;

use App\Models\Admin\Bis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Cso\Pemesanan;

class BisbookingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tgl_brkt = $request->input('tgl_brkt');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $totalBis = DB::table('bis')->count();
        $tgl_brkt = request('tgl_brkt');
        $tgl_pulang = request('tgl_pulang');
        $durasi = strtotime($tgl_pulang) - strtotime($tgl_brkt); // Menghitung selisih waktu dalam detik
        $durasi = $durasi / (60 * 60 * 24);
        $bookingsByDate = Pemesanan::whereBetween('tgl_brkt', [$startDate, $endDate])->get();

        $bookings = $this->getBookings($search, $tgl_brkt);
        return view('cso.booking.index', compact('bookings','tgl_brkt','tgl_pulang','durasi','totalBis','bookingsByDate'));
    }
    private function getBookings($search, $tgl_brkt)
{
    $bookings = Bis::select('bis.nobody', 'bis.nopolisi', 'rutes.koderute', 'pools.nama_pool', 'pemesanans.nama_pemesan', 'pemesanans.phone', 'tujuans.tujuan', 'pemesanans.tgl_brkt', 'pemesanans.tgl_pulang', 'spjkeluars.tgl_klr', 'pengemudis.nopengemudi','biodatas.nama', 'kondekturs.nokondektur','pemesanans.status')
        ->join('pools', 'bis.pool_id', '=', 'pools.id')
        ->join('rutes', function($join) {
            $join->on('bis.rute_id', '=', 'rutes.id')
                ->on('rutes.pool_id', '=', 'pools.id');
        })
        ->leftJoin('spjkeluars', 'bis.id', '=', 'spjkeluars.bis_id')
        ->leftJoin('pemesanans', 'spjkeluars.nopesan_id', '=', 'pemesanans.id')
        ->leftJoin('tujuans', 'pemesanans.tujuan_id', '=', 'tujuans.id')
        ->leftJoin('pengemudis', 'spjkeluars.nopengemudi_id', '=', 'pengemudis.id')
        ->leftJoin('biodatas', 'pengemudis.nik', '=', 'biodatas.nik')
        ->leftJoin('kondekturs', 'spjkeluars.nokondektur_id', '=', 'kondekturs.id');

    if ($search) {
        $bookings->where(function ($query) use ($search) {
            $query->where('bis.nobody', 'LIKE', "%$search%")
                ->orWhere('bis.nopolisi', 'LIKE', "%$search%")
                ->orWhere('rutes.koderute', 'LIKE', "%$search%")
                ->orWhere('pools.nama_pool', 'LIKE', "%$search%")
                ->orWhere('pemesanans.nama_pemesan', 'LIKE', "%$search%")
                ->orWhere('pemesanans.phone', 'LIKE', "%$search%")
                ->orWhere('tujuans.tujuan', 'LIKE', "%$search%")
                ->orWhere('pemesanans.tgl_brkt', 'LIKE', "%$search%")
                ->orWhere('pemesanans.tgl_pulang', 'LIKE', "%$search%")
                ->orWhere('spjkeluars.tgl_klr', 'LIKE', "%$search%")
                ->orWhere('pengemudis.nopengemudi', 'LIKE', "%$search%")
                ->orWhere('biodatas.nama', 'LIKE', "%$search%")
                ->orWhere('kondekturs.nokondektur', 'LIKE', "%$search%")
                ->orWhere('pemesanans.status', 'LIKE', "%$search%");
        });
    }

    if ($tgl_brkt) {
        $tgl_brkt = date('d-m-Y', strtotime(str_replace('/', '-', $tgl_brkt)));
        $bookings->whereDate('pemesanans.tgl_brkt', $tgl_brkt);
    }


    return $bookings->paginate(10);
}


    // public function index(Request $request)
    // {
    //     $search = $request->input('search');
    //     $tgl_brkt = $request->input('tgl_brkt');
    //     $per_page = $request->input('per_page') ?? 10;
    //     $totalArmada = Bis::count();

    //     $bookings = Bis::select('bis.nobody', 'bis.nopolisi', 'rutes.koderute', 'pools.nama_pool',
    //             'pemesanans.nama_pemesan', 'pemesanans.phone', 'tujuans.tujuan', 'pemesanans.tgl_brkt',
    //             'pemesanans.tgl_pulang', 'spjkeluars.tgl_klr', 'pengemudis.nopengemudi',
    //             'biodatas.nama', 'kondekturs.nokondektur','pemesanans.status')
    //         ->join('pools', 'bis.pool_id', '=', 'pools.id')
    //         ->join('rutes', function ($join) {
    //             $join->on('bis.rute_id', '=', 'rutes.id')
    //                 ->on('rutes.pool_id', '=', 'pools.id');
    //         })
    //         ->leftJoin('spjkeluars', 'bis.id', '=', 'spjkeluars.bis_id')
    //         ->leftJoin('pemesanans', 'spjkeluars.nopesan_id', '=', 'pemesanans.id')
    //         ->leftJoin('tujuans', 'pemesanans.tujuan_id', '=', 'tujuans.id')
    //         ->leftJoin('pengemudis', 'spjkeluars.nopengemudi_id', '=', 'pengemudis.id')
    //         ->leftJoin('biodatas', 'pengemudis.nik', '=', 'biodatas.nik')
    //         ->leftJoin('kondekturs', 'spjkeluars.nokondektur_id', '=', 'kondekturs.id');

    //     if ($search) {
    //         $bookings->where(function ($query) use ($search) {
    //             $query->where('bis.nobody', 'LIKE', "%$search%")
    //                 ->orWhere('bis.nopolisi', 'LIKE', "%$search%")
    //                 ->orWhere('rutes.koderute', 'LIKE', "%$search%")
    //                 ->orWhere('pools.nama_pool', 'LIKE', "%$search%")
    //                 ->orWhere('pemesanans.nama_pemesan', 'LIKE', "%$search%")
    //                 ->orWhere('pemesanans.phone', 'LIKE', "%$search%")
    //                 ->orWhere('tujuans.tujuan', 'LIKE', "%$search%")
    //                 ->orWhere('pemesanans.tgl_brkt', 'LIKE', "%$search%")
    //                 ->orWhere('pemesanans.tgl_pulang', 'LIKE', "%$search%")
    //                 ->orWhere('spjkeluars.tgl_klr', 'LIKE', "%$search%")
    //                 ->orWhere('pengemudis.nopengemudi', 'LIKE', "%$search%")
    //                 ->orWhere('biodatas.nama', 'LIKE', "%$search%")
    //                 ->orWhere('kondekturs.nokondektur', 'LIKE', "%$search%")
    //                 ->orWhere('pemesanans.status', 'LIKE', "%$search%");
    //         });
    //     }

    //     if ($tgl_brkt) {
    //         $bookings->whereDate('pemesanans.tgl_brkt', $tgl_brkt);
    //     }

    //     $bookings = $bookings->paginate($per_page);

    //     return view('cso.booking.index', compact('bookings', 'tgl_brkt'));
    // }



}
