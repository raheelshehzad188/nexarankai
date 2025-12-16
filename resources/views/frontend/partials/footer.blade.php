@php
    $settings = \App\Models\SiteSetting::getSettings();
    $menus = \App\Models\Menu::getByLocation('footer');
    $assets_url = asset('assets/dubai/www.proclean-ac.com');
    
    // Group footer menus - get all menus including children
    $allFooterMenus = \App\Models\Menu::where('location', 'footer')
        ->where('status', true)
        ->orderBy('sort_order')
        ->with('parent')
        ->get();
    
    $pageMenus = $allFooterMenus->filter(function($menu) {
        return $menu->link_type === 'page' && !$menu->parent_id;
    });
    
    $serviceMenus = $allFooterMenus->filter(function($menu) {
        if ($menu->link_type === 'page' && $menu->parent_id && $menu->parent) {
            return $menu->parent->title === 'Our Services' || str_contains(strtolower($menu->title), 'service');
        }
        return false;
    });
    
    $socialLinks = $settings->social_links ?? [];
@endphp

<div class="footer-2">
    <div class="main-container">
        <div class="footer-2-top-row">
            <div class="container-small">
                <a href="/" class="footer-2-logo w-inline-block">
                    @if($settings->site_logo)
                        <img src="{{ asset('storage/' . $settings->site_logo) }}" width="160" alt="Pro Clean AC Logo"/>
                    @else
                        <span>Pro Clean AC</span>
                    @endif
                </a>
                @if($settings->footer_text)
                    <div class="text-block-2">{{ $settings->footer_text }}</div>
                @endif
            </div>
            <div class="footer-2-menus-container">
                <div class="container-large align-center">
                    <div class="w-layout-grid footer-2-menus-grid">
                        @if($pageMenus->count() > 0)
                            <div class="div-block">
                                <h6 class="footer-menu-heading">Pages</h6>
                                <div class="w-layout-grid menu-grid-vertical">
                                    @foreach($pageMenus->take(4) as $menu)
                                        <a href="{{ $menu->getUrl() }}" class="hover-link">{{ $menu->title }}</a>
                                    @endforeach
                                </div>
                                @if($pageMenus->count() > 4)
                                    @foreach($pageMenus->skip(4) as $menu)
                                        <a href="{{ $menu->getUrl() }}" class="hover-link">{{ $menu->title }}</a>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                        
                        @if($serviceMenus->count() > 0)
                            <div>
                                <h6 class="footer-menu-heading">Services</h6>
                                <div class="w-layout-grid footer-2-contact-details">
                                    <div class="w-layout-grid menu-grid-vertical">
                                        @foreach($serviceMenus as $menu)
                                            <a href="{{ $menu->getUrl() }}" class="hover-link">{{ $menu->title }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <div>
                            <h6 class="footer-menu-heading">Contact</h6>
                            <div class="w-layout-grid footer-2-contact-details">
                                @if($settings->header_email)
                                    <a href="mailto:{{ $settings->header_email }}" target="_blank" class="icon-horizontal w-inline-block">
                                        <img src="{{ $assets_url }}/../imgs/5f32dc9061944218a6e96ef4_envelope-small.svg" alt="envelope" class="image-13"/>
                                        <div class="icon-horizontal-heading reduced-margin">{{ $settings->header_email }}</div>
                                    </a>
                                @endif
                                @if($settings->header_phone)
                                    <a href="tel:{{ $settings->header_phone }}" class="icon-horizontal w-inline-block">
                                        <img src="{{ $assets_url }}/../imgs/5f32dc9061944298f8e96ffa_phone.svg" width="28" alt="Phone" class="image-14"/>
                                        <div class="icon-horizontal-heading reduced-margin">{{ $settings->header_phone }}</div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-row">
            <div class="footer-bottom-links">
                <div class="text-block-4">© Copyright Pro Clean AC {{ date('Y') }} powered by</div>
                <a href="mailto:alexlewis.buckley@gmail.com?subject=help%20with%20my%20website!" class="link-white">AB Creative</a>
            </div>
            <div class="social-links">
                @foreach($socialLinks as $social)
                    @if(isset($social['platform']) && isset($social['url']))
                        @if($social['platform'] === 'instagram')
                            <a href="{{ $social['url'] }}" target="_blank" class="social-link hover-link w-inline-block">
                                <img src="{{ $assets_url }}/../imgs/5f7f553f4cd6680289523cd1_IG.png" alt="IG" class="social-link-image"/>
                            </a>
                        @elseif($social['platform'] === 'youtube')
                            <a href="{{ $social['url'] }}" target="_blank" class="social-link hover-link w-inline-block">
                                <img src="{{ $assets_url }}/../imgs/5f7f553f6e405a7c57cf2ee0_Youtube.png" alt="Youtube" class="social-link-image"/>
                            </a>
                        @elseif($social['platform'] === 'facebook')
                            <a href="{{ $social['url'] }}" target="_blank" class="social-link hover-link w-inline-block">
                                <img src="{{ $assets_url }}/../imgs/5f7f553f41abca2fb1d167df_Facebook.png" alt="Facebook" class="social-link-image"/>
                            </a>
                        @elseif($social['platform'] === 'nadca')
                            <a href="{{ $social['url'] }}" target="_blank" class="social-link hover-link w-inline-block">
                                <img src="{{ $assets_url }}/../imgs/65c9ac6a6a04bc152dbaa67c_Nadca.png" alt="National Air Duct Cleaners Association (NADCA) logo" class="social-link-image"/>
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
