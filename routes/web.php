<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome'); // Ini halaman landing page bawaan
});

Auth::routes();

// Route untuk menampilkan feed curhatan
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

// Route untuk melihat detail curhat
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');
// Route untuk mengirim komentar
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

// Ubah redirect bawaan /home agar mengarah ke /posts
Route::get('/home', function () {
    return redirect()->route('posts.index');
})->middleware('auth');
