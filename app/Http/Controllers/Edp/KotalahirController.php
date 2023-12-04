<?php

namespace App\Http\Controllers\Edp;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kotalahir;
use Illuminate\Http\Request;

class KotalahirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $kotalahirs = Kotalahir::paginate(10, ['*'], 'page', $page);

        $search = $request->input('search');
        $kotalahirs = Kotalahir::where('tempat_lahir', 'like', '%'.$request->search.'%')
        ->orWhere('prov', 'like', '%'.$request->search.'%')
        ->paginate(10);

        return view('admin.kotalahir.index', compact('kotalahirs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kotalahir  $kotalahir
     * @return \Illuminate\Http\Response
     */
    public function show(Kotalahir $kotalahir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kotalahir  $kotalahir
     * @return \Illuminate\Http\Response
     */
    public function edit(Kotalahir $kotalahir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Kotalahir  $kotalahir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kotalahir $kotalahir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kotalahir  $kotalahir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kotalahir $kotalahir)
    {
        //
    }
}
