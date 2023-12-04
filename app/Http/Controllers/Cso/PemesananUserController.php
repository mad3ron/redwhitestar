<?php

namespace App\Http\Controllers\Cso;

use App\Models\User;
use App\Models\Admin\Armada;
use App\Models\Admin\Tujuan;
use Illuminate\Http\Request;
use App\Models\Cso\Pemesanan;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pool;
use Illuminate\Support\Facades\Auth;

class PemesananUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $pemesanan = $user->pemesanan;

        return view('cso.pemesan_user.pemesan', compact('user', 'biodata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $tujuans = Tujuan::all();
        $armadas = Armada::all();
        $pools = Pool::all();
        $roles = Role::where('name', '<>', 'super admin')->get(); // Ambil peran yang bukan super admin

        return view('cso.pemesan_user.pemesan', compact('users', 'tujuans', 'armadas', 'pools','roles'));
    }

    public function storeOrUpdate(Request $request)
    {
        // Mendapatkan objek pengguna yang saat ini masuk
        $user = auth()->user();

        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'tgl_brkt' => 'required|date',
            'tgl_pulang' => 'required|date',
            'jam_jemput' => 'required|date_format:H:i',
            'tujuan_id' => 'required|exists:tujuans,id',
            'armada_id' => 'required|exists:armadas,id',
            'pool_id' => 'required|exists:pools,id',
        ]);

        // Buat pemesanan baru dan isi dengan data dari formulir
        $pemesanan = new Pemesanan();
        $pemesanan->nama_pemesan = $request->input('nama_pemesan');
        $pemesanan->phone = $request->input('phone');
        $pemesanan->alamat = $request->input('alamat');
        $pemesanan->tgl_brkt = $request->input('tgl_brkt');
        $pemesanan->tgl_pulang = $request->input('tgl_pulang');
        $pemesanan->jam_jemput = $request->input('jam_jemput');
        $pemesanan->tujuan_id = $request->input('tujuan_id');
        $pemesanan->armada_id = $request->input('armada_id');
        $pemesanan->pool_id = $request->input('pool_id');
        $pemesanan->user_id = $user->id; // Menggunakan ID pengguna yang saat ini masuk
        $pemesanan->save();

        return redirect()->route('dashboard')->with('success', 'Pemesanan berhasil ditambahkan.');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
