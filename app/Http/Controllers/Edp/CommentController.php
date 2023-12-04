<?php

namespace App\Http\Controllers\Edp;

use App\Models\Commnent;
use App\Models\Admin\Post;
use Illuminate\Http\Request;
use App\Models\Admin\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($postId)
    {
        $post = Post::findOrFail($postId);
        $comments = $post->comments;

        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        return view('comments.create', compact('post', 'user', 'postId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        // Validasi input
        $validatedData = $request->validate([
            'comment' => 'required',
            // Hapus validasi 'view' jika tidak diperlukan
        ]);

        $post = Post::findOrFail($postId);
        $user = Auth::user();

        // Buat komentar baru
        $comment = new Comment();
        $comment->comment = $validatedData['comment'];

        // Assosiasikan komentar dengan post dan user
        $comment->post()->associate($post);
        $comment->user()->associate($user);

        // Simpan komentar ke database
        $comment->save();

        // Redirect atau berikan respons sesuai kebutuhan aplikasi
        return redirect()->route('posts.show', $postId)->with('success', 'Komentar berhasil ditambahkan.');
    }





    /**
     * Display the specified resource.
     */
    public function show($postId)
    {
        $post = Post::findOrFail($postId);
        $comments = $post->comments()->orderBy('created_at', 'desc')->get();

        return view('posts.show', compact('post', 'comments'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commnent $commnent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commnent $commnent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commnent $commnent)
    {
        //
    }
}
