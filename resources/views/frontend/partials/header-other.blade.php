@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
    $menus = \App\Models\Menu::getByLocation('header');
    $currentUrl = request()->path();
@endphp

<div class="navbar-container sticky-top bg-white">
    <div class="main-container div-block-3">
        <div data-collapse="medium" data-animation="default" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
            <div class="navbar-justify-between">
                <a href="/" class="brand w-nav-brand {{ $currentUrl === '/' || $currentUrl === 'home' ? 'w--current' : '' }}">
                    @if($settings->site_logo)
                        @php
                            $logoPath = \Illuminate\Support\Str::startsWith($settings->site_logo, 'uploads/')
                                ? $settings->site_logo
                                : 'uploads/' . ltrim($settings->site_logo, '/');
                        @endphp
                        <img src="{{ asset($logoPath) }}" width="125" alt="{{ $siteName }} Cleaning Dubai Logo"/>
                    @else
                        <span>{{ $siteName }}</span>
                    @endif
                </a>
                <div class="navbar-right-contents">
                    <nav role="navigation" class="nav-menu nav-menu-right-aligned w-nav-menu">
                        @foreach($menus as $menu)
                            @if($menu->children->count() > 0)
                                <div data-delay="200" data-hover="true" class="dropdown-copy w-dropdown">
                                    <div class="nav-link w-dropdown-toggle">
                                        <div>{{ $menu->title }}</div>
                                        <img src="{{ asset('assets/dubai/imgs/5f873812a9678846e70e2e8e_Drop%20Down%20Icon.png') }}" alt="Drop Down Icon" class="dropdown-icon"/>
                                    </div>
                                    <nav class="dropdown-list w-dropdown-list">
                                        <div>
                                            @foreach($menu->children as $child)
                                                <a href="{{ $child->getUrl() }}" class="dropdown-link-mobile w-dropdown-link">{{ $child->title }}</a>
                                            @endforeach
                                        </div>
                                    </nav>
                                </div>
                            @else
                                <a href="{{ $menu->getUrl() }}" class="nav-link w-nav-link {{ $currentUrl === ltrim($menu->getUrl(), '/') ? 'w--current' : '' }}">{{ $menu->title }}</a>
                            @endif
                        @endforeach
                    </nav>
                    <div class="navbar-functions">
                        @if($settings->header_cta_text && $settings->header_cta_link)
                            <a href="{{ $settings->header_cta_link }}" class="button landscape-mobile w-inline-block">
                                <div>{{ $settings->header_cta_text }}</div>
                            </a>
                        @endif
                        @if($settings->header_phone)
                            <a href="tel:{{ $settings->header_phone }}" class="button-mobile w-inline-block">
                                <div>Call Us</div>
                            </a>
                        @endif
                    </div>
                    <div class="menu-button w-nav-button">
                        <img src="{{ asset('assets/dubai/imgs/5f873678a4d7685ff0cb809c_Menu%20Button.png') }}" alt="Menu Button" class="menu-button-image"/>
                        <img src="{{ asset('assets/dubai/imgs/5f873794bd12173b2bcf0396_Close%20Menu%20Button.png') }}" alt="Close Menu Button" class="menu-button-close-image"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
