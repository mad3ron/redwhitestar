<?php

namespace App\Http\Controllers\Operasi;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\Bis;
use App\Models\Admin\Pool;
use App\Models\Admin\Rute;
use App\Models\Admin\Posisi;
use Illuminate\Http\Request;
use App\Models\Cso\Pemesanan;
use App\Models\Hrd\Kondektur;
use App\Models\Hrd\Pengemudi;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Operasi\Spjkeluar;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;

class SpjkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perpage', 20);
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // dd($startDate, $endDate);
        // Membuat kueri awal dengan model Spjkeluar
        $spjkeluar = Spjkeluar::query();

       // Kondisi berdasarkan tanggal
        if ($startDate && $endDate) {
            $spjkeluar->whereDate('tgl_klr', '>=', $startDate)->whereDate('tgl_klr', '<=', $endDate);
        }

        // Kondisi pencarian
        if ($search) {
            $spjkeluar->whereHas('pemesanans', function ($query) use ($search) {
                $query->where('nama_pemesan', 'LIKE', "%$search%");
            });
        }

        // Menjalankan kueri dan mendapatkan hasil paginasi
        $spjkeluar = $spjkeluar->paginate($perPage);

        return view('operasi.spjkeluar.index', compact('spjkeluar', 'search', 'perPage', 'startDate', 'endDate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $spjKeluar = new Spjkeluar();
        $posisis = Posisi::all();
        $pemesanans = Pemesanan::all();
        $bis = Bis::all();
        $rutes = Rute::all();
        $pools = Pool::all();
        $pengemudis = Pengemudi::all();
        $kondekturs = Kondektur::all();
        $user = User::all();
        $roles = Role::where('name', '<>', 'super admin')->get();

        $nomorspj = Spjkeluar::generateNoSpjkeluar();

        return view('operasi.spjkeluar.create', compact('spjKeluar','nomorspj','posisis', 'pemesanans', 'bis', 'rutes', 'pools', 'pengemudis', 'kondekturs', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_klr' => 'required|date',
            'nopesan_id' => 'required|integer',
            'posisi_id' => 'required|integer',
            'bis_id' => 'required|integer',
            'nopolisi' => 'required|string|max:255',
            'rute_id' => 'required|integer',
            'pool_id' => 'required|integer',
            'nopengemudi_id' => 'required|integer',
            'nokondektur_id' => 'required|integer',
            'uang_jalan' => 'required|numeric',
            'kmkeluar' => 'required|numeric',
            'keterangan_spjklr' => 'required|string|max:255',
        ]);

        $userId = Auth::id();

        // Generate nomor SPJ baru
        $nomorspj = Spjkeluar::generateNoSpjkeluar();

        // Create a new SpjKeluar model
        $spjkeluar = new Spjkeluar();

        // Set the properties of the new model
        $spjkeluar->tgl_klr = $request->input('tgl_klr');
        $spjkeluar->nopesan_id = $request->input('nopesan_id');
        $spjkeluar->posisi_id = $request->input('posisi_id');
        $spjkeluar->bis_id = $request->input('bis_id');
        $spjkeluar->nopolisi = $request->input('nopolisi');
        $spjkeluar->rute_id = $request->input('rute_id');
        $spjkeluar->pool_id = $request->input('pool_id');
        $spjkeluar->nopengemudi_id = $request->input('nopengemudi_id');
        $spjkeluar->nokondektur_id = $request->input('nokondektur_id');
        $spjkeluar->uang_jalan = $request->input('uang_jalan');
        $spjkeluar->kmkeluar = $request->input('kmkeluar');
        $spjkeluar->keterangan_spjklr = $request->input('keterangan_spjklr');
        $spjkeluar->user_id = $userId;

        $spjkeluar->save();

        return redirect()->route('spj-keluar.index')->with('success', 'Pembayaran berhasil disimpan');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nomorspj' => 'required|string|max:255',
    //         'tgl_klr' => 'required|date',
    //         'nopesan_id' => 'required|integer',
    //         'posisi_id' => 'required|integer',
    //         'bis_id' => 'required|integer',
    //         'nopolisi' => 'required|string|max:255',
    //         'rute_id' => 'required|integer',
    //         'pool_id' => 'required|integer',
    //         'nopengemudi_id' => 'required|integer',
    //         'nokondektur_id' => 'required|integer',
    //         'uang_jalan' => 'required|numeric',
    //         'kmkeluar' => 'required|numeric',
    //         'keterangan_spjklr' => 'required|string|max:255',
    //     ]);

    //     $userId = Auth::id();
    //     // dd($request->all());

    //     $year = '23'; // Dua digit pertama tahun
    //     $month = '11'; // Dua digit bulan
    //     $latestSpjkeluar = Spjkeluar::orderBy('nomorspj', 'desc')->first();

    //     if ($latestSpjkeluar) {
    //         $latestNumber = substr($latestSpjkeluar->nomorspj, -5); // Ambil 5 digit terakhir
    //         $newNoSpj = str_pad($latestNumber + 1, 5, '0', STR_PAD_LEFT);
    //     } else {
    //         $newNoSpj = '00001';
    //     }

    //     $nomorspj = "WST-$year$month-$newNoSpj";

    //     // Create a new SpjKeluar model
    //     $spjkeluar = new Spjkeluar();

    //     $spjkeluar->nomorspj = $nomorspj; // Ubah ke variabel $nomorspj
    //     $spjkeluar->tgl_klr = $request->input('tgl_klr');
    //     $spjkeluar->nopesan_id = $request->input('nopesan_id');
    //     $spjkeluar->posisi_id = $request->input('posisi_id');
    //     $spjkeluar->bis_id = $request->input('bis_id');
    //     $spjkeluar->nopolisi = $request->input('nopolisi');
    //     $spjkeluar->rute_id = $request->input('rute_id');
    //     $spjkeluar->pool_id = $request->input('pool_id');
    //     $spjkeluar->nopengemudi_id = $request->input('nopengemudi_id');
    //     $spjkeluar->nokondektur_id = $request->input('nokondektur_id');
    //     $spjkeluar->uang_jalan = $request->input('uang_jalan');
    //     $spjkeluar->kmkeluar = $request->input('kmkeluar');
    //     $spjkeluar->keterangan_spjklr = $request->input('keterangan_spjklr');
    //     $spjkeluar->user_id = $userId;

    //     $spjkeluar->save();

    //        $bus = Bus::where('id', $request->input('bis_id'))->first();

    //        //query masuk
    //        $bus = Bus::where('id', $request->input('bis_id'))->where('posisi', '2')->first();

    //        $bus = Bus::where('id', $request->input('bis_id'))->first();
    //        $bus->posisi = 1;
    //        $bus->save();

    //        // Return a response to the client
    //     return response()->json([
    //         'message' => 'SPJ Keluar created successfully',
    //         'data' => $spjkeluar,
    //     ], 201);

    //     //     return redirect()->route('spj-keluar.index')->with('success', 'Pembayaran berhasil disimpan');
    //     // } catch (\Exception $e) {
    //     //     // Jika terjadi kesalahan, Anda dapat mengarahkan pengguna kembali ke halaman form atau memberikan pesan kesalahan
    //     //     return redirect()->route('spj-keluar.create')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     // }
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
        $spjkeluar = Spjkeluar::findOrFail($id);

        $posisis = Posisi::all();
        $pemesanans = Pemesanan::all();
        $bis = Bis::all();
        $rutes = Rute::all();
        $pools = Pool::all();
        $pengemudis = Pengemudi::all();
        $kondekturs = Kondektur::all();
        $user = User::all();
        $roles = Role::where('name', '<>', 'super admin')->get();

        return view('operasi.spjkeluar.edit', compact('spjkeluar', 'posisis', 'pemesanans', 'bis', 'rutes', 'pools', 'pengemudis', 'kondekturs', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_klr' => 'required|date',
            'posisi_id' => 'required|exists:posisis,id',
            'nopesan_id'=> 'required|exists:pemesanans,id',
            'bis_id' => 'required|exists:bis,id',
            'nopolisi' => 'required',
            'rute_id' => 'required|exists:rutes,id',
            'pool_id' => 'required|exists:pools,id',
            'nopengemudi_id'=> 'required|exists:pengemudis,id',
            'nokondektur_id'=> 'required|exists:kondekturs,id',
            'uang_jalan'=> 'required',
            'kmkeluar'=> 'required',
            'keterangan_spjklr'=> 'nullable',
            ]);



        try {
            $spjkeluar = Spjkeluar::find($id);

            if (!$spjkeluar) {
                return redirect()->route('spj-keluar.index')->with('error', 'Data SPJ Keluar tidak ditemukan.');
            }

            $spjkeluar->tgl_klr = $request->input('tgl_klr');
            $spjkeluar->posisi_id = $request->input('posisi_id');
            $spjkeluar->nopesan_id = $request->input('nopesan_id');
            $spjkeluar->bis_id = $request->input('bis_id');
            $spjkeluar->nopolisi = $request->input('nopolisi');
            $spjkeluar->rute_id = $request->input('rute_id');
            $spjkeluar->pool_id = $request->input('pool_id');
            $spjkeluar->nopengemudi_id = $request->input('nopengemudi_id');
            $spjkeluar->nokondektur_id = $request->input('nokondektur_id');
            $spjkeluar->uang_jalan = $request->input('uang_jalan');
            $spjkeluar->kmkeluar = $request->input('kmkeluar');
            $spjkeluar->keterangan_spjklr = $request->input('keterangan_spjklr');

            // dd($spjkeluar->all());

            $spjkeluar->save();

            return redirect()->route('spj-keluar.index')->with('success', 'Data SPJ Keluar berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('spj-keluar.edit', $id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function viewPDF(Request $request)
    {
        $search = $request->input('search');

        $spjkeluars = Spjkeluar::where(function ($query) use ($search) {
                $query->where('nomorspj', 'like', '%'.$search.'%')
                      ->orWhere('tgl_klr', 'like', '%'.$search.'%')
                      ->orWhereHas('bis', function ($query) use ($search) {
                          $query->where('nobody', 'like', '%'.$search.'%');
                      })
                      ->orWhereHas('rutes', function ($query) use ($search) {
                          $query->where('koderute', 'like', '%'.$search.'%');
                      });
            });

        // Membuat PDF menggunakan library Dompdf
        $pdf = PDF::loadView('operasi.spjkeluar.print', compact('spjkeluars'), [], null);
        $pdf->setPaper('legal', 'landscape');

         // Mengembalikan hasil PDF untuk ditampilkan di browser
         return $pdf->stream('spjkeluar.pdf');
    }

}
