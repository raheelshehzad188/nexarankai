<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClientLogoController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// ============================================
// FRONTEND ROUTES
// ============================================

// Home Page (Root)
Route::get('/', function () {
    $page = \App\Models\Page::where('slug', 'home')
        ->where('status', 'published')
        ->with(['sections' => function ($query) {
            $query->where('status', true)->orderBy('sort_order');
        }])
        ->first();

    if (!$page) {
        // Show frontend page with list of published pages if home page doesn't exist
        $pages = \App\Models\Page::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'title', 'slug']);
        return view('frontend.home', compact('pages'));
    }

    return view('frontend.page', compact('page'));
})->name('home');

// ============================================
// STATIC ROUTES (Must be defined BEFORE dynamic routes)
// ============================================
// These routes will NOT be caught by the dynamic page route
// Add any static routes here before the catch-all {slug} route

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Add more static routes here as needed:
// Route::get('/special-page', function () { ... })->name('special');
// Route::get('/about-us', function () { ... })->name('about');
// Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// ============================================
// DYNAMIC PAGE ROUTES (Catch-all - Must be LAST)
// ============================================
// This route handles ALL dynamic pages from database
// Any URL that doesn't match above routes will be checked against database pages
// Example: /about, /services, /contact-us, etc. (if they exist in pages table)
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Auth Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware(['auth'])->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Site Settings
        Route::get('/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SiteSettingController::class, 'update'])->name('settings.update');

        // Resource Routes
        Route::resource('menus', MenuController::class);
        Route::resource('pages', AdminPageController::class);
        Route::resource('page-sections', PageSectionController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('client-logos', ClientLogoController::class);
        Route::resource('leads', LeadController::class)->only(['index', 'show', 'destroy']);
    });
});
