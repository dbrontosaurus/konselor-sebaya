<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

// Endpoint untuk menerima balasan dari n8n/Hermes
Route::post('/webhook/hermes-reply', [CommentController::class, 'storeAi']);