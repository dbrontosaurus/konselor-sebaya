<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Tambahkan ini
use Illuminate\Support\Facades\Log;  // Tambahkan ini

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments'])->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|min:5',
        ]);

        // 1. Simpan curhatan ke database (tampung ke dalam variabel $post)
        $post = $request->user()->posts()->create([
            'body' => $request->body,
            'is_anonymous' => $request->has('is_anonymous'),
        ]);

        // 2. Kirim data ke n8n melalui Webhook secara background
        try {
            $webhookUrl = env('N8N_WEBHOOK_URL');
            
            if ($webhookUrl) {
                Http::timeout(3)->post($webhookUrl, [
                    'post_id' => $post->id,
                    'author' => $post->is_anonymous ? 'Anonim' : $request->user()->name,
                    'body' => $post->body,
                    'timestamp' => $post->created_at->toIso8601String(),
                ]);
            }
        } catch (\Exception $e) {
            // Jika n8n mati, website tetap berjalan normal, error dicatat di log file
            Log::error('Gagal mengirim webhook ke n8n: ' . $e->getMessage());
        }

        return redirect()->route('posts.index')->with('success', 'Curhatanmu berhasil dibagikan!');
    }
}