<?php

namespace App\Http\Controllers\Edp;

use Carbon\Carbon;
use App\Models\Admin\Bis;
use App\Models\Admin\Pool;
use App\Models\Admin\Rute;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class BisController extends Controller
{
    public function index(Request $request)
    {
        $totalBuses = Bis::count();
        $rkBuses = Bis::where('merk', 'HINO RK')->count();
        $rktBuses = Bis::where('merk', 'HINO RKT')->count();
        // menghitung jumlah bus dengan merk RG
        $rgBuses = Bis::where('merk', 'HINO RG')->count();
        // menghitung jumlah bus dengan merk RKJ
        $rkjBuses = Bis::where('merk', 'HINO RKJ')->count();

        // menyimpan variabel-variabel di atas ke dalam session
        $request->session()->put('totalBuses', $totalBuses);
        $request->session()->put('rktBuses', $rktBuses);
        $request->session()->put('rgBuses', $rgBuses);
        $request->session()->put('rkjBuses', $rkjBuses);

        $search = $request->input('search');
        $per_page = $request->input('per_page') ?? 10;

        $buses = Bis::where(function ($query) use ($search) {
            $query->where('nobody', 'like', '%'.$search.'%')
                  ->orWhere('nopolisi', 'like', '%'.$search.'%')
                  ->orWhere('nochassis', 'like', '%'.$search.'%')
                  ->orWhere('nomesin', 'like', '%'.$search.'%')
                  ->orWhere('merk', 'like', '%'.$search.'%')
                  ->orWhere('tahun', 'like', '%'.$search.'%')
                  ->orWhere('jenis', 'like', '%'.$search.'%')
                  ->orWhereHas('rutes', function ($query) use ($search) {
                      $query->where('koderute', 'like', '%'.$search.'%');
                  })
                  ->orWhereHas('pools', function ($query) use ($search) {
                    $query->where('nama_pool', 'like', '%'.$search.'%');
                })
                  ->orWhere('kondisi', 'like', '%'.$search.'%');
        })
        ->paginate($per_page);

        $buses->load('pools', 'rutes'); // tambahkan baris ini

        return view('admin.bis.index', compact('buses', 'totalBuses', 'rktBuses', 'rgBuses', 'rkjBuses')); // Mengirimkan variabel $rgbuses ke dalam view
    }

    public function create()
    {
        $pools = Pool::all();
        $rutes = Rute::all();

        return view('admin.bis.create', compact('pools', 'rutes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nobody' => 'required',
            'nopolisi' => 'required',
            'nochassis' => 'required',
            'nomesin' => 'required',
            'rute_id' => 'required',
            'pool_id' => 'required',
            'merk' => 'required',
            'tahun' => 'required',
            'jenis' => 'required',
            'seat' => 'required',
            'izintrayek' => 'required',
            'nomor_uji' => 'required',
            'tgl_stnk' => 'required',
            'tgl_stnk2' => 'required',
            'tgl_kir' => 'required',
            'tgl_kps' => 'required',
            'kondisi' => 'required',
            'rasio' => 'required',
        ]);

        // Set nilai default untuk bidang "keterangan"
        $keterangan = $request->input('keterangan', ''); // Jika tidak diisi, akan menjadi string kosong

        Bis::create([
            'nobody' => $request->input('nobody'),
            'nopolisi' => $request->input('nopolisi'),
            'nochassis' => $request->input('nochassis'),
            'nomesin' => $request->input('nomesin'),
            'rute_id' => $request->input('rute_id'),
            'pool_id' => $request->input('pool_id'),
            'merk' => $request->input('merk'),
            'tahun' => $request->input('tahun'),
            'jenis' => $request->input('jenis'),
            'seat' => $request->input('seat'),
            'izintrayek' => $request->input('izintrayek'),
            'nomor_uji' => $request->input('nomor_uji'),
            'tgl_stnk' => $request->input('tgl_stnk'),
            'tgl_kir' => $request->input('tgl_kir'),
            'tgl_kps' => $request->input('tgl_kps'),
            'kondisi' => $request->input('kondisi'),
            'rasio' => $request->input('rasio'),
            'keterangan' => $keterangan, // Gunakan nilai default yang telah disetel
        ]);

        return redirect()->route('biss.index')->with('message', 'Bis telah diinput');
    }

    public function show(Bis $bis)
    {
        //
    }

    public function edit(string $id)
    {
        $bis = Bis::findOrFail($id);
        $pools = Pool::all();
        $rutes = Rute::all();

        return view('admin.bis.edit', compact('bis', 'pools', 'rutes'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nobody' => 'required',
            'nopolisi' => 'required',
            'nochassis' => 'required',
            'nomesin' => 'required',
            'rute_id' => 'required',
            'pool_id' => 'required',
            'merk' => 'required',
            'tahun' => 'required',
            'jenis' => 'required',
            'seat' => 'required',
            'izintrayek' => 'required',
            'nomor_uji' => 'required',
            'tgl_stnk' => 'required',
            'tgl_stnk2' => 'required',
            'tgl_kir' => 'required',
            'tgl_kps' => 'required',
            'kondisi' => 'required',
            'rasio' => 'required',
        ]);

        // Set nilai default untuk bidang "keterangan"
        $keterangan = $request->input('keterangan', ''); // Jika tidak diisi, akan menjadi string kosong

        $bis = Bis::findOrFail($id);

        $bis->update([
            'nobody' => $request->input('nobody'),
            'nopolisi' => $request->input('nopolisi'),
            'nochassis' => $request->input('nochassis'),
            'nomesin' => $request->input('nomesin'),
            'rute_id' => $request->input('rute_id'),
            'pool_id' => $request->input('pool_id'),
            'merk' => $request->input('merk'),
            'tahun' => $request->input('tahun'),
            'jenis' => $request->input('jenis'),
            'seat' => $request->input('seat'),
            'izintrayek' => $request->input('izintrayek'),
            'nomor_uji' => $request->input('nomor_uji'),
            'tgl_stnk' => $request->input('tgl_stnk'),
            'tgl_stnk2' => $request->input('tgl_stnk2'),
            'tgl_kir' => $request->input('tgl_kir'),
            'tgl_kps' => $request->input('tgl_kps'),
            'kondisi' => $request->input('kondisi'),
            'rasio' => $request->input('rasio'),
            'keterangan' => $keterangan, // Gunakan nilai default yang telah disetel
        ]);

        return redirect()->route('biss.index')->with('message', 'Bis berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bis = Bis::findOrFail($id);
        $bis->delete();

        return redirect()->route('bis.index')->with('success', 'Bis deleted successfully.');
    }

    public function search(Request $request)
    {
        $fromyear = $request->input("fromyeart");
        $toyear = $request->input('toyear');

        $query = DB::table('bis')->select()
            ->where('tahnu', '>=', $fromyear)
            ->where('tahun', '=<', $toyear)
            ->get();

        // dd($query);
        return view('admin.bis.index', compact('query'));

    }

    public function viewPDF(Request $request)
    {
        set_time_limit(0);

        $search = $request->input('search');
        $per_page = $request->input('per_page');

        $buses = Bis::query()
            ->join('pools', 'bis.pool_id', '=', 'pools.id')
            ->join('rutes', 'bis.rute_id', '=', 'rutes.id')
            ->select('bis.pool_id', 'pools.nama_pool AS pool', 'bis.rute_id', 'rutes.koderute AS rute', 'bis.id', 'bis.nobody', 'bis.nochassis', 'bis.nomesin', 'bis.nopolisi', 'bis.merk', 'bis.tahun', 'bis.jenis', 'bis.seat', 'bis.kondisi', 'bis.keterangan', 'bis.updated_at')
            ->orderBy('bis.pool_id', 'ASC')
            ->orderBy('pools.nama_pool')
            ->orderBy('bis.rute_id', 'ASC')
            ->orderBy('rutes.koderute');

        if ($search) {
            $buses->where(function ($query) use ($search) {
                $query->where('bis.nobody', 'like', '%'.$search.'%')
                    ->orWhere('bis.nopolisi', 'like', '%'.$search.'%')
                    ->orWhere('pools.nama_pool', 'like', '%'.$search.'%')
                    ->orWhere('rutes.koderute', 'like', '%'.$search.'%')
                    ->orWhere('bis.kondisi', 'like', '%'.$search.'%');
            });
        }

        // Lakukan paginasi setelah filtering data
        $buses = $per_page != 'all' ? $buses->paginate($per_page) : $buses->get();

        // Membuat PDF menggunakan library Dompdf
        $pdf = PDF::loadView('admin.bis.pdf', compact('buses'), [], null);
        $pdf->setPaper('legal', 'landscape');

        // Mengembalikan hasil PDF untuk ditampilkan di browser
        return $pdf->stream('bis.pdf');
    }

    // public function exportPDF(Request $request)
    // {
    //     set_time_limit(0);

    //     $per_page = $request->input('per_page') ?? 'all';
    //     $buses_query = Bis::with(['pools', 'rutes'])->orderBy('created_at', 'desc');

    //     if ($per_page === 'all') {
    //         $buses = $buses_query->get();
    //     } else {
    //         $buses = $buses_query->paginate($per_page);
    //     }

    //     // Menambahkan nomor urut untuk setiap bis
    //     $buses->each(function ($bis, $index) {
    //         $bis->nomor_urut = $index + 1;
    //     });

    //     $search = $request->input('search'); // tambahkan ini untuk mendapatkan nilai search dari input form

    //     // Membuat PDF menggunakan library Dompdf
    //     $pdf = PDF::loadView('admin.bis.pdf', compact('buses', 'search'), [], null);
    //     $pdf->setPaper('legal', 'landscape');

    //     // Mengembalikan hasil PDF untuk diunduh
    //     return $pdf->download('bis'.Carbon::now()->timestamp.'.pdf');
    // }

    public function exportPdf($search = null)
    {
        // Retrieve data from the database based on the search query
        $buses = Bis::where('nobody', 'like', '%'.$search.'%')
                     ->orWhere('nopolisi', 'like', '%'.$search.'%')
                     ->orWhere('merk', 'like', '%'.$search.'%')
                     ->orWhereHas('rutes', function ($query) use ($search) {
                          $query->where('koderute', 'like', '%'.$search.'%');
                     })
                     ->orWhereHas('pools', function ($query) use ($search) {
                        $query->where('nama_pool', 'like', '%'.$search.'%');
                    })
                     ->orWhere('kondisi', 'like', '%'.$search.'%')
                     ->get();

        // Generate the PDF using the retrieved data
        $pdf = PDF::loadView('admin.bis.pdf', compact('buses'));
        $pdf->setPaper('legal', 'landscape');
        // Return the PDF as a download
        return $pdf->download('bis'.Carbon::now()->timestamp.'.pdf');
    }

    // public function exportPdf(Request $request)
    // {
    //     $search = $request->query('search');

    //     $results = DB::table('bis')
    //         ->rightJoin('rutes', 'bis.rute_id', '=', 'rutes.id')
    //         ->leftJoin('pools', 'rutes.pool_id', '=', 'pools.id')
    //         ->select('pools.id as pool_id', 'pools.name as pool', 'rutes.id as rute_id', 'rutes.name as rute', 'rutes.namarute', DB::raw('COUNT(bis.nobody) as jml_bis'))
    //         ->where(function ($query) use ($search) {
    //             $query->where('pools.name', 'LIKE', '%'.$search.'%')
    //                 ->orWhere('rutes.name', 'LIKE', '%'.$search.'%')
    //                 ->orWhere('rutes.namarute', 'LIKE', '%'.$search.'%');
    //         })
    //         ->groupBy('pools.id', 'pools.name', 'rutes.id', 'rutes.name', 'rutes.namarute')
    //         ->orderBy('pools.id', 'asc')
    //         ->orderBy('rutes.id', 'asc')
    //         ->get();

    //     $pdf = new PDF(); // Inisialisasi class TCPDF
    //     $pdf->AddPage();
    //     $pdf->SetFont('times', '', 12);
    //     $pdf->writeHTML(view('admin.bis_rekap.pdf', ['results' => $results, 'search' => $search])->render()); // Menggunakan view sebagai template PDF dan mengirimkan parameter search
    //     $pdf->Output('rekap_bis.pdf', 'D'); // Menyimpan dan mengunduh file PDF

    //     exit();
    // }
}
