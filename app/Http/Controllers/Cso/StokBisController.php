<?php

namespace App\Http\Controllers\Cso;

use App\Models\Admin\Bis;
use Illuminate\Http\Request;
use App\Models\Cso\Pemesanan;
use App\Http\Controllers\Controller;

class StokBisController extends Controller
{
    public function cekStokBis(Request $request)
{
    // Ambil tanggal dari input form
    $tanggal = $request->input('tanggal');

    // Ambil semua pemesanan yang memengaruhi stok bis pada tanggal tertentu
    $pemesanans = Pemesanan::whereDate('tgl_brkt', '<=', $tanggal)
        ->whereDate('tgl_pulang', '>=', $tanggal)
        ->get();

    // Hitung total bis yang dipesan pada tanggal tersebut
    $totalBisDipesan = $pemesanans->sum('jml_bis');

    // Ambil total bis yang tersedia
    $totalBisTersedia = Bis::count();

    // Hitung sisa stok bis
    $sisaStokBis = $totalBisTersedia - $totalBisDipesan;

    // Kembalikan view dengan data stok bis
    return view('stok-bis', compact('tanggal', 'sisaStokBis'));
}

}
