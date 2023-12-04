<?php

namespace App\Http\Controllers\Cso;

use App\Models\User;
use App\Models\Admin\Bis;
use App\Models\Cso\Booking;
use App\Models\Admin\Tujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $per_page = $request->input('per_page') ?? 10;
        $tanggal = $request->input('tanggal');

        $bookings = DB::table('bis')
        ->select(
            'bis.id as bis_id',  // Alias 'id' as 'bis_id' for clarity
            'bis.status_harga',
            'bis.nobody',
            'bis.nopolisi',
            'bookings.id',
            'bookings.tanggal',
            'bookings.nama_konsumen',
            'tujuans.tujuan',
            'bookings.keterangan',
            'bookings.user_id',
            'users.name',
            'bookings.nobooking'
        )
        ->leftJoin('bookings', 'bis.id', '=', 'bookings.bis_id')
        ->leftJoin('tujuans', 'bookings.tujuan_id', '=', 'tujuans.id')
        ->leftJoin('users', 'bookings.user_id', '=', 'users.id');

        if ($search) {
            $bookings->where(function ($query) use ($search) {
                $query->orWhere('bis.status_harga', 'like', '%' . $search . '%');
                $query->orWhere('bis.nobody', 'like', '%' . $search . '%');
                $query->orWhere('bis.nopolisi', 'like', '%' . $search . '%');
                $query->orWhere('bookings.tanggal', 'like', '%' . $search . '%');
                $query->orWhere('bookings.nama_konsumen', 'like', '%' . $search . '%');
                $query->orWhere('tujuans.tujuan', 'like', '%' . $search . '%');
                $query->orWhere('bookings.keterangan', 'like', '%' . $search . '%');
            });
        }

        if ($tanggal) {
            $bookings->where('bookings.tanggal', '=', $tanggal);
        }

        $bookings = $bookings->paginate($per_page);

        return view('cso.booking.index', compact('bookings', 'search', 'per_page'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($bis_id = null, $nobody = null)
    {
        // Ambil data bis untuk dropdown
        $bis = Bis::pluck('nobody', 'id')->toArray();

        // Jika $bis_id ditemukan dalam koleksi, kita ambil nobody-nya
        $nobody = isset($bis[$bis_id]) ? $bis[$bis_id] : 'default_value';

        // Cetak nilai nobody untuk memeriksanya
        dd($nobody);

        // Sisanya dari fungsi create...
        $user = User::all();
        $tujuans = Tujuan::all();
        $roles = Role::where('name', '<>', 'super admin')->get();
        $nomorBooking = Booking::generateNoBooking();

        return view('cso.booking.create', compact('user', 'bis', 'tujuans', 'roles', 'nomorBooking', 'nobody'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nobooking' => 'required|string',
            'tanggal' => 'required|date',
            'nama_konsumen' => 'required|string',
            'phone' => 'required|string|min:10',
            'tujuan_id' => 'required|integer',
            'keterangan' => 'nullable|string',
        ]);

        // Ambil instance Bis berdasarkan id
        $bis = Bis::findOrFail($request->input('bis_id'));

        // Buat instance Booking dengan data yang telah divalidasi
        $booking = new Booking($validatedData);

        // Hubungkan booking dengan bis
        $booking->bis()->associate($bis);

        // Simpan booking ke dalam database
        $booking->save();

        return redirect()->route('booking.index')->with('success', 'Booking berhasil disimpan');
    }
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'tanggal' => 'required|date',
    //         'nama_konsumen' => 'required|string',
    //         'phone' => 'required|string|min:10',
    //         'tujuan_id' => 'required|integer',
    //         'keterangan' => 'nullable|string',
    //     ]);

    //     $userId = Auth::id();

    //     try {
    //         $booking = new Booking();
    //         $booking->nomorBooking = $request->input('nomorBooking'); // Ganti dengan nama input yang benar
    //         $booking->tanggal = $request->input('tanggal');
    //         // $booking->bis_id = $request->input('bis_id'); // Ganti dengan nama input yang benar
    //         $booking->nama_konsumen = $request->input('nama_konsumen');
    //         $booking->phone = $request->input('phone');
    //         $booking->tujuan_id = $request->input('tujuan_id');
    //         $booking->keterangan = $request->input('keterangan');
    //         $booking->user_id = $userId;

    //         $booking->save();

    //         return redirect()->route('booking.index')->with('success', 'Booking berhasil disimpan');
    //     } catch (\Exception $e) {
    //         return redirect()->route('booking.create')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }


    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        $user = User::all();
        $bis = Bis::all();
        $tujuans = Tujuan::all();
        $roles = Role::where('name', '<>', 'super admin')->get();

        // Inisialisasi nomorBooking
        $nomorBooking = Booking::generateNoBooking();

        return view('cso.booking.edit', compact('user', 'bis', 'tujuans', 'roles', 'nomorBooking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
