<?php

namespace App\Http\Controllers\Cso;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\Bis;
use App\Models\Admin\Pool;
use App\Models\Admin\Armada;
use App\Models\Admin\Tujuan;
use Illuminate\Http\Request;
use App\Models\Cso\Pemesanan;
use App\Models\Cso\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $per_page = $request->input('per_page') ?? 10;
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $tgl_brkt = $request->input('tgl_brkt'); // Ubah ini sesuai dengan inputan atau sumber data yang benar
        $tgl_pulang = $request->input('tgl_pulang'); // Ubah ini sesuai dengan inputan atau sumber data yang benar

        if ($request->has('tgl_brkt')) {
            $tgl_brkt = $request->input('tgl_brkt');
            $tgl_brkt = date('Y-m-d', strtotime($tgl_brkt));
        } else {
            // Tampilkan pesan error
        }
        // Query pemesanan bis
        $pemesanans = Pemesanan::query();

        $tgl_brkt = date('Y-m-d', strtotime($tgl_brkt));
        $tgl_pulang = date('Y-m-d', strtotime($tgl_pulang));

        // Filter berdasarkan tanggal berangkat
        if ($start_date && $end_date) {
            // Ubah format tanggal sesuai dengan format di database (YYYY-MM-DD)
            $formattedStartDate = date('Y-m-d', strtotime($start_date));
            $formattedEndDate = date('Y-m-d', strtotime($end_date));

            $pemesanans->whereBetween('tgl_brkt', [$formattedStartDate, $formattedEndDate]);
        }

        $pemesanans = Pemesanan::query(); // Inisialisasi query builder

        if ($search) {
            $pemesanans->where(function ($query) use ($search) {
                $query->where('nama_pemesan', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhereHas('armadas', function ($query) use ($search) {
                        $query->where('jenis_armada', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('tujuans', function ($query) use ($search) {
                        $query->where('tujuan', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('pools', function ($query) use ($search) {
                        $query->where('nama_pool', 'like', '%' . $search . '%');
                    });
            });
        }
        if ($start_date && $end_date) {
            // Ubah format tanggal sesuai dengan format di database (YYYY-MM-DD)
            $formattedStartDate = date('Y-m-d', strtotime($start_date));
            $formattedEndDate = date('Y-m-d', strtotime($end_date));

            $pemesanans->whereBetween('tgl_brkt', [$formattedStartDate, $formattedEndDate]);
        }

         // Deklarasikan variabel $formattedStartDate
         if (isset($start_date)) {
            $formattedStartDate = date('Y-m-d', strtotime($start_date));
        } else {
            $formattedStartDate = date('Y-m-d', strtotime(now()));
        }

        $durasi = 1; // Inisialisasi $durasi dengan nilai default

        if ($tgl_brkt && $tgl_pulang) {
            $tgl_brkt = Carbon::createFromFormat('Y-m-d', $tgl_brkt);
            $tgl_pulang = Carbon::createFromFormat('Y-m-d', $tgl_pulang);

            // Hitung selisih hari (durasi)
            $tgl_brkt = $tgl_brkt->addDays(1);
            $durasi = $tgl_pulang->diffInDays($tgl_brkt);
        }
         // Hitung total bis yang dipesan
        $totalBisDipesan = $pemesanans->sum('jml_bis');

        // Hitung total bis tersedia
        $totalBisTersedia = Bis::count();


        // Hitung stok bis hari ini
        $stokBisHariIni = $totalBisTersedia - ($totalBisDipesan * $durasi);
// dd($durasi);
        // Seleksi kolom yang diinginkan
        $pemesanans->selectRaw('*, DATEDIFF(tgl_pulang, tgl_brkt) + 1 as durasi_hari, (harga * jml_bis + biaya_jemput) as total_harga');

        $pemesanans = $pemesanans->paginate($per_page);

        return view('cso.pemesanan.index', compact('pemesanans', 'tgl_brkt', 'totalBisDipesan', 'totalBisTersedia','durasi', 'stokBisHariIni', 'formattedStartDate'));
    }


    // public function index(Request $request)
    // {
    //     $search = $request->input('search');
    //     $per_page = $request->input('per_page') ?? 10;
    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');

    //     $pemesanans = Pemesanan::query();

    //     $tgl_brkt = $request->input('tgl_brkt'); // Ubah ini sesuai dengan inputan atau sumber data yang benar
    //     $tgl_pulang = $request->input('tgl_pulang'); // Ubah ini sesuai dengan inputan atau sumber data yang benar

    //     $tgl_brkt = date('Y-m-d', strtotime($tgl_brkt));
    //     $tgl_pulang = date('Y-m-d', strtotime($tgl_pulang));


    //     // // Hitung jumlah bis dipesan untuk tanggal hari ini
    //     $totalBisDipesanHariIni = 0;
    //     foreach ($pemesanans as $pemesanan) {
    //         $tgl_brkt = $pemesanan->tgl_brkt;
    //         if (date('Y-m-d') == $tgl_brkt) {
    //         $totalBisDipesanHariIni += $pemesanan->jml_bis;
    //         }
    //     }

    //     $pemesanans = DB::table('pemesanans')
    //         ->whereColumn('tgl_brkt', '<=', 'tgl_pulang');

    //     $pemesanans = $pemesanans->get();

    //     $totalBisDipesan = 0;
    //     foreach ($pemesanans as $pemesanan) {
    //         $totalBisDipesan += $pemesanan->jml_bis; // Menggunakan operator += untuk menambahkan jumlah bis
    //     }

    //     $totalBisTersedia = Bis::count();
    //     $stokBisHariIni = $totalBisTersedia - $totalBisDipesan;
    //     // Jika tanggal berangkat sama dengan tanggal pulang, maka hitung sekali saja
    //     // if ($tgl_brkt == $tgl_pulang) {
    //     //     $stokBisHariIni--;
    //     // }

    //     $pemesanans = Pemesanan::query(); // Inisialisasi query builder

    //     if ($search) {
    //         $pemesanans->where(function ($query) use ($search) {
    //             $query->where('nama_pemesan', 'like', '%' . $search . '%')
    //                 ->orWhere('phone', 'like', '%' . $search . '%')
    //                 ->orWhere('alamat', 'like', '%' . $search . '%')
    //                 ->orWhereHas('armadas', function ($query) use ($search) {
    //                     $query->where('jenis_armada', 'like', '%' . $search . '%');
    //                 })
    //                 ->orWhereHas('tujuans', function ($query) use ($search) {
    //                     $query->where('tujuan', 'like', '%' . $search . '%');
    //                 })
    //                 ->orWhereHas('pools', function ($query) use ($search) {
    //                     $query->where('nama_pool', 'like', '%' . $search . '%');
    //                 });
    //         });
    //     }

    //      if ($start_date && $end_date) {
    //         // Ubah format tanggal sesuai dengan format di database (YYYY-MM-DD)
    //         $formattedStartDate = date('Y-m-d', strtotime($start_date));
    //         $formattedEndDate = date('Y-m-d', strtotime($end_date));

    //         $pemesanans->whereBetween('tgl_brkt', [$formattedStartDate, $formattedEndDate]);
    //     }

    //     // Deklarasikan variabel $formattedStartDate
    //     if (isset($start_date)) {
    //         $formattedStartDate = date('Y-m-d', strtotime($start_date));
    //     } else {
    //         $formattedStartDate = date('Y-m-d', strtotime(now()));
    //     }

    //     $pemesanans->selectRaw('*, DATEDIFF(tgl_pulang + INTERVAL 1 DAY, tgl_brkt) as durasi_hari, (harga * jml_bis + biaya_jemput) as total_harga');

    //     $pemesanans = $pemesanans->paginate($per_page);

    //     return view('cso.pemesanan.index', compact('pemesanans','tgl_brkt','totalBisDipesan','totalBisTersedia','stokBisHariIni','formattedStartDate'));
    // }


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

        $pemesanans = Pemesanan::where('status', '!=', 'lunas')->get(); // Hanya ambil pemesanan dengan status bukan 'lunas'

        return view('cso.pemesanan.create', compact('users', 'tujuans', 'armadas', 'pools', 'roles', 'pemesanans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan melalui form
        $request->validate([
            'tgl_pesan' => 'required|date',
            'nama_pemesan' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'tujuan_id' => 'required|exists:tujuans,id',
            'tgl_brkt' => 'required|date',
            'tgl_pulang' => 'required|date',
            'jml_bis' => 'nullable|string',
            'biaya_jemput' => 'nullable|string',
            'alamat' => 'nullable|string|max:255',
            'jam_jemput' => 'required|date_format:H:i',
            'armada_id' => 'required|exists:armadas,id',
            'pool_id' => 'required|exists:pools,id',
        ]);

        // Mendapatkan ID user yang saat ini login
        $userId = Auth::id();

        // Mendapatkan harga berdasarkan tujuan_id yang dipilih
        $tujuan = Tujuan::findOrFail($request->input('tujuan_id'));
        $harga = $tujuan->harga_dasar;

        // Buat pemesanan baru dan isi dengan data dari formulir
        $pemesanan = new Pemesanan();
        $pemesanan->tgl_pesan = $request->input('tgl_pesan');
        $pemesanan->nama_pemesan = $request->input('nama_pemesan');
        $pemesanan->phone = $request->input('phone');
        $pemesanan->tujuan_id = $request->input('tujuan_id');
        $pemesanan->harga = $harga;
        $pemesanan->jml_bis = $request->input('jml_bis');
        $pemesanan->biaya_jemput = $request->input('biaya_jemput');
        $pemesanan->tgl_brkt = $request->input('tgl_brkt');
        $pemesanan->tgl_pulang = $request->input('tgl_pulang');
        $pemesanan->alamat = $request->input('alamat');
        $pemesanan->jam_jemput = $request->input('jam_jemput');
        $pemesanan->armada_id = $request->input('armada_id');
        $pemesanan->pool_id = $request->input('pool_id');
        $pemesanan->user_id = $userId;

        $pemesanan->save();

        // Setelah data disimpan, Anda dapat melakukan redirect atau memberikan pesan sukses.

        return redirect()->route('pemesanan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // Access the nopesan_id directly from the $pemesanan object
        $nopesan_id = $pemesanan->nopesan_id;

        $pembayaran = Pembayaran::where('nopesan_id', $nopesan_id)->first();
        $jumlahInvoice = Pembayaran::where('nopesan_id', $nopesan_id)->count();

        if ($pembayaran) {
            $pemesanan = $pembayaran->pemesanan;

            if ($pembayaran->status === 'belum lunas') {
                return back()->with('error', 'Konsumen belum bayar.');
            }

            $jumlahInvoice = $pembayaran->count();
            $jmlBis = $pemesanan->jml_bis;
            $biayaJemput = $pemesanan->biaya_jemput;
            $jmlDiscount = $pembayaran->sum('discount');
            $jumlahPembayaran = $pemesanan->harga * $jmlBis + $biayaJemput - $jmlDiscount;
            $baruBayar = $pembayaran->sum('jml_bayar');
            // Menghitung total pembayaran setelah diskon
            $sisaPembayaran = $jumlahPembayaran - $baruBayar;

            // Menentukan status
            $status = ($sisaPembayaran <= 0) ? 'LUNAS' : 'BELUM LUNAS';
        } else {

            return back()->with('error', 'KONSUMEN BELUM MELAKUKAN PEMBAYARAN.');
        }

        $data = [
            'pemesanan' => $pemesanan,
            'jmlBis' => $jmlBis ?? 0,
            'biayaJemput' => $biayaJemput ?? 0,
            'jumlahPembayaran' => $jumlahPembayaran ?? 0,
            'jmlDiscount' => $jmlDiscount ?? 0,
            'baruBayar' => $baruBayar ?? 0,
            'sisaPembayaran' =>  $sisaPembayaran ?? 0,
            'jumlahInvoice' => $jumlahInvoice,
            'status' => $status,
        ];

        return view('cso.pemesanan.show', $data);
    }
        // return view('cso.pemesanan.show', compact('pemesanan', 'pembayaran', 'totalPembayaran', 'jmlDiscount', 'jumlahPembayaran', 'sisaPembayaran', 'status'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pemesanan = Pemesanan::find($id);
        $users = User::all();
        $tujuans = Tujuan::all();
        $armadas = Armada::all();
        $pools = Pool::all();
        $roles = Role::where('name', '<>', 'super admin')->get();

        $pemesanan->jam_jemput = date('H:i', strtotime($pemesanan->jam_jemput));

        return view('cso.pemesanan.edit', compact('pemesanan', 'users', 'tujuans', 'armadas', 'pools','roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan melalui form
        $request->validate([
            'tgl_pesan' => 'required|date',
            'nama_pemesan' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'tgl_brkt' => 'required|date',
            'tgl_pulang' => 'required|date',
            'jam_jemput' => 'required|date_format:H:i',
            'jml_bis' => 'nullable|string',
            'biaya_jemput' => 'nullable|string',
            'tujuan_id' => 'required|exists:tujuans,id',
            'harga' => 'nullable|string|max:20',
            'armada_id' => 'required|exists:armadas,id',
            'pool_id' => 'required|exists:pools,id',
            'status' => 'required|in:belum lunas,lunas',
        ]);

        // Cari pemesanan berdasarkan ID yang diberikan
        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->tgl_pesan = $request->input('tgl_pesan');
        $pemesanan->nama_pemesan = $request->input('nama_pemesan');
        $pemesanan->phone = $request->input('phone');
        $pemesanan->alamat = $request->input('alamat');
        $pemesanan->tgl_brkt = $request->input('tgl_brkt');
        $pemesanan->tgl_pulang = $request->input('tgl_pulang');
        $pemesanan->jam_jemput = $request->input('jam_jemput');
        $pemesanan->jml_bis = $request->input('jml_bis');
        $pemesanan->biaya_jemput = $request->input('biaya_jemput');
        $pemesanan->harga = $request->input('harga');
        $pemesanan->tujuan_id = $request->input('tujuan_id');
        $pemesanan->armada_id = $request->input('armada_id');
        $pemesanan->pool_id = $request->input('pool_id');
        $pemesanan->status = $request->input('status');
        $pemesanan->save();

        return redirect()->route('pemesanan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan deleted successfully.');
    }

    public function pdf(Request $request)
    {
        // $start_date = $request->input('start_date');
        // $end_date = $request->input('end_date');
        // dd($start_date, $end_date);

        $data = DB::table('pemesanans')
        ->join('tujuans', 'pemesanans.tujuan_id', '=', 'tujuans.id')
        ->join('armadas', 'pemesanans.armada_id', '=', 'armadas.id')
        ->join('pools', 'pemesanans.pool_id', '=', 'pools.id')
        ->join('users', 'pemesanans.user_id', '=', 'users.id')
        ->select(
            'pemesanans.tgl_pesan',
            'pemesanans.nama_pemesan',
            'pemesanans.phone',
            'tujuans.tujuan',
            'tujuans.pemakaian',
            'pemesanans.harga',
            'pemesanans.alamat',
            'pemesanans.tgl_brkt',
            'pemesanans.tgl_pulang',
            'pemesanans.alamat',
            'pemesanans.jam_jemput',
            'pemesanans.jml_bis',
            'pemesanans.biaya_jemput',
            DB::raw('DATEDIFF(pemesanans.tgl_pulang + INTERVAL 1 DAY, pemesanans.tgl_brkt) as durasi_hari'),
            DB::raw('pemesanans.harga * pemesanans.jml_bis + pemesanans.biaya_jemput as total_harga'),
            'armadas.jenis_armada',
            'pools.nama_pool',
            'users.name'
        )
        ->orderBy('pools.nama_pool')
        // ->whereBetween('tgl_brkt', [$start_date, $end_date])
        ->orderBy('tgl_brkt')
        ->get();

        // Load view PDF
        $pdf = PDF::loadView('cso.pemesanan.pdf', compact('data'));
        $pdf->setPaper('legal', 'landscape');

        $filename = 'pemesanan_' . date('Y-m-d_H-i-s') . '.pdf';
        return $pdf->download($filename);
    }

    public function invoicePesananPDF($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $nopesan_id = $pemesanan->nopesan_id;
        $pembayaran = Pembayaran::where('nopesan_id', $nopesan_id)->first();

        if ($pembayaran && $pembayaran->status !== 'belum lunas') {
            $status = 'LUNAS';
        } else {
            $status = 'BELUM LUNAS';
        }

        $data = [
            'pemesanan' => $pemesanan,
            'status' => $status,
        ];

        $pdf = PDF::loadView('cso.pemesanan.invoice', $data);

        return $pdf->stream('invoice.pdf');
    }

    // public function get_stock($tgl_brkt)
    // {
    //     // Get all bookings on the specified date
    //     $bookings = $this->where('tgl_brkt', $tgl_brkt)
    //                     ->where('tgl_pulang', '>', now())
    //                     ->get();

    //     // Initialize the stock counter
    //     $stock = 0;

    //     // Iterate over the bookings
    //     foreach ($bookings as $booking) {
    //         // Add the number of buses for each booking to the stock counter
    //         $stock += $booking->jml_bis;
    //     }

    //     // Return the stock
    //     return $stock;
    // }

}
