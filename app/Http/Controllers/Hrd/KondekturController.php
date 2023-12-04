<?php

namespace App\Http\Controllers\Hrd;

use App\Models\Admin\Rute;
use App\Models\Hrd\Biodata;
use Illuminate\Http\Request;
use App\Models\Hrd\Kondektur;
use App\Http\Controllers\Controller;

class KondekturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perpage') ?? 20;
        $search = $request->input('search');

        $kondektur = Kondektur::when($search, function ($query) use ($search) {
            return $query->where('nokondektur', 'like', '%' . $search . '%')
                ->orWhere('nik', 'like', '%' . $search . '%');
        })->paginate($perPage);

        // Menggunakan query agregasi untuk menghitung jumlah koondektur dengan NIK yang sama
        $duplicateNikCount = Kondektur::select('nik')
            ->selectRaw('COUNT(nik) as nik_count')
            ->groupBy('nik')
            ->havingRaw('nik_count > 1')
            ->pluck('nik_count', 'nik');

        return view('hrd.kondektur.index', compact('kondektur', 'duplicateNikCount'));
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

        return view('hrd.kondektur.create', compact('biodatas', 'rutes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'nik' => 'required|exists:biodatas,nik',
            'rute_id' => 'required|integer|exists:rutes,id',
            'tgl_kp' => 'required|date',
            'nojamsostek' => 'nullable',
            'tgl_jamsos' => 'nullable|date',
            'status' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Data NIK belum ada dalam tabel biodatas.');
        }

        // Buat instance model kondektur dan set nilai atribut
        $kondektur = new Kondektur();
        $kondektur->nokondektur = $request->input('nokondektur');
        $kondektur->nik = $request->nik;
        $kondektur->rute_id = $request->input('rute_id'); // Penyisipan kode di sini
        $kondektur->tgl_kp = $request->tgl_kp;
        $kondektur->nojamsostek = $request->nojamsostek;
        $kondektur->tgl_jamsos = $request->tgl_jamsos;
        $kondektur->status = $request->status;
        $kondektur->keterangan = $request->keterangan;

        // Simpan data kondektur
        $kondektur->save();

        return redirect()->route('kondektur.index')->with('success', 'Data kondektur berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kondektur = Kondektur::with('biodata', 'rute')->find($id);
        $biodatas = Biodata::all();
        $rutes = Rute::all();

        return view('hrd.kondektur.show', compact('kondektur', 'biodatas', 'rutes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kondektur = Kondektur::find($id);
        $biodatas = Biodata::all();
        $rutes = Rute::all();

        return view('hrd.kondektur.edit', compact('kondektur', 'biodatas', 'rutes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|exists:biodatas,nik',
            'rute_id' => 'required|integer|exists:rutes,id', // Validasi rute_id
            'tgl_kp' => 'required|date',
            'nojamsostek' => 'nullable',
            'tgl_jamsos' => 'nullable|date',
            'status' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        // Temukan pengemudi berdasarkan ID
        $kondektur = Kondektur::find($id);

        // Perbarui nilai atribut pengemudi
        $kondektur->nokondektur = $request->input('nokondektur');
        $kondektur->nik = $request->nik;
        $kondektur->rute_id = $request->input('rute_id');
        $kondektur->tgl_kp = $request->tgl_kp;
        $kondektur->nojamsostek = $request->nojamsostek;
        $kondektur->tgl_jamsos = $request->tgl_jamsos;
        $kondektur->status = $request->status;
        $kondektur->keterangan = $request->keterangan;

        $kondektur->save();

        return redirect()->route('kondektur.index')->with('success', 'Data kondektur berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kondektur = Kondektur::findOrFail($id);

        $kondektur->delete();

        return redirect()->route('kondektur.index')->with('success', 'Data kondektur berhasil dihapus');
    }

    public function autofill(Request $request)
    {
        $nik = $request->input('nik');
        $kondektur = Kondektur::where('nik', $nik)->first();

        if ($kondektur) {
            $data = [
                'nama' => $kondektur->biodata->nama,
                // Tambahkan data lainnya sesuai kebutuhan
            ];
        } else {
            $data = [];
        }

        return response()->json($data);
    }
}
