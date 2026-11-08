<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required',
        ]);

        // Menyimpan komentar yang terelasi ke post dan user yang login
        $post->comments()->create([
            'body' => $request->body,
            'user_id' => $request->user()->id,
        ]);

        return back()->with('success', 'Tanggapanmu berhasil dikirim!');
    }

    public function storeAi(Request $request)
    {
        // 1. Validasi Secret Key sederhana untuk keamanan
        // Pastikan hanya n8n milikmu yang bisa mengirim data ke sini
        if ($request->header('Authorization') !== 'Bearer token-rahasia-hermes-123') {
            return response()->json(['message' => 'Akses ditolak'], 401);
        }

        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required'
        ]);

        // 2. Cari atau buat otomatis User khusus untuk Hermes AI
        $aiUser = \App\Models\User::firstOrCreate(
            ['email' => 'hermes@konselor.local'],
            [
                'name' => 'Hermes AI',
                'password' => bcrypt('password_rahasia_ai')
            ]
        );

        // 3. Simpan komentar AI ke postingan yang sesuai
        $post = \App\Models\Post::find($request->post_id);
        $post->comments()->create([
            'body' => $request->body,
            'user_id' => $aiUser->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Balasan Hermes AI berhasil ditambahkan!'
        ]);
    }
}
