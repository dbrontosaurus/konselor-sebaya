<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController; // Pastikan ini ditambahkan di atas

Route::get('/', function () {
    return view('welcome'); // Ini halaman landing page bawaan
});

Auth::routes();

// Route untuk menampilkan feed curhatan
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

// Ubah redirect bawaan /home agar mengarah ke /posts
Route::get('/home', function () {
    return redirect()->route('posts.index');
})->middleware('auth');