<?php

namespace App\Http\Controllers\Edp;


use App\Models\User;
use App\Models\Hrd\Biodata;
use PhpParser\Builder\Use_;
use App\Models\Hrd\Karyawan;
use Illuminate\Http\Request;
use App\Models\Admin\UserApp;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserAppController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perpage = $request->input('perpage', 10); // Menetapkan jumlah item per halaman default ke 10 jika tidak ada input perpage

        $query = DB::table('userapps')
            ->join('users', 'userapps.user_id', '=', 'users.id')
            ->leftJoin('karyawans', 'userapps.nokar_id', '=', 'karyawans.id')
            ->join('biodatas', 'karyawans.nik', '=', 'biodatas.nik')
            ->select(
                'userapps.id',
                'userapps.user_id',
                'users.name as name',
                'userapps.nokar_id',
                'biodatas.nama as nama',
                'userapps.password',
                'userapps.status'
            );

        // Pencarian berdasarkan kolom yang diinginkan, misalnya kolom 'nama' dalam tabel biodatas
        if ($search) {
            $query->where('biodatas.nama', 'like', '%' . $search . '%');
        }

        // Mengambil data dengan pagination
        $userapps = $query->paginate($perpage);

        return view('admin.userapp.index', compact('userapps', 'search', 'perpage'));

    }

    // Menampilkan form untuk membuat data userapp baru
    public function create()
    {
        $userApp = new UserApp();
        $biodatas = Biodata::all();
        $karyawans = Karyawan::all();
        $users = User::all();

        return view('admin.userapp.create', compact('userApp', 'users', 'karyawans', 'biodatas'));
    }

    // Menyimpan data userapp baru ke database
    public function store(Request $request)
    {
        $userapp = new Userapp;
        $userapp->user_id = $request->user_id;
        $userapp->nokar_id = $request->nokar_id;
        $userapp->password = $request->password;
        $userapp->status = $request->status;
        $userapp->save();

        return redirect()->route('userapps.index')->with('success', 'Data userapp berhasil disimpan');
    }

    // Menampilkan data userapp berdasarkan ID
    public function show($id)
    {
        // $userapp = Userapp::find($id);
        // return view('userapps.show', compact('userapp'));
    }

    // Menampilkan form untuk mengedit data userapp
    public function edit($id)
    {
        $userapp = Userapp::find($id);
        $biodatas = Biodata::all();
        $karyawans = Karyawan::all();
        $users = User::all();

        return view('admin.userapp.edit', compact('userapp','users', 'karyawans', 'biodatas'));
    }

    // Memperbarui data userapp di database
    public function update(Request $request, $id)
    {
        $userapp = Userapp::find($id);
        $userapp->user_id = $request->user_id;
        $userapp->nokar_id = $request->nokar_id;
        $userapp->password = $request->password;
        $userapp->status = $request->status;
        $userapp->save();

        return redirect()->route('userapps.index')->with('success', 'Data userapp berhasil diperbarui');
    }

    // Menghapus data userapp dari database
    public function destroy($id)
    {
        $userapp = Userapp::find($id);
        $userapp->delete();

        return redirect()->route('userapps.index')->with('success', 'Data userapp berhasil dihapus');
    }
}
