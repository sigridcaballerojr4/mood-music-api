<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MusicController;

Route::get('/moods', [MusicController::class, 'moods']);
Route::get('/music', [MusicController::class, 'music']);
