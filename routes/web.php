<?php

declare(strict_types=1);

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/media/{media}/stream', [MediaController::class, 'stream'])
    ->name('media.stream');

Route::post('/kontakt', [ContactController::class, 'store'])
    ->middleware('throttle:10,60')
    ->name('contact.store');
