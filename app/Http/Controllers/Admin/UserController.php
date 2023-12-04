<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $users = User::with(['roles' => function ($query) {
            $query->select('name');
        }])
        ->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('username', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%');
        })
        ->paginate(10);

        $roles = Role::all();

        return view('admin.user.index', compact('users'));
    }

    // public function scopeRole($query, $roleName1, $roleName2) // Menambahkan parameter kedua
    // {
    //     return $query->whereHas('roles', function ($query) use ($roleName1, $roleName2) {
    //         $query->whereIn('name', [$roleName1, $roleName2]);
    //     });
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.user.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users,email',
        'status' => 'required|in:Active,Inactive,Disable',
        'password' => 'required|min:6',
        'roles' => 'required|array',
        'roles.*' => 'exists:roles,id',
    ]);

    $user = new User();
    $user->name = $validatedData['name'];
    $user->username = $validatedData['username'];
    $user->email = $validatedData['email'];
    $user->status = $validatedData['status'];
    $user->password = Hash::make($validatedData['password']);
    $user->role_id = $validatedData['roles'][0];
    $user->save();

    $roles = Role::whereIn('id', $validatedData['roles'])->get();
    $user->roles()->sync($roles);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}



    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($identifier)
    {
        $user = User::where('id', $identifier)
                ->orWhere('name', $identifier)
                ->firstOrFail();
        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'status' => 'required|in:Active,Inactive,Disable',
            'password' => 'nullable|min:6',
            'password_confirmation' => 'nullable|min:6|same:password',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->status = $validatedData['status'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->role_id = $validatedData['role_id'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
        // dd($request->all());
    }



    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Hapus user dari database
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
