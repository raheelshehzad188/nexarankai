<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClientLogoController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController as FrontendServiceController;
use Illuminate\Support\Facades\Route;

// ============================================
// FRONTEND ROUTES
// ============================================
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return 'All caches cleared successfully';
});
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

// Sitemap regenerate - link click karo, sitemap naya ban jayega
Route::get('/sitemap-update', function () {
    
    try {
        $url = app(App\Services\SitemapGenerator::class)->generate();
        return 'Sitemap updated! <a href="' . $url . '">View sitemap</a>';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->name('sitemap.update');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', function () {
    $page = \App\Models\Page::where('slug', 'contact')
        ->where('status', 'published')
        ->with(['sections' => function ($query) {
            $query->where('status', true)->orderBy('sort_order');
        }])
        ->first();
    
    if (!$page) {
        abort(404, 'Contact page not found. Please create a page with slug "contact" in admin panel.');
    }

    $bodyClass = 'irhas3 contact3';
    
    return view('frontend.page', compact('page', 'bodyClass'));
})->name('contact');

Route::get('/blog/category/{blogCategory:slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{blogPost:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/services/{service:slug}', [FrontendServiceController::class, 'show'])->name('services.show');
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
        // Site Settings
        Route::get('/settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SiteSettingController::class, 'update'])->name('settings.update');
        Route::post('/settings/generate-sitemap', [SiteSettingController::class, 'generateSitemap'])->name('settings.generate-sitemap');
        Route::get('/settings/regenerate-sitemap', [SiteSettingController::class, 'generateSitemap'])->name('settings.regenerate-sitemap');

        // Profile
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.update-password');

        // Resource Routes
        Route::resource('menus', MenuController::class);
        Route::resource('pages', AdminPageController::class);
        Route::resource('page-sections', PageSectionController::class);
        Route::resource('blog-categories', BlogCategoryController::class);
        Route::resource('blog-posts', BlogPostController::class);
        Route::resource('service-categories', ServiceCategoryController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('client-logos', ClientLogoController::class);
        Route::resource('leads', LeadController::class)->only(['index', 'show', 'destroy']);
        Route::resource('section-types', \App\Http\Controllers\Admin\SectionTypeController::class);
        
        // Media routes
        Route::get('/media/section/{sectionType?}', [MediaController::class, 'getBySectionType'])->name('media.by-section');
        Route::post('/media', [MediaController::class, 'store'])->name('media.store');
        Route::post('/media/scan', [MediaController::class, 'scanUploads'])->name('media.scan');
    });
});
