<?php

declare(strict_types=1);

use App\Http\Controllers\ClimbingController;
use App\Http\Controllers\ClimbingNewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

/*
 * Subdomain catch-all → /lezeckastena.
 *
 * Both lezeckastena.vyskovepracerys.cz (legacy) and the new shorter
 * stena.vyskovepracerys.cz point at the same Laravel app; every path
 * is 301-redirected onto the equivalent /lezeckastena/… URL on the
 * main domain. Declared before the main routes so the host match
 * takes precedence.
 */
foreach ([
    'stena.vyskovepracerys.cz',
    'lezeckastena.vyskovepracerys.cz',
] as $climbingHost) {
    Route::domain($climbingHost)->group(function (): void {
        Route::any('{any?}', [ClimbingController::class, 'redirectFromSubdomain'])
            ->where('any', '.*');
    });
}

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
