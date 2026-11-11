<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    /**
     * Meneruskan pesan dari widget chatbot ke webhook n8n
     * (n8n -> OpenRouter) dan mengembalikan balasan dalam bentuk JSON.
     */
    public function send(Request $request): JsonResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'history' => ['nullable', 'array', 'max:10'],
            'history.*.role' => ['required_with:history', 'in:user,bot'],
            'history.*.text' => ['required_with:history', 'string', 'max:1000'],
        ]);

        $url = config('services.n8n.chat_webhook');

        if (! $url) {
            return response()->json([
                'reply' => 'Chatbot belum dikonfigurasi. Hubungi pengelola Console-Ing.',
            ], 503);
        }

        try {
            $response = Http::timeout(60)->acceptJson()->post($url, [
                'message' => $data['message'],
                'history' => $data['history'] ?? [],
                'session_id' => $request->session()->getId(),
            ]);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'reply' => 'Bot sedang tidak bisa dihubungi. Coba lagi sebentar.',
            ], 502);
        }

        if ($response->failed()) {
            return response()->json([
                'reply' => 'Bot sedang tidak bisa menjawab. Coba lagi sebentar.',
            ], 502);
        }

        // Sesuaikan dengan field yang dikembalikan node "Respond to Webhook" di n8n.
        $json = $response->json();
        $reply = is_array($json)
            ? (data_get($json, 'reply')
                ?? data_get($json, 'output')
                ?? data_get($json, 'text')
                ?? data_get($json, 'message')
                ?? data_get($json, '0.output')
                ?? data_get($json, '0.reply'))
            : null;

        $reply ??= trim($response->body());

        return response()->json(['reply' => $reply !== '' ? $reply : 'Bot belum punya jawaban. Coba tulis ulang pesanmu.']);
    }
}
