<?php

namespace App\Http\Controllers\Hrd;

use App\Models\Admin\Rute;
use App\Models\Hrd\Biodata;
use Illuminate\Http\Request;
use App\Models\Hrd\Pengemudi;
use App\Http\Controllers\Controller;

class PengemudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perpage') ?? 20;
        $search = $request->input('search');

        $pengemudi = Pengemudi::when($search, function ($query) use ($search) {
            return $query->where('nopengemudi', 'like', '%' . $search . '%')
                ->orWhere('nik', 'like', '%' . $search . '%');
        })->paginate($perPage);

        // Menggunakan query agregasi untuk menghitung jumlah pengemudi dengan NIK yang sama
        $duplicateNikCount = Pengemudi::select('nik')
            ->selectRaw('COUNT(nik) as nik_count')
            ->groupBy('nik')
            ->havingRaw('nik_count > 1')
            ->pluck('nik_count', 'nik');

        return view('hrd.pengemudi.index', compact('pengemudi', 'duplicateNikCount'));
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
    public function create(Request $request)
    {
        $biodatas = Biodata::all();
        $rutes = Rute::all();

        return view('hrd.pengemudi.create', compact('biodatas', 'rutes'));
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'nik' => 'required|exists:biodatas,nik',
            'rute_id' => 'required|integer|exists:rutes,id',
            'tgl_kp' => 'required|date',
            'nosim' => 'required',
            'jenis_sim' => 'required',
            'tgl_sim' => 'required|date',
            'nojamsostek' => 'nullable',
            'tgl_jamsos' => 'nullable|date',
            'status' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Data NIK belum ada dalam tabel biodatas.');
        }

        // Buat instance model Pengemudi dan set nilai atribut
        $pengemudi = new Pengemudi();
        $pengemudi->nopengemudi = $request->input('nopengemudi');
        $pengemudi->nik = $request->nik;
        $pengemudi->rute_id = $request->input('rute_id');
        $pengemudi->tgl_kp = $request->tgl_kp;
        $pengemudi->nosim = $request->nosim;
        $pengemudi->jenis_sim = $request->jenis_sim;
        $pengemudi->tgl_sim = $request->tgl_sim;
        $pengemudi->nojamsostek = $request->input('nojamsostek') ?? '0'; // Penyisipan kode di sini
        $pengemudi->tgl_jamsos = $request->tgl_jamsos;
        $pengemudi->status = $request->status;
        $pengemudi->keterangan = $request->keterangan;

        // Simpan data pengemudi
        $pengemudi->save();

        return redirect()->route('pengemudi.index')->with('success', 'Data pengemudi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengemudi = Pengemudi::with('biodata', 'rute')->find($id);
        $biodatas = Biodata::all();
        $rutes = Rute::all();

        return view('hrd.pengemudi.show', compact('pengemudi', 'biodatas', 'rutes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $pengemudi = Pengemudi::find($id);
        $biodatas = Biodata::all();
        $rutes = Rute::all();

        return view('hrd.pengemudi.edit', compact('pengemudi', 'biodatas', 'rutes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diinput
        $request->validate([
            'nik' => 'required',
            'rute_id' => 'required|integer|exists:rutes,id', // Validasi rute_id
            'tgl_kp' => 'required|date',
            'nosim' => 'required',
            'jenis_sim' => 'required',
            'tgl_sim' => 'required|date',
            'nojamsostek' => 'nullable',
            'tgl_jamsos' => 'nullable|date',
            'status' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        // Temukan pengemudi berdasarkan ID
        $pengemudi = Pengemudi::find($id);

        // Perbarui nilai atribut pengemudi
        $pengemudi->nopengemudi = $request->input('nopengemudi');
        $pengemudi->nik = $request->nik;
        $pengemudi->rute_id = $request->input('rute_id');
        $pengemudi->tgl_kp = $request->tgl_kp;
        $pengemudi->nosim = $request->nosim;
        $pengemudi->jenis_sim = $request->jenis_sim;
        $pengemudi->tgl_sim = $request->tgl_sim;
        $pengemudi->nojamsostek = $request->nojamsostek;
        $pengemudi->tgl_jamsos = $request->tgl_jamsos;
        $pengemudi->status = $request->status;
        $pengemudi->keterangan = $request->keterangan;

        // Simpan data pengemudi yang diperbarui
        $pengemudi->save();

        return redirect()->route('pengemudi.index')->with('success', 'Data pengemudi berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        $pengemudi = Pengemudi::findOrFail($id);

        $pengemudi->delete();

        return redirect()->route('pengemudi.index')->with('success', 'Data pengemudi berhasil dihapus');
    }

    public function autofill(Request $request)
    {
        $nik = $request->input('nik');
        $pengemudi = Pengemudi::where('nik', $nik)->first();

        if ($pengemudi) {
            $data = [
                'nama' => $pengemudi->biodata->nama,
                // Tambahkan data lainnya sesuai kebutuhan
            ];
        } else {
            $data = [];
        }

        return response()->json($data);
    }


}
