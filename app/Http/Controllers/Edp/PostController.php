<?php

namespace App\Http\Controllers\Edp;

use App\Models\User;
use App\Models\Admin\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('perPage', 10);

        $query = Post::with('user');

        // Jika ada pencarian, tambahkan kondisi pencarian ke query
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $posts = $query->orderByDesc('created_at')->paginate($perPage);

        $posts = $query->paginate($perPage);

        $user = Auth::user();

        return view('admin.post.index', compact('posts', 'search', 'perPage', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.post.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_date' => 'required|date',
            'title' => 'required',
            'content' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $posts = new Post();
        $posts->post_date = $validatedData['post_date'];
        $posts->title = $validatedData['title'];
        $posts->content = $validatedData['content'];
        $posts->user_id = Auth::id(); // Mengisi user_id dengan ID pengguna yang saat ini masuk

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('uploads', 'public');

            // Manipulasi gambar menggunakan Intervention Image
            $image = Image::make(public_path("storage/{$photoPath}"));
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save();

            $posts->photo = $photoPath;
        }

        $posts->save(); // Menyimpan post ke database

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.post.edit', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'post_date' => 'required|date',
            'title' => 'required',
            'content' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $post->post_date = $validatedData['post_date'];
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('uploads', 'public');

            // Manipulasi gambar menggunakan Intervention Image
            $image = Image::make(public_path("storage/{$photoPath}"));
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save();

            $post->photo = $photoPath;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
