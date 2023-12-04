<?php

namespace App\Http\Controllers\Operasi;

use App\Models\User;
use App\Models\Admin\Posisi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Operasi\Spjmasuk;
use App\Models\Operasi\Spjkeluar;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SpjmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perpage') ?? 20;
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $spjmasuks = Spjmasuk::when($search, function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    // Add your search conditions here
                });
            })->when($startDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tgl_masuk', [$startDate, $endDate]);
        })->paginate($perPage);

        // Menghitung total kilometer
         $totalKm = Spjmasuk::sum('kmmasuk') - Spjkeluar::sum('kmkeluar');
         $totalBiaya = Spjmasuk::sum('biaya_bbm')+Spjmasuk::sum('uang_makan')+Spjmasuk::sum('uang_makan')+
                       Spjmasuk::sum('biaya_tol') + Spjmasuk::sum('parkir') + Spjmasuk::sum('biaya_lain');

        return view('operasi.spjmasuk.index', compact('spjmasuks', 'totalKm', 'totalBiaya'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $spjkeluars = Spjkeluar::all();
        $posisis = Posisi::all();
        $user = User::all();
        $roles = Role::where('name', '<>', 'super admin')->get();

        return view('operasi.spjmasuk.create', compact('spjkeluars','posisis','user','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nospj_id' => 'required',
            'tgl_masuk' => 'nullable',
            'kmmasuk' => 'nullable',
            'biaya_bbm' => 'nullable',
            'uang_makan' => 'nullable',
            'biaya_tol' => 'nullable',
            'parkir' => 'nullable',
            'biaya_lain' => 'nullable',
            'keterangan_spjmasuk' => 'nullable',
        ]);

        $userId = Auth::id();

         // Cek apakah posisi adalah Bis Setor
        if ($request->posisi_id == 3) {
            // Set posisi_id di tabel spjkeluars menjadi 3 (Bis Setor)
            $spjKeluar = Spjkeluar::find($request->nospj_id);
            $spjKeluar->posisi_id = 3;
            $spjKeluar->save();
        }

        // Check if a record with the same nospj_id already exists
        $nospjId = $request->input('nospj_id');
        $existingSpjmasuk = Spjmasuk::where('nospj_id', $nospjId)->first();

        if ($existingSpjmasuk) {
            // Display a warning if a duplicate nospj_id is found
            return back()->with('error', 'Nomor SPJ Keluar sudah ada dalam SPJ Masuk!');
        }



        $spjmasuk = new Spjmasuk();

        $spjmasuk->nospj_id = $request->input('nospj_id');
        $spjmasuk->tgl_masuk = $request->input('tgl_masuk');
        $spjmasuk->kmmasuk = $request->input('kmmasuk');
        $spjmasuk->biaya_bbm = $request->input('biaya_bbm');
        $spjmasuk->uang_makan = $request->input('uang_makan');
        $spjmasuk->biaya_tol = $request->input('biaya_tol');
        $spjmasuk->parkir = $request->input('parkir');
        $spjmasuk->biaya_lain = $request->input('biaya_lain');
        $spjmasuk->keterangan_spjmasuk = $request->input('keterangan_spjmasuk');
        $spjmasuk->user_id = $userId;

        $spjmasuk->save();

        // Redirect to the desired page upon successful insertion
        return redirect()->route('spj-masuk.index')->with('success', 'SPJ Masuk berhasil disimpan.');
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
        $spjmasuk = Spjmasuk::findOrFail($id);

        $spjkeluars = Spjkeluar::all();
        $user = User::all();
        $roles = Role::where('name', '<>', 'super admin')->get();

        return view('operasi.spjmasuk.edit', compact('spjmasuk', 'spjkeluars', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'nospj_id' => 'nullable', // Remove 'required'
            'tgl_masuk' => 'required|date',
            'kmmasuk' => 'nullable',
            'biaya_bbm' => 'nullable',
            'uang_makan' => 'nullable',
            'biaya_tol' => 'nullable',
            'parkir' => 'nullable',
            'biaya_lain' => 'nullable',
            'keterangan_spjmasuk' => 'nullable',
        ]);

        $userId = Auth::id();

        // Find the SpjMasuk record by its ID
        $spjmasuk = Spjmasuk::with('spjkeluars')->findOrFail($id);

        $spjmasuk->nospj_id = $request->input('nospj_id');
        $spjmasuk->tgl_masuk = $request->input('tgl_masuk');
        $spjmasuk->kmmasuk = $request->input('kmmasuk');
        $spjmasuk->biaya_bbm = $request->input('biaya_bbm');
        $spjmasuk->uang_makan = $request->input('uang_makan');
        $spjmasuk->biaya_tol = $request->input('biaya_tol');
        $spjmasuk->parkir = $request->input('parkir');
        $spjmasuk->biaya_lain = $request->input('biaya_lain');
        $spjmasuk->keterangan_spjmasuk = $request->input('keterangan_spjmasuk');
        $spjmasuk->user_id = $userId;

        // Save the updated SpjMasuk record
        $spjmasuk->save();

        // Redirect to the desired page upon successful update
        return redirect()->route('spj-masuk.index')->with('success', 'SPJ Masuk berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
