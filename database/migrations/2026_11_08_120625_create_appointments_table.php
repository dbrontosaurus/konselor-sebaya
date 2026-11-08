<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            // Menghubungkan jadwal dengan mahasiswa yang membuatnya
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Pilihan sesi konseling
            $table->enum('type', ['online', 'offline']);
            // Tanggal dan jam pelaksanaan
            $table->dateTime('scheduled_at');
            // Status persetujuan jadwal
            $table->enum('status', ['pending', 'approved', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
