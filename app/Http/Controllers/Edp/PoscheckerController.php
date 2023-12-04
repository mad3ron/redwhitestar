<?php

namespace App\Http\Controllers\Edp;

use Illuminate\Http\Request;
use App\Models\Admin\Poschecker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Edp\PoscheckerRequest;

class PoscheckerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $per_page = $request->input('per_page', 10);

        $query = Poschecker::query();

        if ($search) {
            $query->where('kodepos', 'LIKE', '%' . $search . '%')
                ->orWhere('namapos', 'LIKE', '%' . $search . '%')
                ->orWhere('wilayah', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        }

        $poscheckers = $query->paginate($per_page);

        return view('admin.poschecker.index', compact('poscheckers', 'search', 'per_page'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.poschecker.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PoscheckerRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $poschecker = Poschecker::create($validatedData);
            return redirect()->route('poscheckers.index')->with('success', 'Poschecker created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create poschecker. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Poschecker $poschecker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $poschecker = Poschecker::findOrFail($id);

        return view('admin.poschecker.edit', compact('poschecker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PoscheckerRequest $request, $id)
    {
        $validatedData = $request->validated();

        // Cari poschecker berdasarkan ID
        $poschecker = Poschecker::findOrFail($id);

        // Update data poschecker dengan data yang valid
        $poschecker->update($validatedData);

        // Setelah poschecker berhasil diupdate, redirect ke halaman index
        return redirect()->route('poscheckers.index')->with('success', 'Pos updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('poscheckers')->where('id', $id)->delete();

        return redirect()->route('poscheckers.index')->with('success', 'Pos Checker deleted successfully');
    }
}
