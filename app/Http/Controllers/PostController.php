<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments'])->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // Tambahkan fungsi store ini
    public function store(Request $request)
    {
        // 1. Validasi input (harus diisi dan minimal 5 karakter)
        $request->validate([
            'body' => 'required|min:5',
        ]);

        // 2. Simpan ke database menggunakan relasi user yang sedang login
        $request->user()->posts()->create([
            'body' => $request->body,
            'is_anonymous' => $request->has('is_anonymous'), // bernilai true jika dicentang
        ]);

        // 3. Kembalikan ke halaman beranda
        return redirect()->route('posts.index')->with('success', 'Curhatanmu berhasil dibagikan!');
    }

    public function show(Post $post)
    {
        // Eager load relasi user pada post, dan user pada komentar
        $post->load(['user', 'comments.user']);
        
        return view('posts.show', compact('post'));
    }
}