<?php

namespace App\Http\Controllers\Edp;

use App\Models\Admin\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PoolrekapController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('perPage', 10);

        $query = Post::with('user');

        // Jika ada pencarian, tambahkan kondisi pencarian ke query
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $posts = $query->paginate($perPage);

        $rekapPools = DB::table('pools')
            ->select('pools.id AS id', 'pools.name AS namapool', DB::raw('COUNT(bis.nobody) AS bisada'))
            ->leftJoin('rutes', 'rutes.pool_id', '=', 'pools.id')
            ->leftJoin('bis', 'bis.rute_id', '=', 'rutes.id')
            ->groupBy('pools.id', 'pools.name');

        // Pengecekan jika ada input pencarian pada rekapPools
        if ($search) {
            $rekapPools->where('pools.name', 'LIKE', "%$search%");
        }

        $rekapPools = $rekapPools->paginate(10);


        return view('admin.post.index', compact('posts', 'search', 'perPage', 'rekapPools', 'user'));
    }

}
