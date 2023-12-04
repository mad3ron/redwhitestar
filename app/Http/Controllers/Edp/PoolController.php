<?php

namespace App\Http\Controllers\Edp;

use App\Models\Admin\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Edp\PoolRequest;


class PoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $per_page = $request->input('per_page', 10);

        $query = Pool::query();

        if (!empty($search)) {
            $query->where('nama_pool', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%');
        }

        $pools = $query->paginate($per_page);

        return view('admin.pool.index', compact('pools', 'search', 'per_page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pool.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pool' => 'required|string|min:2|unique:pools',
            'alamat' => 'required|string',
            'phone' => 'required|string',
            'status' => 'required|in:Active,Inactive,Disable',
        ]);

        $pool = new Pool();
        $pool->nama_pool = $request->input('nama_pool');
        $pool->alamat = $request->input('alamat');
        $pool->phone = $request->input('phone');
        $pool->status = $request->input('status');

        $pool->save();

        return redirect()->route('pool.index')->with('message', 'Pool telah di input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function show(Pool $pool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function edit(Pool $pool)
    {
        return view('admin.pool.edit', compact('pool'));
        // dd($pool->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pool $pool)
    {
        $validatedData = $request->validate([
            'nama_pool'     => 'required|string|min:3|unique:pools,nama_pool,' . $pool->id,
            'alamat'   => 'required|string',
            'phone'    => 'required|string|min:5',
            'status'   => 'required|in:Active,Inactive,Disable',
        ]);

        $pool->update($validatedData);

        return redirect()->route('pool.index')->with('success', 'Pool updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pools')->where('id', $id)->delete();

        return redirect()->route('pool.index')->with('success', 'Pool deleted successfully');
    }
}
