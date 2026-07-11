@php
    use App\Support\IrhasSectionData as I;
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Irhas';
    $menus = \App\Models\Menu::getByLocation('header');
    $logoUrl = I::themeAsset('img/irhas3.png');
    if ($settings->site_logo) {
        $logoUrl = I::themeAsset($settings->site_logo);
    }
    $phone = $settings->header_phone ?? '+62 800 1402';
    $phoneHref = $phone ? 'tel:' . preg_replace('/[^0-9+]/', '', $phone) : '#';
    $ctaText = $settings->header_cta_text;
    $ctaUrl = $settings->header_cta_link ?: '#';
    $currentPath = trim(request()->path(), '/');
@endphp
<header id="header">
    <div class="header-style-3">
        <div class="thaw-container">
            <div class="header-style3-wrap grid grid-cols-12">
                <div class="header-content-left col-span-9 res:col-span-12 sm:col-span-12 grid grid-cols-12">
                    <div class="logo col-span-3">
                        <a href="{{ url('/') }}">
                            <img src="{{ $logoUrl }}" alt="{{ $siteName }}" />
                        </a>
                    </div>
                    <nav class="main-nav col-span-9 sm:col-span-12">
                        <input id="main-menu-state" type="checkbox" />
                        <label class="main-menu-btn" for="main-menu-state">
                            <span class="main-menu-btn-icon"></span> Toggle main menu visibility
                        </label>
                        <ul id="main-menu" class="sm sm-clean">
                            @if($menus->count() > 0)
                                @foreach($menus as $menu)
                                    @php
                                        $menuPath = trim(parse_url($menu->getUrl(), PHP_URL_PATH) ?? '', '/');
                                        $isActive = $currentPath === $menuPath || ($currentPath === '' && $menuPath === '');
                                    @endphp
                                    <li class="menu-item {{ $menu->children->count() ? 'has-submenu' : '' }} {{ $isActive ? 'current-menu-item' : '' }}">
                                        <a href="{{ $menu->getUrl() }}">{{ $menu->title }}</a>
                                        @if($menu->children->count())
                                            <ul class="sub-menu">
                                                @foreach($menu->children as $child)
                                                    @php
                                                        $childPath = trim(parse_url($child->getUrl(), PHP_URL_PATH) ?? '', '/');
                                                        $isChildActive = $currentPath === $childPath;
                                                    @endphp
                                                    <li class="menu-item-sub {{ $isChildActive ? 'current-menu-item' : '' }}"><a href="{{ $child->getUrl() }}">{{ $child->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <li class="menu-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="menu-item"><a href="#">Project</a></li>
                                <li class="menu-item"><a href="#">Service</a></li>
                                <li class="menu-item"><a href="#">About</a></li>
                                <li class="menu-item"><a href="#">Blog</a></li>
                                <li class="menu-item"><a href="#">Contact</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="header-content-right col-span-3">
                    <div class="content-right-area">
                        <ul class="right-area-menu">
                            @if($phone)
                                <li class="right-area-item">
                                    <a class="phone-number" href="{{ $phoneHref }}">{{ $phone }}</a>
                                </li>
                            @endif
                            @if($ctaText)
                                <li class="right-area-item">
                                    <a href="{{ $ctaUrl }}" class="button button-head-item">{{ $ctaText }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
