<?php

namespace App\Http\Controllers\Edp;

use App\Models\Admin\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Edp\KotaRequest;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $search = $request->input('search');

        $kotas = Kota::where('kota', 'like', '%' . $search . '%')
            ->paginate(10, ['*'], 'page', $page);

        return view('admin.kota.index', compact('kotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kota.create');
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
            'kota' => 'required',
        ]);

        Kota::create($request->all());

        return redirect()->route('kotas.index')
            ->with('success', 'Kota berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function show(Kota $kotas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function edit(Kota $kota)
    {
        return view('admin.kota.edit', compact('kota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function update(KotaRequest $request, Kota $kota)
    {
        $kota->update($request->validated());

        return redirect()->route('kotas.index')->with('message', 'Kota Update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('kotas')->where('id', $id)->delete();

        return redirect()->route('kotas.index')->with('success', 'Rute deleted successfully');
    }
}
