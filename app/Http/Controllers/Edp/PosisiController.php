<?php

namespace App\Http\Controllers\Edp;

use App\Models\Admin\Posisi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Posisi::query();

        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('kodeposisi', 'LIKE', '%' . $search . '%');
        }

        $posisis = $query->paginate($perPage);

        return view('admin.posisi.index', compact('posisis', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posisi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kodeposisi' => 'required|string|max:255|unique:posisis,kodeposisi',
        ]);

        Posisi::create($request->all());

        return redirect()->route('posisis.index')->with('success', 'Posisi created successfully.');
    }

    public function edit(Posisi $posisi)
    {
        return view('admin.posisi.edit', compact('posisi'));
    }

    public function update(Request $request, Posisi $posisi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kodeposisi' => 'required|string|max:255|unique:posisis,kodeposisi,'.$posisi->id,
        ]);

        $posisi->update($request->all());

        return redirect()->route('posisis.index')->with('success', 'Posisi updated successfully.');
    }

    public function destroy(Posisi $posisi)
    {
        $posisi->delete();

        return redirect()->route('posisis.index')->with('success', 'Posisi deleted successfully.');
    }
}
