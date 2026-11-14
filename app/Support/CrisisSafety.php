<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Jaring pengaman untuk pesan krisis. Dipakai chatbot dan alur curhat.
 * Bukan detektor sempurna: frasa yang tidak ada di daftar tetap lewat ke model.
 */
class CrisisSafety
{
    public const REPLY =
        "Aku dengar kamu, dan aku peduli sama kamu. Yang kamu rasakan terdengar sangat berat, " .
        "dan kamu tidak harus menghadapinya sendirian.\n\n" .
        "Kalau kamu merasa tidak aman sekarang, tolong hubungi orang yang kamu percaya di dekatmu, " .
        "atau telepon Healing119 dari Kementerian Kesehatan di 119 ekstensi 8, atau buka healing119.id.\n\n" .
        "Aku tetap di sini kalau kamu mau bercerita. Kamu juga bisa membuat jadwal konseling lewat menu Jadwal Saya.";

    private const PHRASES = [
        // mengakhiri hidup
        'bunuh diri', 'suicide', 'kill myself',
        'mengakhiri hidup', 'akhiri hidup', 'ngakhiri hidup', 'mengakhiri semuanya', 'akhiri semuanya',
        'ingin mati', 'pengen mati', 'pingin mati', 'mau mati', 'lebih baik mati', 'want to die',
        'tidak ingin hidup', 'tak ingin hidup', 'tidak mau hidup', 'tak mau hidup',
        'gak mau hidup', 'nggak mau hidup', 'ga mau hidup',
        'capek hidup', 'lelah hidup',
        'tidak ada gunanya hidup', 'gak ada gunanya hidup', 'nggak ada gunanya hidup', 'ga ada gunanya hidup',
        'tidur selamanya', 'tidak bangun lagi', 'gak bangun lagi',
        'lebih baik aku tidak ada', 'lebih baik aku gak ada', 'lebih baik aku nggak ada', 'lebih baik aku ga ada',
        'sebaiknya aku tidak ada', 'sebaiknya aku gak ada',
        // menyakiti diri
        'menyakiti diri', 'melukai diri', 'lukai diri', 'self harm', 'selfharm',
        'gantung diri', 'overdosis', 'sayat tangan', 'menyayat',
        // ingin menghilang
        'menghilang dari dunia', 'ngilang dari dunia', 'ngilang aja dari dunia', 'hilang dari dunia ini',
        'ingin menghilang', 'pengen menghilang', 'pingin menghilang',
        'pengen ngilang', 'pingin ngilang',
    ];

    public static function detect(string $text): bool
    {
        $clean = (string) Str::of($text)
            ->lower()
            ->replaceMatches('/[^\p{L}\p{N}\s]+/u', ' ')
            ->squish();

        foreach (self::PHRASES as $phrase) {
            if (str_contains($clean, $phrase)) {
                return true;
            }
        }

        return false;
    }
}