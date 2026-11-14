<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Support\CrisisSafety;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Tambahkan ini
use Illuminate\Support\Facades\Log;  // Tambahkan ini
use Illuminate\Support\Str;

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


        // 1b. Curhat berisi tanda krisis: balas langsung dengan teks tetap,
        //     tanpa menunggu n8n atau model AI, lalu selesai.
        if (CrisisSafety::detect($post->body)) {
            $aiUser = User::firstOrCreate(
                ['email' => 'hermes@konselor.local'],
                [
                    'name' => 'Hermes AI',
                    'password' => bcrypt(Str::random(32)),
                ]
            );

            $post->comments()->create([
                'body' => CrisisSafety::REPLY,
                'user_id' => $aiUser->id,
            ]);

            Log::info('Curhat krisis dijawab pengaman tetap.', ['post_id' => $post->id]);

            return redirect()->route('posts.index')->with('success', 'Curhatanmu berhasil dibagikan!');
        }

        // 2. Kirim data ke n8n melalui Webhook
        try {
            $webhookUrl = config('services.n8n.webhook_url');

            if (!$webhookUrl) {
                Log::error('N8N_WEBHOOK_URL belum dikonfigurasi.');
            } else {
                $response = Http::timeout(3)
                    ->acceptJson()
                    ->withHeaders(['X-Console-Secret' => (string) config('services.n8n.webhook_secret')])
                    ->post($webhookUrl, [
                        'post_id' => $post->id,
                        'author' => $post->is_anonymous
                            ? 'Anonim'
                            : $request->user()->name,
                        'body' => $post->body,
                        'timestamp' => $post->created_at->toIso8601String(),
                    ]);

                if ($response->successful()) {
                    Log::info('Webhook n8n berhasil dipanggil.', [
                        'post_id' => $post->id,
                        'status' => $response->status(),
                    ]);
                } else {
                    Log::error('Webhook n8n gagal merespons sukses.', [
                        'post_id' => $post->id,
                        'status' => $response->status(),
                        'response' => $response->body(),
                    ]);
                }
            }
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim webhook ke n8n.', [
                'post_id' => $post->id,
                'error' => $e->getMessage(),
            ]);
        }


        return redirect()->route('posts.index')->with('success', 'Curhatanmu berhasil dibagikan!');
    }
}