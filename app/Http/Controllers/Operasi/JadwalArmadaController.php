<?php

namespace App\Http\Controllers\Operasi;

use App\Models\User;
use App\Models\Admin\Bis;
use App\Models\Admin\Posisi;
use Illuminate\Http\Request;
use App\Models\Cso\Pemesanan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Operasi\JadwalArmada;
use Illuminate\Support\Facades\Auth;

class JadwalArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tanggal = $request->input('tanggal');
        $per_page = $request->input('per_page') ?? 10;

        $jadwals = JadwalArmada::with('bis')->where(function ($query) use ($search, $tanggal) {
            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->orWhereHas('bis', function ($query) use ($search) {
                        $query->where('nobody', 'like', '%'.$search.'%');
                    })->orWhereHas('pemesanans', function ($query) use ($search) {
                        $query->where('nama_pemesan', 'like', '%'.$search.'%');
                    })->orWhereHas('posisis', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    });
                });
            }
            if ($tanggal) {
                $query->where('tanggal', $tanggal);
            }
        })->paginate($per_page);

         // Hitung total bis tersedia
         $totalBisTersedia = Bis::count();

         $totals = JadwalArmada::select('posisi_id', DB::raw('COUNT(*) as total'))
        ->whereHas('posisis', function ($query) use ($tanggal) {
            $query->where('tanggal', $tanggal);
        })
        ->groupBy('posisi_id')
        ->get()
        ->map(function ($jadwals) {
            return [
                'posisi' => $jadwals->posisis->name,
                'total' => $jadwals->total,
            ];
        });

        return view('operasi.jadwal.index', compact('jadwals', 'tanggal', 'search', 'per_page', 'totalBisTersedia', 'totals'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bis = Bis::all();
        $posisis = Posisi::all();
        $pemesanans = Pemesanan::all();
        $user = User::all();
        $roles = Role::where('name', '<>', 'super admin')->get();

        return view('operasi.jadwal.create', compact('bis', 'posisis','pemesanans', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
 * Store a newly created resource in storage.
 */
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'tanggal' => 'required|date',
            'bis_id' => 'required|integer',
            'posisi_id' => 'required|integer',
            'pemesanan_id' => 'nullable|integer',
            'keterangan' => 'nullable',
        ]);

        $userId = Auth::id();

        $jadwals = new JadwalArmada;
        $jadwals->tanggal = $request->input('tanggal');
        $jadwals->bis_id = $request->input('bis_id');
        $jadwals->posisi_id = $request->input('posisi_id');
        $jadwals->pemesanan_id = $request->input('pemesanan_id');
        $jadwals->keterangan = $request->input('keterangan', '');
        $jadwals->user_id = $userId;

        // Menyimpan data ke database
        $jadwals->save();

        // Redirect ke halaman index atau halaman lain yang sesuai
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil disimpan!');
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
        $jadwals = JadwalArmada::findOrFail($id);
        $bis = Bis::all();
        $posisis = Posisi::all();
        $pemesanans = Pemesanan::all();
        $user = User::all();
        $roles = Role::where('name', '<>', 'super admin')->get();

        return view('operasi.jadwal.edit', compact('jadwals','bis', 'posisis','pemesanans', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input dari pengguna
        $request->validate([
            'tanggal' => 'required|date',
            'bis_id' => 'required|integer',
            'posisi_id' => 'required|integer',
            'pemesanan_id' => 'required|integer',
            'keterangan' => 'nullable',
        ]);

        try {
            $jadwals = JadwalArmada::find($id);

            if (!$jadwals) {
                return redirect()->route('jadwal.index')->with('error', 'Jadwal tidak ditemukan.');
            }

            $jadwals->tanggal = $request->input('tanggal');
            $jadwals->bis_id = $request->input('bis_id');
            $jadwals->posisi_id = $request->input('posisi_id');
            $jadwals->pemesanan_id = $request->input('pemesanan_id');
            $jadwals->keterangan = $request->input('keterangan', '');

            // Perbarui data di database
            $jadwals->update();

            return redirect()->route('jadwal.index')->with('success', 'Data SPJ Keluar berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('jadwal.edit', $id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
