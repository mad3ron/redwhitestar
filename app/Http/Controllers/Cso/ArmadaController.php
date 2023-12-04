<?php

namespace App\Http\Controllers\Cso;

use App\Models\Admin\Armada;
use App\Models\Admin\Tujuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class ArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $per_page = $request->input('per_page') ?? 20;

        $armadas = Armada::when($searchQuery, function ($query, $searchQuery) {
            return $query->where('jenis_armada', 'like', '%'.$searchQuery.'%');
        });

        $armadas = $armadas->paginate($per_page);

        return view('admin.armada.index', compact('armadas', 'searchQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.armada.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'jenis_armada' => 'required',
    //         'seat' => 'required',
    //         'descripsi' => 'required',
    //         'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ], [
    //         'armada.required' => 'Armada double.',
    //     ]);

    //     // Cek apakah data sudah ada dalam database
    //     $existingData = Tujuan::where('armada', $validatedData['armada'])->first();
    //     if ($existingData) {
    //         return redirect()->back()->with('error', 'Armada double: Data sudah ada.');
    //     }

    //     // Jika data tidak ada dalam database, simpan data
    //     Tujuan::create($validatedData);

    //     return redirect()->route('tujuan.index')->with('success', 'Data berhasil disimpan.');
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_armada' => 'required',
            'seat' => 'required',
            'descripsi' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah jenis armada sudah ada dalam database
        $existingArmada = Armada::where('jenis_armada', $validatedData['jenis_armada'])->first();

        if ($existingArmada) {
            return redirect()->back()->with('error', 'Armada dengan jenis yang sama sudah ada. Data tidak disimpan.');
        }

        $armada = new Armada();
        $armada->jenis_armada = $validatedData['jenis_armada'];
        $armada->seat = $validatedData['seat'];
        $armada->descripsi = $validatedData['descripsi'];

        if ($request->hasFile('photo')) {
            $fileName = $request->file('photo')->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('armada', $fileName, 'public');
            $armada->photo = $filePath;
        }

        $armada->save();

        return redirect()->route('armada.index')->with('success', 'Armada berhasil dibuat.');
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
        $armada = Armada::findOrFail($id);

        return view('admin.armada.edit', compact('armada'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang dikirimkan melalui formulir
        $validatedData = $request->validate([
            'jenis_armada' => 'required',
            'seat' => 'required',
            'descripsi' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Temukan data Armada berdasarkan ID
        $armada = Armada::findOrFail($id);

        // Update data dengan data yang sudah divalidasi
        $armada->jenis_armada = $validatedData['jenis_armada'];
        $armada->seat = $validatedData['seat'];
        $armada->descripsi = $validatedData['descripsi'];

        // Proses upload gambar jika ada perubahan
        if ($request->hasFile('photo')) {
            $fileName = $request->file('photo')->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('public/armada', $fileName);
            $armada->photo = $filePath;
        }

        // Simpan perubahan
        $armada->save();

        // Redirect ke halaman yang sesuai dengan kebutuhan Anda
        return redirect()->route('armada.index')->with('success', 'Armada updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $armada = Armada::findOrFail($id);
        $armada->delete();

        return redirect()->route('armada.index')->with('success', 'Armada deleted successfully.');
    }
}
