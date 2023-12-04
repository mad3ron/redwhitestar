<?php

namespace App\Http\Controllers\Edp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Edp\PerusahaanRequest;
use App\Models\Admin\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perusahaans = Perusahaan::all();
        $page = $request->input('page', 1);
        $perusahaans = Perusahaan::paginate(20, ['*'], 'page', $page);

        $search = $request->input('search');
        $perusahaans = Perusahaan::where('id', 'like', '%'.$request->search.'%')
        ->orWhere('name', 'like', '%'.$request->search.'%')
        ->paginate(20);

        return view('admin.perusahaan.index', compact('perusahaans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerusahaanRequest $request)
    {
        Perusahaan::create($request->validated());

        return redirect()->route('perusahaans.index')->with('message', 'Perusahaan telah di Input.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $perusahaan)
    {
        return view('admin.perusahaan.edit', compact('perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        $perusahaan->update([
            'name' => $request->name,
        ]);

        return redirect()->route('perusahaans.index')->with('message', 'Perusahan telah di input.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('perusahaans')->where('id', $id)->delete();

        return redirect()->route('perusahaans.index')->with('success', 'Perusahaan deleted successfully');
    }
}
