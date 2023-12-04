<?php

namespace App\Http\Controllers\Edp;

// use PDF;
use App\Http\Controllers\Controller;
use App\Http\Requests\Edp\KelurahanRequest;
use App\Models\Admin\Kelurahan;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kelurahans = Kelurahan::where('name', 'like', '%'.$search.'%')
            ->orWhere('kecamatan', 'like', '%'.$search.'%')
            ->orWhere('kabkota', 'like', '%'.$search.'%')
            ->orWhere('provinsi', 'like', '%'.$search.'%')
            ->orderBy('id', 'asc')
            ->paginate(20);

        $perPage = $kelurahans->perPage();

        return view('admin.kelurahan.index', compact('kelurahans', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelurahans = Kelurahan::all();

        return view('admin.kelurahan.create', compact('kelurahans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelurahanRequest $request)
    {
        Kelurahan::create($request->all());

        return redirect()->route('kelurahans.index')->with('success', 'Kelurahan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelurahan $kelurahan)
    {
        return view('admin.kelurahan.edit', compact('kelurahan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(KelurahanRequest $request, Kelurahan $kelurahan)
    {
        $kelurahan->update($request->validated());

        return redirect()->route('kelurahans.index')->with('success', 'Kelurahan created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelurahan $kelurahan)
    {
        $kelurahan->delete();

        return to_route('kelurahans.index')->with('success', 'Kelurahan deleted successfully.');
    }

    public function viewPDF(Request $request)
    {
        // Mengambil search keyword dari request
        $search = $request->input('search');

        // Mengambil semua data kelurahan dengan search keyword
        $kelurahans = Kelurahan::where('name', 'like', '%'.$search.'%')
            ->orWhere('kecamatan', 'like', '%'.$search.'%')
            ->orWhere('kabkota', 'like', '%'.$search.'%')
            ->orWhere('provinsi', 'like', '%'.$search.'%')
            ->orderBy('id', 'asc')
            ->paginate(100);

        if ($request->input('print_search')) {
            $kelurahans = Kelurahan::where('name', 'like', '%'.$search.'%')
                ->orWhere('kecamatan', 'like', '%'.$search.'%')
                ->orWhere('kabkota', 'like', '%'.$search.'%')
                ->orWhere('provinsi', 'like', '%'.$search.'%')
                ->orderBy('id', 'asc')
                ->get();
            // Jika opsi print semua halaman dipilih
            // if ($request->input('per_page') === 'all') {
        //     // Memuat seluruh data kelurahan
        //     $kelurahans = Kelurahan::where('name', 'like', '%'.$search.'%')
        //         ->orWhere('kecamatan', 'like', '%'.$search.'%')
        //         ->orWhere('kabkota', 'like', '%'.$search.'%')
        //         ->orWhere('provinsi', 'like', '%'.$search.'%')
        //         ->orderBy('id', 'asc')
        //         ->get();

            // Menambahkan nomor urut untuk setiap kelurahan
            $kelurahans->each(function ($kelurahan, $index) {
                $kelurahan->nomor_urut = $index + 1;
            });
        } else {
            // Menambahkan nomor urut untuk setiap kelurahan pada halaman yang ditampilkan
            $kelurahans->getCollection()->transform(function ($kelurahan, $index) use ($kelurahans) {
                $kelurahan->nomor_urut = ($kelurahans->currentPage() - 1) * $kelurahans->perPage() + $index + 1;

                return $kelurahan;
            });
        }

        // Membuat PDF menggunakan library Dompdf
        $pdf = PDF::loadView('admin.kelurahan.pdf', compact('kelurahans'));

        // Mengembalikan hasil PDF untuk ditampilkan di browser
        return $pdf->stream('kelurahan.pdf');
    }

    // public function viewPDF(Request $request)
    // {
    //     // mengambil search keyword dari request
    //     $search = $request->input('search');

    //     // Mengambil semua data kelurahan dengan search keyword
    //     $kelurahans = Kelurahan::where('name', 'like', '%'.$search.'%')
    //         ->orWhere('kecamatan', 'like', '%'.$search.'%')
    //         ->orWhere('kabkota', 'like', '%'.$search.'%')
    //         ->orderBy('id', 'asc')
    //         ->paginate(100);

    //     // Menambahkan nomor urut untuk setiap kelurahan
    //     $kelurahans->getCollection()->transform(function($kelurahan, $index) use ($kelurahans) {
    //         $kelurahan->nomor_urut = ($kelurahans->currentPage() - 1) * $kelurahans->perPage() + $index + 1;
    //         return $kelurahan;
    //     });

    //     // Membuat PDF menggunakan library Dompdf
    //     $pdf = PDF::loadView('admin.kelurahan.pdf', compact('kelurahans'));

    //     // Mengembalikan hasil PDF untuk ditampilkan di browser
    //     return $pdf->stream('kelurahan.pdf');
    // }
}
