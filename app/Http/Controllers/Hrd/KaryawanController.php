<?php

namespace App\Http\Controllers\Hrd;

use App\Models\Hrd\Biodata;
use App\Models\Hrd\Karyawan;
use Illuminate\Http\Request;
use App\Models\Admin\Jabatan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 10; // Jumlah item per halaman
        $search = $request->input('search'); // Kata kunci pencarian

        $query = Karyawan::with(['biodata', 'jabatan'])
            ->orderBy('created_at', 'desc');

        $karyawans = $query;
        if (!empty($search)) {
            $karyawans->where(function($q) use ($search) {
                $q->where('nokaryawan', 'like', '%'.$search.'%')
                    ->orWhereHas('biodata', function($q) use ($search) {
                        $q->where('nik', 'like', '%'.$search.'%')
                        ->orWhere('nama', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('jabatan', function($q) use ($search) {
                        $q->where('name', 'like', '%'.$search.'%');
                    })
                    ->orWhere('tgl_kp', 'like', '%'.$search.'%');
            });
        }

        // Ambil data pengemudi dengan pagination
        $karyawans = $karyawans->paginate($perPage);

        return view('hrd.karyawan.index', compact('karyawans'));
    }

    public function searchNik(Request $request)
    {
        $query = $request->input('query');
        $nama = $request->input('nama');

        $suggestions = Biodata::where(function ($queryBuilder) use ($query, $nama) {
            $queryBuilder->where('nik', 'LIKE', "%$query%");

            if ($nama) {
                $queryBuilder->orWhere('nama', 'LIKE', "%$nama%");
            }
        })->take(10)->get(['nik', 'nama']);

        return response()->json(['data' => $suggestions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $biodatas = Biodata::all();
        $jabatans = Jabatan::all();
        $users = User::all();

        return view('hrd.karyawan.create', compact('biodatas', 'jabatans','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nokaryawan' => 'required|unique:karyawans',
            'nik' => 'required',
            'jabatan_id' => 'required',
            'user_id' => 'nullable',
            'tgl_kp' => 'nullable',
            'tgl_masuk' => 'nullable',
            'pendidikan' => 'nullable',
            'gol_darah' => 'nullable',
            'tinggi' => 'nullable',
            'nojamsostek' => 'nullable',
            'tgl_jamsos' => 'nullable',
            'password' => 'nullable',
            'status' => 'required',
            'keterangan' => 'nullable',
        ]);

        $karyawan = new Karyawan();
        $karyawan->nokaryawan = $request->input('nokaryawan');
        $karyawan->nik = $request->input('nik');
        $karyawan->jabatan_id = $request->input('jabatan_id');
        $karyawan->user_id = $request->input('user_id');
        $karyawan->tgl_kp = $request->input('tgl_kp');
        $karyawan->tgl_masuk = $request->input('tgl_masuk');
        $karyawan->pendidikan = $request->input('pendidikan');
        $karyawan->gol_darah = $request->input('gol_darah');
        $karyawan->tinggi = $request->input('tinggi');
        $karyawan->nojamsostek = $request->input('nojamsostek');
        $karyawan->tgl_jamsos = $request->input('tgl_jamsos');
        $karyawan->status = $request->input('status');
        $karyawan->password = $request->input('password');
        $karyawan->keterangan = $request->input('keterangan');

        // Simpan data karyawan
        $karyawan->save();

        return redirect()->route('karyawans.index')->with('success', 'Data Karyawan berhasil ditambahkan');
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
        $karyawan = Karyawan::findOrFail($id);
        $biodatas = Biodata::all();
        $jabatans = Jabatan::all();
        $users = User::all();

        return view('hrd.karyawan.edit', compact('karyawan', 'biodatas', 'jabatans', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nokaryawan' => 'required|unique:karyawans,nokaryawan,' . $id,
            'nik' => 'required',
            'jabatan_id' => 'required',
            'user_id' => 'nullable',
            'tgl_kp' => 'required',
            'tgl_masuk' => 'required',
            'pendidikan' => 'required',
            'gol_darah' => 'required',
            'tinggi' => 'required',
            'nojamsostek' => 'nullable',
            'tgl_jamsos' => 'nullable|date',
            'password' => 'nullable',
            'status' => 'required',
            'keterangan' => 'nullable'
        ]);


        $karyawan = Karyawan::findOrFail($id);
        $karyawan->nokaryawan = $request->input('nokaryawan');
        $karyawan->nik = $request->input('nik');
        $karyawan->jabatan_id = $request->input('jabatan_id');
        $karyawan->user_id = $request->input('user_id');
        $karyawan->tgl_kp = $request->input('tgl_kp');
        $karyawan->tgl_masuk = $request->input('tgl_masuk');
        $karyawan->pendidikan = $request->input('pendidikan');
        $karyawan->gol_darah = $request->input('gol_darah');
        $karyawan->tinggi = $request->input('tinggi');
        $karyawan->nojamsostek = $request->input('nojamsostek');
        $karyawan->tgl_jamsos = $request->input('tgl_jamsos');
        $karyawan->password = $request->input('password');
        $karyawan->status = $request->input('status');
        $karyawan->keterangan = $request->input('keterangan');
        $karyawan->save();

        return redirect()->route('karyawans.index')->with('success', 'Data Karyawan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table("karyawans")->where('id',$id)->delete();
        return redirect()->route('karyawans.index')->with('success','Biodata deleted successfully');
    }
}
