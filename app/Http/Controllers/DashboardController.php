<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('perPage', 10);

        $rekapPools = DB::table('pools')
            ->select('pools.id AS id', 'pools.name AS namapool', DB::raw('COUNT(bis.nobody) AS bisada'))
            ->leftJoin('rutes', 'rutes.pool_id', '=', 'pools.id')
            ->leftJoin('bis', 'bis.rute_id', '=', 'rutes.id')
            ->groupBy('pools.id', 'pools.name');

        // Pengecekan jika ada input pencarian
        if ($search) {
            $rekapPools->where('pools.name', 'LIKE', "%$search%");
        }

        $rekapPools = $rekapPools->paginate($perPage);

        $user = Auth::user();

        $query = Post::with('user');

        // Jika ada pencarian, tambahkan kondisi pencarian ke query
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $posts = $query->paginate($perPage);

        // Mengambil data pendapatan per bulan per pool
        $pendapatans = DB::table('pend_harians')
        ->join('rutes', 'pend_harians.rute_id', '=', 'rutes.id')
        ->join('pools', 'rutes.pool_id', '=', 'pools.id')
        ->select(
            'rutes.pool_id as pool_id',
            'pools.name as namapool',
            DB::raw("DATE_FORMAT(pend_harians.tgl_pend, '%Y %m') as bulan"),
            DB::raw("SUM(pend_harians.pend_ops) as pend_ops"),
            DB::raw("SUM(pend_harians.ang_kwa) as ang_kwa"),
            DB::raw("SUM(pend_harians.pend_bersih) as pend_bersih")
        )
        ->groupBy('rutes.pool_id', 'pools.name', DB::raw("DATE_FORMAT(pend_harians.tgl_pend, '%Y %m')"))
        ->get();

        $labels = $pendapatans->pluck('bulan')->unique()->toJson();

        // Menghitung Jumlah bulan yang ada di database
        $jmlBln = DB::table('pend_harians')
        ->select(DB::raw('COUNT(DISTINCT DATE_FORMAT(tgl_pend, "%Y-%m")) as jumlah_bulan'))
        ->value('jumlah_bulan');

        $totalPendOps = DB::table('pend_harians')->sum('pend_bersih');
        $rataPendbersih = $totalPendOps / $jmlBln;;

        // Mengambil data pendapatan per bulan dari tabel pend_harians untuk grafik
        $pendapatanData = DB::table('pend_harians')
        ->select(DB::raw("DATE_FORMAT(tgl_pend, '%Y-%m') AS bulan"), DB::raw("SUM(pend_bersih) AS pend_bersih"))
        ->groupBy('bulan')
        ->get();

        // Menghitung rata-rata Total Pend Bersih per Bulan
        $PendPebulan = DB::table('pend_harians')
        ->select(DB::raw("DATE_FORMAT(tgl_pend, '%Y-%m') AS bulan"), DB::raw("AVG(pend_bersih) AS rata_rata"))
        ->groupBy('bulan')
        ->get();

        // Jumlah Bisy Yang Ada
        $jmlArmada = DB::table('bis')
            ->rightJoin('rutes', 'bis.rute_id', '=', 'rutes.id')
            ->rightJoin('pools', 'rutes.pool_id', '=', 'pools.id')
            ->select('pools.id as pool_id', 'pools.name as pool', DB::raw('count(bis.nobody) as jml_bis'))
            ->groupBy('pools.id', 'pools.name')
            ->orderBy('pools.id')
            ->get();


        // Ambil waktu terakhir diperbarui dari tabel pend_harians
        $updatePend = DB::table('pend_harians')
        ->orderByDesc('updated_at')
        ->value('updated_at');

    // Check if there is updated data
    if ($updatePend) {
        // Convert the string time to a Carbon object
        $updatePendAt = Carbon::parse($updatePend);

        // Format the time as desired
        $formattedLastUpdated = $updatePendAt->diffForHumans();

        // Pass the formatted last updated time to the view
        return view('dashboard', compact(
            'rekapPools',
            'posts',
            'search',
            'perPage',
            'user',
            'pendapatans',
            'labels',
            'jmlBln',
            'totalPendOps',
            'PendPebulan',
            'rataPendbersih',
            'formattedLastUpdated',
            'pendapatanData',
            'jmlArmada'
        ));
    } else {
        // No updated data found
        $formattedLastUpdated = 'No data found';
        return view('dashboard', compact(
            'rekapPools',
            'posts',
            'search',
            'perPage',
            'user',
            'pendapatans',
            'labels',
            'jmlBln',
            'totalPendOps',
            'PendPebulan',
            'rataPendbersih',
            'formattedLastUpdated',
            'pendapatanData',
            'jmlArmada',
        ));
    }

    }


}
