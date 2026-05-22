<?php

declare(strict_types=1);

use App\Http\Controllers\ClimbingController;
use App\Http\Controllers\ClimbingNewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

/*
 * Subdomain catch-all: stena.vyskovepracerys.cz → /lezeckastena/…
 *
 * Production handles this at the Nginx vhost level (return 301 …) for
 * speed; the Laravel route stays as a safety net for the case where
 * the vhost forwards the request to the app instead.
 */
Route::domain('stena.vyskovepracerys.cz')->group(function (): void {
    Route::any('{any?}', [ClimbingController::class, 'redirectFromSubdomain'])
        ->where('any', '.*')
        ->name('climbing.subdomain.redirect');
});

Route::get('/', HomeController::class)->name('home');

Route::get('/media/{media}/stream', [MediaController::class, 'stream'])
    ->name('media.stream');

Route::post('/kontakt', [ContactController::class, 'store'])
    ->middleware('throttle:10,60')
    ->name('contact.store');

Route::prefix('lezeckastena')->name('climbing.')->group(function (): void {
    Route::get('/', [ClimbingController::class, 'home'])->name('home');
    Route::get('/o-stene', [ClimbingController::class, 'about'])->name('about');
    Route::get('/cenik', [ClimbingController::class, 'pricing'])->name('pricing');
    Route::get('/krouzky', [ClimbingController::class, 'programs'])->name('programs');
    Route::get('/kontakt', [ClimbingController::class, 'contact'])->name('contact');

    Route::get('/aktuality', [ClimbingNewsController::class, 'index'])->name('news.index');
    Route::get('/aktuality/{post}', [ClimbingNewsController::class, 'show'])->name('news.show');
});
