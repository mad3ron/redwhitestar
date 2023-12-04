<?php

namespace App\Http\Controllers\Edp;

use App\Models\Admin\Kota;
use App\Models\Admin\Rute;
use Illuminate\Http\Request;
use App\Models\Admin\Tarifpnp;
use App\Models\Admin\Poschecker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TarifpnpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perpage', 10);

        $query = DB::table('tarifpnps')
            ->join('rutes', 'tarifpnps.rute_id', '=', 'rutes.id')
            ->join('poscheckers', 'tarifpnps.poschecker_id', '=', 'poscheckers.id')
            ->join('kotas', 'tarifpnps.kota_id', '=', 'kotas.id')
            ->select(
                'tarifpnps.id as id',
                'tarifpnps.rute_id as rute_id',
                'rutes.name as name',
                'rutes.namarute as namarute',
                'tarifpnps.poschecker_id as poschecker_id',
                'poscheckers.kodepos as kodepos',
                'poscheckers.namapos as namapos',
                'tarifpnps.kota_id as kota_id',
                'kotas.kota as kota',
                'tarifpnps.tarif as tarif',
                'tarifpnps.tabri as tabri',
                'tarifpnps.status as status',
                'tarifpnps.keterangan as keterangan'
            );

        if ($search) {
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->where('rutes.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('poscheckers.kodepos', 'LIKE', '%' . $search . '%')
                    ->orWhere('poscheckers.namapos', 'LIKE', '%' . $search . '%')
                    ->orWhere('kotas.kota', 'LIKE', '%' . $search . '%')
                    ->orWhere('tarifpnps.tarif', 'LIKE', '%' . $search . '%')
                    ->orWhere('tarifpnps.tabri', 'LIKE', '%' . $search . '%')
                    ->orWhere('tarifpnps.status', 'LIKE', '%' . $search . '%')
                    ->orWhere('tarifpnps.keterangan', 'LIKE', '%' . $search . '%');
            });
        }

        $tarifpnps = $query->paginate($perPage);

        return view('admin.tarifpnp.index', compact('tarifpnps'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rutes = Rute::all();
        $poscheckers = Poschecker::all();
        $kotas = Kota::all();

        return view('admin.tarifpnp.create', compact('rutes', 'poscheckers','kotas'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validasi data yang diterima
    $validatedData = $request->validate([
        'rute_id' => 'required',
        'poschecker_id' => 'required',
        'kota_id' => 'required',
        'tarif' => 'required',
        'tabri' => 'required',
        'status' => 'required',
        'keterangan' => 'nullable',
    ]);

    // Simpan data ke dalam database
    $tarifpnp = new Tarifpnp;
    $tarifpnp->rute_id = $request->input('rute_id');
    $tarifpnp->poschecker_id = $request->input('poschecker_id');
    $tarifpnp->kota_id = $request->input('kota_id');
    $tarifpnp->tarif = $request->input('tarif');
    $tarifpnp->tabri = $request->input('tabri');
    $tarifpnp->status = $request->input('status');
    $tarifpnp->keterangan = $request->input('keterangan');
    $tarifpnp->save();

    // Redirect atau memberikan respons sesuai kebutuhan aplikasi Anda
    return redirect('/tarifpnps')->with('success', 'Data tarifpnp berhasil disimpan.');
}


    /**
     * Display the specified resource.
     */
    public function show(Tarifpnp $tarifpnp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarifpnp $tarifpnp)
    {
        $rutes = Rute::all();
        $poscheckers = Poschecker::all();
        $kotas = Kota::all();

        return view('admin.tarifpnp.edit', compact('tarifpnp', 'rutes', 'poscheckers','kotas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarifpnp $tarifpnp)
    {
        $request->validate([
            'rute_id' => 'required',
            'poschecker_id' => 'required',
            'kota_id' => 'required',
            'tarif' => 'required|numeric',
            'tabri' => 'required|numeric',
            'status' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        $tarifpnp->update($request->all());

        return redirect()->route('tarifpnps.index')->with('success', 'Tarifpnp berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarifpnp $tarifpnp)
    {
        $tarifpnp->delete();

        return redirect()->route('tarifpnps.index')->with('success', 'Tarifpnp berhasil dihapus.');
    }

}
