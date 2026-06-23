<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VillaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\SitemapController;

Route::get('/', function () {
    return redirect('/id');
});

Route::group(['prefix' => '{locale}', 'middleware' => ['locale']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/the-villa', [VillaController::class, 'index'])->name('the-villa');
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/journey', [JourneyController::class, 'index'])->name('journey.index');
    Route::get('/journey/{slug}', [JourneyController::class, 'show'])->name('journey.show');

    // 301 redirect legacy /journal to /journey
    Route::redirect('/journal', '/journey', 301);
});

// Legacy redirects
Route::get('/the-villa', fn() => redirect('/id/the-villa', 301));
Route::get('/gallery', fn() => redirect('/id/gallery', 301));
Route::get('/journey', fn() => redirect('/id/journey', 301));
Route::get('/journey/{slug}', fn($slug) => redirect('/id/journey/'.$slug, 301));

// SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// Newsletter
use App\Http\Controllers\NewsletterController;
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe')
    ->middleware('throttle:5,1'); // Membatasi maksimal 5 request per menit per IP untuk mencegah spam