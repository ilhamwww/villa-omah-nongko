<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VillaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\SitemapController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/the-villa', [VillaController::class, 'index'])->name('the-villa');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/journey', [JourneyController::class, 'index'])->name('journey.index');
Route::get('/journey/{slug}', [JourneyController::class, 'show'])->name('journey.show');

// 301 redirect legacy /journal to /journey
Route::redirect('/journal', '/journey', 301);

// SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');