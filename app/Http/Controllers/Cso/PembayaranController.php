<?php

namespace App\Http\Controllers\Cso;

use App\Models\User;
use App\Models\Admin\Pool;
use App\Models\Admin\Armada;
use App\Models\Admin\Tujuan;
use Illuminate\Http\Request;
use App\Models\Cso\Pemesanan;
use App\Models\Cso\Pembayaran;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $per_page = $request->input('per_page', 10);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Pembayaran::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('nomorPembayaran', 'like', '%' . $search . '%')
                    ->orWhere('kode_pembayaran', 'like', '%' . $search . '%')
                    ->orWhere('jenis_bayar', 'like', '%' . $search . '%');
            })
            ->orWhereHas('pemesanan', function ($query) use ($search) {
                $query->where('nama_pemesan', 'like', '%' . $search . '%');
            });
        }

        if ($startDate && $endDate) {
            // Ubah format tanggal sesuai dengan format di database (YYYY-MM-DD)
            $formattedStartDate = date('Y-m-d', strtotime($startDate));
            $formattedEndDate = date('Y-m-d', strtotime($endDate));

            $query->whereBetween('tgl_bayar', [$formattedStartDate, $formattedEndDate]);
        }

        $query->where('tgl_bayar', '>=', now()->startOfDay());

        $pembayarans = $query->paginate($per_page);

        return view('cso.pembayaran.index', compact('pembayarans'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $users = User::all();
        $tujuans = Tujuan::all();
        $armadas = Armada::all();
        $pools = Pool::all();
        $pemesanans = Pemesanan::all();
        $roles = Role::where('name', '<>', 'super admin')->get();

        // Inisialisasi nomorPembayaran
        $nomorPembayaran = Pembayaran::generateNoPembayaran(); // Use the correct model name

        return view('cso.pembayaran.create', compact('users', 'tujuans', 'armadas', 'pools', 'pemesanans', 'roles', 'nomorPembayaran'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nopesan_id' => 'required',
            'tgl_bayar' => 'required|date',
            'kode_pembayaran' => 'required',
            'jml_bayar' => 'required|numeric',
            'discount' => 'required|numeric',
            'jenis_bayar' => 'required|in:CASH,TRANSFER',
            'keterangan' => 'nullable',
        ]);

        // Mendapatkan ID user yang saat ini login
        $userId = Auth::id();
        // dd($request->all());
        try {
            $pembayaran = new Pembayaran;
            $pembayaran->nopesan_id = $request->input('nopesan_id');
            $pembayaran->tgl_bayar = $request->input('tgl_bayar');
            $pembayaran->kode_pembayaran = $request->input('kode_pembayaran');
            $pembayaran->jml_bayar = $request->input('jml_bayar');
            $pembayaran->discount = $request->input('discount');
            $pembayaran->jenis_bayar = $request->input('jenis_bayar');
            $pembayaran->keterangan = $request->input('keterangan', '');
            $pembayaran->nomorPembayaran = $request->input('nomorPembayaran'); // Menyimpan nomor pembayaran dari form
            $pembayaran->user_id = $userId;

            $pembayaran->save();

            // Jika data berhasil disimpan, Anda dapat mengarahkan pengguna ke halaman lain atau memberikan pesan sukses
            return redirect()->route('pemesanan.index')->with('success', 'Pembayaran berhasil disimpan');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, Anda dapat mengarahkan pengguna kembali ke halaman form atau memberikan pesan kesalahan
            return redirect()->route('pembayaran.create')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */

     public function show(string $id)
     {
         // Cari pemesanan berdasarkan ID yang diberikan
         $pemesanan = Pemesanan::find($id);

         if (!$pemesanan) {
             return back()->with('error', 'Pemesanan tidak ditemukan.');
         }

         $pembayaran = $pemesanan->pembayaran;

         // Variabel $jumlahInvoice akan diinisialisasi sebagai 0 secara default
         $jumlahInvoice = 0;

         if (!$pembayaran->isEmpty()) {
             // Jika ada pembayaran, hitung jumlah invoice
             $jumlahInvoice = $pembayaran->count();

            // Periksa status pembayaran
            //  if ($pembayaran->status === 'belum lunas') {
            //     // Tampilkan pesan "Konsumen belum bayar"
            //      return back()->with('error', 'Konsumen belum bayar.');
            //  }

             // Menghitung jumlah bis, biaya jemput, jumlah pembayaran
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
             // Jika tidak ada pembayaran, set variabel $status ke 'Konsumen belum bayar'
             $status = 'Konsumen belum bayar';
         }

         // Menyiapkan data untuk ditampilkan
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


    //  public function show(string $id)
    //  {
    //      $jmlDiscount = 0; // Inisialisasi variabel jmlDiscount

    //      $pembayaran = Pembayaran::where('nopesan_id', $id)->first();

    //      if ($pembayaran) {
    //          $pemesanan = $pembayaran->pemesanan;

    //          // Periksa status pembayaran
    //          if ($pembayaran->status === 'unpaid') {
    //              // Tampilkan pesan "Konsumen belum bayar"
    //              return back()->with('error', 'Konsumen belum bayar.');
    //          }

    //          $jumlahPembayaran = $pemesanan->pembayaran->count();
    //          $jmlBis = $pemesanan->jml_bis;
    //          $biayaJemput = $pemesanan->biaya_jemput;
    //          $jumlahBayar = $pemesanan->harga * $jmlBis + $biayaJemput;
    //          $jmlDiscount = $pembayaran->discount;
    //          $totalPembayaran = $jumlahBayar - $jmlDiscount;

    //          // Hitung sisa pembayaran
    //          $sisaPembayaran = $totalPembayaran - $pembayaran->jml_bayar ;
    //          $status = $sisaPembayaran <= 0 ? 'LUNAS' : 'Sisa Pembayaran';

    //          $data = [
    //              'pembayaran' => $pembayaran,
    //              'pemesanan' => $pemesanan,
    //              'jumlahPembayaran' => $jumlahPembayaran,
    //              'jumlahBayar' => $jumlahBayar, // Menambahkan jumlahBayar ke data
    //              'totalPembayaran' => $totalPembayaran,
    //              'sisaPembayaran' => $sisaPembayaran,
    //              'jmlDiscount' => $jmlDiscount,
    //              'status' => $status,
    //          ];

    //          return view('cso.pembayaran.show', $data);
    //      } else {
    //          // Tampilkan pesan "Pembayaran tidak ditemukan"
    //          return back()->with('error', 'KONSUMEN BELUM MELAKUKAN PEMBAYARAN.');
    //      }
    //  }


    public function showById($id)
    {
        $pemesanan = Pemesanan::find($id);
        if (!$pemesanan) {
            // jika pemesanan tidak ditemukan
            return back()->with('error', 'Pemesanan tidak ditemukan.');
        }

    //     // Kemudian, Anda bisa melanjutkan untuk memeriksa pembayaran dan melanjutkan kode Anda sesuai kebutuhan
        $pembayaran = $pemesanan->pembayaran;

        if (!$pembayaran) {
    //         // Tampilkan pesan atau lakukan penanganan sesuai kebutuhan jika pembayaran tidak ditemukan
            return back()->with('error', 'Konsumen belum bayar.');
        }

        $jumlahInvoice = $pembayaran->count();
        $jmlBis = $pembayaran->pemesanan->jml_bis;
        $jumlahBayar = $pembayaran->pemesanan->jml_bis ;
        $totalPembayaran = $pembayaran->sum('jml_bayar') + $pemesanan->biaya_jemput - $pembayaran->discount;
    //     // Hitung total biaya pemesanan
        $hargaPemesanan = $pemesanan->harga;

    //     // Hitung sisa pembayaran
        $sisaPembayaran = $hargaPemesanan - $totalPembayaran;

        $data = [
            'pemesanan' => $pemesanan,
            'pembayaran' => $pembayaran,
            'jmlBis' => $jmlBis,
            'jumlahBayar' => $jumlahBayar,
            'jumlahInvoice' => $jumlahInvoice,
            'totalPembayaran' => $totalPembayaran,
            'sisaPembayaran' => $sisaPembayaran,
        ];

        return view('cso.pemesanan.show', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        // Mengambil status dari permintaan POST
        $status = $request->input('status');

        $pemesanan = Pemesanan::find($id);
        $pemesanan->status = $status;
        $pemesanan->save();

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $users = User::all();
        $tujuans = Tujuan::all();
        $armadas = Armada::all();
        $pools = Pool::all();
        $pemesanans = Pemesanan::all();
        $roles = Role::where('name', '<>', 'super admin')->get();

        // Inisialisasi nomorPembayaran
        $nomorPembayaran = Pembayaran::generateNoPembayaran(); // Use the correct model name

        return view('cso.pembayaran.edit', compact('pembayaran','users', 'tujuans', 'armadas', 'pools', 'pemesanans', 'roles', 'nomorPembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim oleh form
        $validatedData = $request->validate([
            'nopesan_id' => 'required',
            'tgl_bayar' => 'required|date',
            'kode_pembayaran' => 'required',
            'jml_bayar' => 'required|numeric',
            'discount' => 'required|numeric',
            'jenis_bayar' => 'required|in:CASH,TRANSFER',
            'keterangan' => 'nullable',
        ]);

        try {
            // Mendapatkan ID user yang saat ini login
            $userId = Auth::id();

            // Cari pembayaran berdasarkan ID yang diberikan
            $pembayaran = Pembayaran::findOrFail($id);

            if (!$pembayaran) {
                return redirect()->route('pembayaran.index')->with('error', 'Pembayaran tidak ditemukan.');
            }

            // Update data pembayaran
            $pembayaran->nopesan_id = $request->input('nopesan_id');
            $pembayaran->tgl_bayar = $request->input('tgl_bayar');
            $pembayaran->kode_pembayaran = $request->input('kode_pembayaran');
            $pembayaran->jml_bayar = $request->input('jml_bayar');
            $pembayaran->discount = $request->input('discount');
            $pembayaran->jenis_bayar = $request->input('jenis_bayar');
            $pembayaran->keterangan = $request->input('keterangan');
            $pembayaran->user_id = $userId; // Menggunakan ID user yang saat ini login
            $pembayaran->save();

            return redirect()->route('pembayaran.index', $id)->with('success', 'Pembayaran berhasil diperbarui.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, Anda dapat mengarahkan pengguna kembali ke halaman form edit atau memberikan pesan kesalahan
            return redirect()->route('pembayaran.edit', $id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // Hapus data
        $pembayaran->delete();

        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran deleted successfully.');
    }
}
