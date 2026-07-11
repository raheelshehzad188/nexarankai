@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Clean Air';
    $menus = \App\Models\Menu::getByLocation('header');
    $currentPath = trim(request()->path(), '/');

    $logoUrl = 'https://clean-air.ae/uploads/clean-air-head-logo.webp';
    if ($settings->site_logo) {
        $logoPath = \Illuminate\Support\Str::startsWith($settings->site_logo, 'uploads/')
            ? $settings->site_logo
            : 'uploads/' . ltrim($settings->site_logo, '/');
        $logoUrl = asset($logoPath);
    }

    $ctaUrl = $settings->header_cta_url ?? '#';
    $ctaText = $settings->header_cta_text ?? 'On Call Maintenance';
@endphp

<header class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}">
                </a>
            </div>

            <nav class="nav-menu" id="navMenu">
                <ul>
                    @if($menus->count() > 0)
                        @foreach($menus as $menu)
                            @php
                                $menuPath = trim(parse_url($menu->getUrl(), PHP_URL_PATH) ?? '', '/');
                                $isActive = $currentPath === $menuPath || ($currentPath === '' && $menuPath === 'home');
                            @endphp
                            <li>
                                <a href="{{ $menu->getUrl() }}" class="{{ $isActive ? 'active' : '' }}">{{ $menu->title }}</a>
                            </li>
                        @endforeach
                    @else
                        <li><a class="{{ $currentPath === '' || $currentPath === 'home' ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Benefits</a></li>
                        <li><a href="#">Gallery</a></li>
                        <li><a href="{{ url('/blog') }}">Blog</a></li>
                        <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                    @endif
                </ul>
            </nav>

            <div class="header-btn">
                <a href="{{ $ctaUrl }}" class="btn-primary">{{ $ctaText }}</a>
            </div>

            <button class="menu-toggle" id="menuToggle" type="button" aria-label="Toggle menu">
                ☰
            </button>
        </div>
    </div>
</header>
<div class="menu-overlay" id="menuOverlay"></div>
