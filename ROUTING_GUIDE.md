# Routing Guide - Dynamic Pages

## How Dynamic Pages Work

### 1. **Static Routes (Specific Routes)**
Static routes must be defined **BEFORE** the catch-all `/{slug}` route.

```php
// ✅ Correct - Static routes first
Route::get('/test', function () {
    return view('frontend.test');
})->name('test');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// ✅ Then dynamic route last
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
```

### 2. **Dynamic Pages Route (Catch-all)**
The `/{slug}` route catches all URLs that don't match static routes and checks the database:

```php
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
```

**How it works:**
- User visits: `http://localhost/ac_site/about`
- Laravel checks if `/about` matches any static route → No
- Falls to `/{slug}` route → `$slug = 'about'`
- `PageController@show` searches database for page with `slug = 'about'`
- If found → Shows the page
- If not found → 404 error

### 3. **Route Priority Order**

Routes are matched in the order they are defined:

```php
// 1. Home page (root)
Route::get('/', ...);

// 2. Static routes (specific URLs)
Route::get('/test', ...);
Route::get('/contact', ...);
Route::post('/contact', ...);

// 3. Dynamic route (catch-all - MUST BE LAST)
Route::get('/{slug}', [PageController::class, 'show']);
```

## Examples

### Adding a Static Route

If you want a specific route that should NOT be handled by dynamic pages:

```php
// Add before {slug} route
Route::get('/special-page', function () {
    return view('frontend.special');
})->name('special');
```

### Creating Dynamic Pages

1. Go to Admin Panel: `/admin/login`
2. Navigate to: **Pages** → **Create New Page**
3. Fill in:
   - **Title**: "About Us"
   - **Slug**: "about-us" (auto-generated from title)
   - **Status**: "Published"
4. Add sections to the page
5. Visit: `http://localhost/ac_site/about-us`

The page will automatically be accessible via the dynamic route!

## Important Notes

⚠️ **Route Conflicts:**
- If you create a page with slug `test`, it will NOT work because `/test` is already a static route
- Static routes always take priority over dynamic routes

✅ **Best Practice:**
- Use static routes for special pages (contact forms, thank you pages, etc.)
- Use dynamic pages for content pages (about, services, blog posts, etc.)

## Current Static Routes

- `/` - Home page
- `/test` - Test page
- `/contact` (POST) - Contact form submission
- `/admin/*` - Admin panel routes

All other URLs are handled by dynamic pages from the database.

