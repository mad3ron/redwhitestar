<?php

namespace App\Http\Controllers\Edp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Edp\RuteRequest;
use App\Models\Admin\Pool;
use App\Models\Admin\Product;
use App\Models\Admin\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $per_page = $request->input('per_page');

        $rutes = Rute::leftJoin('pools', 'rutes.pool_id', '=', 'pools.id')
            ->leftJoin('products', 'rutes.product_id', '=', 'products.id')
            ->select('rutes.id', 'rutes.koderute', 'rutes.namarute', 'rutes.jenis', 'rutes.stdrit', 'rutes.pool_id', 'rutes.product_id', 'rutes.status', 'rutes.created_at', 'rutes.updated_at')
            ->where(function ($query) use ($search) {
                $query->where('pools.nama_pool', 'like', '%' . $search . '%') // Menggunakan relasi "pool"
                    ->orWhere('rutes.koderute', 'like', '%' . $search . '%');
            })
            ->orderBy('pools.nama_pool') // Menggunakan relasi "pool"
            ->orderBy('rutes.koderute')
            ->paginate($per_page);

        return view('admin.rute.index', compact('rutes'));
    }



    public function showPengemudiByRute($ruteId)
    {
        // ambil data rute dengan id=$ruteId
        $rute = Rute::find($ruteId);

        // ambil data pengemudi yang berhubungan dengan rute tersebut
        $pengemudis = $rute->pengemudis;

        // tampilkan data pengemudi
        return view('admin.rute.index', compact('pengemudis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pools = Pool::all();
        $products = Product::all();

        return view('admin.rute.create', compact('pools', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'koderute'=> 'required',
            'namarute'=> 'required',
            'jenis'=> 'required',
            'stdrit'=> 'required',
            'pool_id'=> 'required',
            'product_id'=> 'required',
            'status'=> 'required',
        ]);

        $rute = new Rute();
        $rute->koderute = $request->input('koderute');
        $rute->namarute = $request->input('namarute');
        $rute->jenis = $request->input('jenis');
        $rute->stdrit = $request->input('stdrit');
        $rute->pool_id = $request->input('pool_id');
        $rute->product_id = $request->input('product_id');
        $rute->status = $request->input('status');

        $rute->save();

        return redirect()->route('rute.index')->with('success', 'Rute created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function show(Rute $rute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function edit(Rute $rute)
    {
        $pools = Pool::all();
        $products = Product::all();

        return view('admin.rute.edit', compact('rute', 'pools', 'products'));
        // dd($rute->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'koderute' => 'required',
            'namarute' => 'required',
            'jenis' => 'required',
            'stdrit' => 'required',
            'pool_id' => 'required',
            'product_id' => 'required',
            'status' => 'required',
        ]);

        $rute = Rute::find($id);

        if (!$rute) {
            return redirect()->route('rute.index')->with('error', 'Rute not found.');
        }

        $rute->koderute = $request->input('koderute');
        $rute->namarute = $request->input('namarute');
        $rute->jenis = $request->input('jenis');
        $rute->stdrit = $request->input('stdrit');
        $rute->pool_id = $request->input('pool_id');
        $rute->product_id = $request->input('product_id');
        $rute->status = $request->input('status');

        $rute->save();

        return redirect()->route('rute.index')->with('success', 'Rute updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('rutes')->where('id', $id)->delete();

        return redirect()->route('rute.index')->with('success', 'Rute deleted successfully');
    }
}
