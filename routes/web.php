<?php

declare(strict_types=1);

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::post('/kontakt', [ContactController::class, 'store'])
    ->middleware('throttle:10,60')
    ->name('contact.store');
