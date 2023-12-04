<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Admin\Kelurahan;
use App\Models\Admin\Kotalahir;

class ApiController extends Controller
{
    public function getKelurahan(Request $request)
    {
        $query = $request->input('query');
        $kelurahans = Kelurahan::select('id', 'name')
                        ->where('name', 'LIKE', '%'.$query.'%')
                        ->get();

        return response()->json($kelurahans);
    }

    public function getKotalahir(Request $request)
    {
        $query = $request->input('query');
        $kotalahirs = Kotalahir::select('id', 'tempat_lahir')
                        ->where('tempat_lahir', 'LIKE', '%'.$query.'%')
                        ->get();

        return response()->json($kotalahirs);
    }
}
