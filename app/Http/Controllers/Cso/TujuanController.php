<?php

namespace App\Http\Controllers\Cso;


use App\Models\Admin\Armada;
use App\Models\Admin\Tujuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TujuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $per_page = $request->input('per_page') ?? 20;

        $tujuans = Tujuan::when($searchQuery, function ($query, $searchQuery) {
            return $query->where('tujuan', 'like', '%'.$searchQuery.'%');
        });

        $tujuans = $tujuans->paginate($per_page);

        return view('admin.tujuan.index', compact('tujuans', 'searchQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $armadas = Armada::all();

        return view('admin.tujuan.create', compact('armadas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'armada_id' => 'required',
            'tujuan' => 'required',
            'pemakaian' => 'required',
            'harga_dasar' => 'required',
        ]);

        Tujuan::create($data); // Buat data baru menggunakan metode create

        return redirect()->route('tujuan.index')->with('success', 'Data berhasil disimpan.');
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
        $data = Tujuan::findOrFail($id);
        $armadas = Armada::all();

        return view('admin.tujuan.edit', compact('data', 'armadas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'armada_id' => 'required',
            'tujuan' => 'required',
            'pemakaian' => 'required',
            'harga_dasar' => 'required',
        ]);

        // Menggunakan metode findOrFail untuk mendapatkan objek Tujuan berdasarkan ID
        $tujuan = Tujuan::findOrFail($id);

        // Memperbarui atribut-atribut objek Tujuan dengan data yang diterima dari form
        $tujuan->armada_id = $data['armada_id'];
        $tujuan->tujuan = $data['tujuan'];
        $tujuan->pemakaian = $data['pemakaian'];
        $tujuan->harga_dasar = $data['harga_dasar'];

        // Menyimpan perubahan ke dalam database
        $tujuan->save();

        return redirect()->route('tujuan.index')->with('success', 'tujuan updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tujuan = Tujuan::findOrFail($id);
        $tujuan->delete();

        return redirect()->route('tujuan.index')->with('success', 'Tujuan deleted successfully.');
    }
}
