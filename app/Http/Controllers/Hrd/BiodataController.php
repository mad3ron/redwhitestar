<?php

namespace App\Http\Controllers\Hrd;

use Carbon\Carbon;
use App\Models\Hrd\Biodata;
use App\Models\Hrd\Karyawan;
use Illuminate\Http\Request;
use App\Models\Hrd\Pengemudi;
use App\Models\Admin\Kelurahan;
use App\Models\Admin\Kotalahir;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hrd\BiodataRequest;
use App\Models\Admin\Jabatan;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalKaryawan = Biodata::count();

        $search = $request->input('search');
        $per_page = $request->input('per_page') ?? 10;

        if ($search) {
            $biodatas = Biodata::where(function ($query) use ($search) {
                $query->where('nik', 'like', '%'.$search.'%')
                    ->orWhere('nama', 'like', '%'.$search.'%')
                    ->orWhereHas('kelurahans', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('kotalahirs', function ($query) use ($search) {
                        $query->where('tempat_lahir', 'like', '%'.$search.'%');
                    });
                })
                ->paginate($per_page);
        } else {
            $biodatas = Biodata::paginate($per_page);
        }

        $biodatas->load('kotalahirs', 'kelurahans');

        return view('hrd.biodata.index', compact('biodatas', 'totalKaryawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $kelurahans = Kelurahan::select('id', 'name', 'kecamatan', 'kabkota')->get();
        $kotalahirs = Kotalahir::select('id', 'tempat_lahir')->get();
        $jabatans = Jabatan::select('id', 'name')->get();

        return view('hrd.biodata.create', compact('kelurahans', 'kotalahirs', 'jabatans'));
    }

    public function getKelurahanData(Request $request)
    {
        $kelurahan = Kelurahan::find($request->input('kelurahan_id'));

        return response()->json([
            'kelurahan' => $kelurahan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
        $validator = validator($request->all(), [
        'nik' => 'required|string|min:16|unique:biodatas,nik',
        'nokk' => 'nullable|string|min:16',
        'nama' => 'required|string|max:255',
        'kotalahir_id' => 'required|integer|exists:kotalahirs,id',
        'tgl_lahir' => 'required|date',
        'status' => 'required|in:Nikah,Lajang,Duda,Janda',
        'agama' => 'required|string|max:255',
        'jenis' => 'required|in:Laki-laki,Perempuan',
        'alamat' => 'required|string|max:255',
        'rt' => 'required|string|max:3',
        'rw' => 'required|string|max:3',
        'kelurahan_id' => 'required|integer|exists:kelurahans,id',
        'phone' => 'required|string|min:10',
        'jabatan_id' => 'required|integer|exists:jabatans,id',
        'is_visible' => 'required|in:Active,Inactive,Disable'
    ]);

        $biodata = new Biodata();
        $biodata->nik = $request->input('nik');
        $biodata->nokk = $request->nokk;
        $biodata->nama = $request->nama;
        $biodata->kotalahir_id = $request->input('kotalahir_id');
        $biodata->tgl_lahir = $request->tgl_lahir;
        $biodata->status = $request->status;
        $biodata->agama = $request->agama;
        $biodata->jenis = $request->jenis;
        $biodata->alamat = $request->alamat;
        $biodata->rt = $request->rt;
        $biodata->rw = $request->rw;
        $biodata->kelurahan_id = $request->input('kelurahan_id');
        $biodata->phone = $request->phone;
        $biodata->jabatan_id = $request->input('jabatan_id');
        $biodata->is_visible = $request->is_visible;
        $biodata->save();

        return redirect()->route('biodatas.index')->with('success', 'Data biodata berhasil disimpan.');
     }

     public function searchNik(Request $request)
    {
        $query = $request->input('query');

        $suggestions = Biodata::where('nik', 'LIKE', "%$query%")->get();

        return response()->json(['data' => $suggestions]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $biodata = Biodata::find($id);
        $employees = $biodata->employees;

        // Sekarang Anda memiliki data pivot dari tabel Karyawan, Pengemudi, dan Kondektur dalam $employees
        // Anda dapat melakukan sesuatu dengan data ini sesuai dengan kebutuhan Anda

        return view('nama-view-anda', compact('biodata', 'employees'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $biodata = Biodata::find($id);
        $kelurahans = Kelurahan::all();
        $kotalahirs = Kotalahir::all();
        $jabatans = Jabatan::select('id', 'name')->get();

        return view('hrd.biodata.edit', compact('biodata', 'jabatans','kelurahans', 'kotalahirs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|min:16|unique:biodatas,nik,' . $id,
            'nokk' => 'nullable',
            'nama' => 'required|string|max:255',
            'kotalahir_id' => 'required|integer|exists:kotalahirs,id',
            'tgl_lahir' => 'required|date',
            'status' => 'required|in:Nikah,Lajang,Duda,Janda',
            'agama' => 'required|string|max:255',
            'jenis' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kelurahan_id' => 'required|integer|exists:kelurahans,id',
            'phone' => 'required|string|min:9',
            'jabatan_id' => 'required|integer|exists:jabatans,id',
            'is_visible' => 'required|in:Active,Inactive,Disable',
        ]);

        $biodata = Biodata::find($id);

        $biodata->update($request->all());

        return redirect()->route('biodatas.index')->with('success', 'Biodata updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biodata = Biodata::findOrFail($id);

        // Cek apakah ada relasi data di tabel karyawan, pengemudi, atau kondektur
        $hasKaryawan = $biodata->karyawan ? $biodata->karyawan->count() > 0 : false;
        $hasPengemudi = $biodata->pengemudi ? $biodata->pengemudi->count() > 0 : false;
        $hasKondektur = $biodata->kondektur ? $biodata->kondektur->count() > 0 : false;

        if ($hasKaryawan || $hasPengemudi || $hasKondektur) {
            // Data masih terkait dengan salah satu dari tabel lainnya, tampilkan pesan peringatan atau ambil tindakan lain.
            return redirect()->route('biodatas.index')->with('error', 'Data ini memiliki relasi dengan salah satu dari tabel lainnya dan tidak dapat dihapus.');
        }

        // Jika tidak ada relasi, hapus data biodata
        $biodata->delete();

        return redirect()->route('biodatas.index')->with('success', 'Biodata Berhasil Dihapus');
    }

    public function getByNik($nik)
    {
        $biodata = Biodata::where('nik', $nik)->first();

        return response()->json([
            'biodata' => $biodata
        ]);
    }

    public function submitForm(Request $request)
    {
        // Validasi data form jika diperlukan
        $validatedData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        // Simpan data biodata ke dalam tabel Biodata
        $biodata = new Biodata;
        $biodata->nik = $request->input('nik');
        $biodata->nama = $request->input('nama');
        $biodata->alamat = $request->input('alamat');
        $biodata->role = $request->input('role');
        $biodata->save();

        // Simpan data sesuai dengan peran (role)
        $role = $request->input('role');

        if ($role === 'karyawan') {
            $karyawan = new Karyawan;
            $karyawan->biodata_id = $biodata->id;
            // Simpan data lainnya dari form karyawan
            $karyawan->save();
        } elseif ($role === 'pengemudi') {
            $pengemudi = new Pengemudi;
            $pengemudi->biodata_id = $biodata->id;
            // Simpan data lainnya dari form pengemudi
            $pengemudi->save();
        // } elseif ($role === 'konduktor') {
        //     $konduktor = new Konduktor;
        //     $konduktor->biodata_id = $biodata->id;
        //     // Simpan data lainnya dari form konduktor
        //     $konduktor->save();
        }

        // Redirect atau lakukan tindakan lainnya setelah menyimpan data

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $biodatas = Biodata::select('biodatas.id', 'biodatas.nik', 'biodatas.nokk', 'biodatas.nama', 'biodatas.tgl_lahir', 'biodatas.status', 'biodatas.agama', 'biodatas.jenis', 'biodatas.alamat', 'biodatas.rt', 'biodatas.rw', 'biodatas.is_visible', 'kotalahirs.tempat_lahir', 'kelurahans.name', 'kelurahans.kecamatan', 'kelurahans.kabkota')
                    ->join('kotalahirs', 'biodatas.kotalahir_id', '=', 'kotalahirs.id')
                    ->join('kelurahans', 'biodatas.kelurahan_id', '=', 'kelurahans.id')
                    ->where('biodatas.nik', 'like', '%' . $search . '%')
                    ->orWhere('biodatas.nokk', 'like', '%' . $search . '%')
                    ->orWhere('biodatas.nama', 'like', '%' . $search . '%')
                    ->orWhere('kelurahans.name', 'like', '%' . $search . '%')
                    ->paginate(10);

        return view('biodata.search', compact('biodatas'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->with('search', $search);
    }

    public function viewPDF(Request $request)
    {
        $search = $request->input('search');
        $per_page = $request->input('per_page') ?? 20;

        $biodata = Biodata::where(function ($query) use ($search) {
                $query->where('nik', 'like', '%'.$search.'%')
                      ->orWhere('nama', 'like', '%'.$search.'%')
                      ->orWhereHas('kelurahans', function ($query) use ($search) {
                          $query->where('nama', 'like', '%'.$search.'%');
                      })
                      ->orWhereHas('kotalahirs', function ($query) use ($search) {
                          $query->where('tempat_lahir', 'like', '%'.$search.'%');
                      });
            })
            ->paginate($per_page);

        // Membuat PDF menggunakan library Dompdf
        $pdf = PDF::loadView('hrd.biodata.pdf', compact('biodata'), [], null);
        $pdf->setPaper('legal', 'landscape');

         // Mengembalikan hasil PDF untuk ditampilkan di browser
         return $pdf->stream('biodata.pdf');
    }

    public function exportPDF(Request $request)
    {
        $search = $request->input('search');
        $per_page = $request->input('per_page') ?? 10;

        $biodata_query = Biodata::where(function ($query) use ($search) {
            $query->where('nik', 'like', '%'.$search.'%')
                ->orWhere('nokk', 'like', '%'.$search.'%')
                ->orWhereHas('kelurahans', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->orWhereHas('kotalahirs', function ($query) use ($search) {
                    $query->where('tempat_lahir', 'like', '%'.$search.'%');
                });
        })
            ->with(['kelurahans', 'kotalahirs'])
            ->orderBy('created_at', 'desc');

        if ($per_page !== 'all') {
            $biodatas = $biodata_query->paginate($per_page);
        } else {
            $biodatas = $biodata_query->get();
        }

        // Menambahkan nomor urut untuk setiap bis
        $biodatas->each(function ($biodata, $index) {
            $biodata->nomor_urut = $index + 1;
        });

        // Membuat PDF menggunakan library Dompdf
        $pdf = PDF::loadView('hrd.biodata.pdf', compact('buses'), [], null);
        $pdf->setPaper('legal', 'landscape');

        // Mengembalikan hasil PDF untuk diunduh
        return $pdf->download('biodata'.Carbon::now()->timestamp.'.pdf');
        // return $pdf->download('biodata.pdf');
    }



}
