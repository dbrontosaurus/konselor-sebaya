<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Support\CrisisSafety;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $token = (string) (config('services.n8n.hermes_webhook_token') ?? env('HERMES_WEBHOOK_TOKEN'));
        $expectedToken = 'Bearer ' . $token;

        if ($token === '' || ! hash_equals($expectedToken, (string) $request->header('Authorization'))) {
            return response()->json(['message' => 'Akses ditolak'], 401);
        }

        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
        ]);

        $post = Post::findOrFail($request->post_id);

        // Cek indikasi krisis pada isi postingan curhat maupun balasan model
        $postText = (string) ($post->body ?? $post->content ?? '');
        $isCrisis = CrisisSafety::detect($postText) || CrisisSafety::detect($request->body);

        $replyBody = $isCrisis
            ? CrisisSafety::REPLY
            : $this->cleanText($request->body);

        // Cari atau buat otomatis User khusus untuk Hermes AI
        $aiUser = User::firstOrCreate(
            ['email' => 'hermes@konselor.local'],
            [
                'name' => 'Hermes AI',
                'password' => bcrypt(Str::random(32)),
            ]
        );

        // Simpan komentar AI ke postingan yang sesuai
        $post->comments()->create([
            'body' => $replyBody,
            'user_id' => $aiUser->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Balasan Hermes AI berhasil ditambahkan!',
        ]);
    }

    private function cleanText(string $text): string
    {
        $text = preg_replace('/\*\*(.+?)\*\*/s', '$1', $text);
        $text = preg_replace('/(^|\s)\*(\S[^*]*?)\*(?=\s|$)/', '$1$2', $text);
        $text = str_replace('`', '', $text);
        $text = preg_replace('/^#{1,6}\s+/m', '', $text);
        $text = preg_replace("/\n{3,}/", "\n\n", $text);

        return trim((string) $text);
    }
}