<?php

namespace App\Http\Controllers\Edp;

use App\Models\Admin\Bis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BisRekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         // menghitung jumlah bus
         $totalBis = DB::table('bis')->count();
         $rkBuses = Bis::where('merk', 'HINO RK')->count();
         $rktBuses = Bis::where('merk', 'HINO RKT')->count();
         $rgBuses = Bis::where('merk', 'HINO RG')->count();
         $rkjBuses = DB::table('bis')->where('merk', 'HINO RKJ260')->count();

         // menghitung persentase jenis
         $rkjpersen = round(($rkjBuses / $totalBis) * 100, 2);

         // menyimpan variabel-variabel di atas ke dalam session
         $request->session()->put('totalBiss', $totalBis);
         $request->session()->put('rktBuses', $rktBuses);
         $request->session()->put('rgBuses', $rgBuses);
         $request->session()->put('rkjBuses', $rkjBuses);

        $search = $request->query('search');

        $totalBis = DB::table('bis')
            ->rightJoin('rutes', 'bis.rute_id', '=', 'rutes.id')
            ->leftJoin('pools', 'rutes.pool_id', '=', 'pools.id')
            ->select(DB::raw('SUM(bis.nobody) as total_bis'))
            ->where(function ($query) use ($search) {
                $query->where('pools.nama_pool', 'LIKE', '%'.$search.'%')
                    ->orWhere('rutes.koderute', 'LIKE', '%'.$search.'%')
                    ->orWhere('rutes.namarute', 'LIKE', '%'.$search.'%');
            })
            ->first()->total_bis;

        $results = DB::table('bis')
            ->rightJoin('rutes', 'bis.rute_id', '=', 'rutes.id')
            ->leftJoin('pools', 'rutes.pool_id', '=', 'pools.id')
            ->select('pools.id as pool_id', 'pools.nama_pool as pool', 'rutes.id as rute_id', 'rutes.koderute as rute', 'rutes.namarute', DB::raw('SUM(bis.nobody) as totalBis'))
            ->groupBy('pools.id', 'pools.nama_pool', 'rutes.id', 'rutes.koderute', 'rutes.namarute')
            ->orderBy('pools.id', 'asc')
            ->orderBy('rutes.id', 'asc');

        if ($search) {
            $results->where(function ($query) use ($search) {
                $query->where('pools.nama_pool', 'LIKE', '%'.$search.'%')
                    ->orWhere('rutes.koderute', 'LIKE', '%'.$search.'%')
                    ->orWhere('rutes.namarute', 'LIKE', '%'.$search.'%');
            });
        }

        $results = $results->paginate(10);
        $perPage = $results->perPage();
        $results->appends(['search' => $search]);


        $poolResults = DB::table('bis')
            ->rightJoin('rutes', 'bis.rute_id', '=', 'rutes.id')
            ->rightJoin('pools', 'rutes.pool_id', '=', 'pools.id')
            ->select('pools.id as pool_id', 'pools.nama_pool as pool', DB::raw('count(bis.nobody) as jml_bis'))
            ->groupBy('pools.id', 'pools.nama_pool')
            ->orderBy('pools.id')
            ->get();

        return view('admin.bis_rekap.index', compact('results', 'poolResults', 'totalBis', 'search', 'perPage'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
