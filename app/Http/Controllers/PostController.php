<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Fungsi untuk menampilkan beranda (feed)
    public function index()
    {
        // Mengambil semua post beserta user dan komentar (eager loading untuk performa)
        // latest() mengurutkan dari yang paling baru
        $posts = Post::with(['user', 'comments'])->latest()->get();

        return view('posts.index', compact('posts'));
    }
}
