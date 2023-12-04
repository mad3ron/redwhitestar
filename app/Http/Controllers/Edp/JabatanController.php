<?php

namespace App\Http\Controllers\Edp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Edp\JabatanRequest;
use App\Models\Admin\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jabatans = Jabatan::where('name', 'like', '%'.$search.'%')
        ->orWhere('kodejab', 'like', '%'.$search.'%')
        ->paginate(10);

        return view('admin.jabatan.index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JabatanRequest $request)
    {
        Jabatan::create($request->validated());

        return redirect()->route('jabatans.index')->with('success', 'Jabatan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        return view('admin.jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|unique:jabatans,name,' . $jabatan->id,
            'kodejab' => 'required|string|min:3',
        ]);

        $jabatan->update($validatedData);

        return redirect()->route('jabatans.index')->with('success', 'Jabatan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('jabatans')->where('id', $id)->delete();

        return redirect()->route('jabatans.index')->with('success', 'Jabatan deleted successfully');
    }
}
