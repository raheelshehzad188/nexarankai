@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
    $menus = \App\Models\Menu::getByLocation('header');

    $assets_url = asset('assets/dubai/www.proclean-ac.com');
    $currentUrl = request()->path();
@endphp
<style>
.logo-bx {
    width: 200px;
    height: 86px;
}
    .icon-horizontal-heading{
        color: #fff !important;
    }
    .navbar-justify-between{
        justify-content: flex-start !important;
    }
    
    .nbar-custrom-bg{
        background-color: transparent !important;
    }
    .custom-header-bg{
        background-color: transparent !important;
    }
    .custom-css-logo{
        padding: 10px 0px !important;
    }
    
    
    .navbar-container {
        transition: background-color 0.3s ease, box-shadow 0.3s ease, backdrop-filter 0.3s ease;
    }
    
    
    .navbar-container.scrolled {
        background-color: var(--pro-clean-blue) !important; /* #1C1F48 */
        backdrop-filter: blur(8px);
        box-shadow: 0 2px 12px rgba(0,0,0,0.25);
    }
    
    
    .navbar-container.scrolled .nav-link,
    .navbar-container.scrolled .w-nav-link,
    .navbar-container.scrolled .dropdown-toggle {
        color: #fff !important;
    }
    
    .nbar-custom-menu{
        width: 68% !important;
        display: flex;
        justify-content:flex-end !important;
    }
    .nbar-right-contact{
        width: 32%;
        display: flex;
        justify-content:center !important;
    }
    .nbar-right-contact a{
        text-decoration: none;
        background-color: var(--pro-clean-blue);
        padding: 15px 20px;
        color: #fff;
        border-radius: 4px;
    }
    .navbar-container.scrolled .nbar-right-contact a {
       background-color: var(--gray-2); /* clean neutral gray */
       color: var(--pro-clean-blue);
    }
    
    /*@media (max-width: 1000px) {*/
    /*   .nbar-right-contact {*/
    /*        display: none !important;*/
    /*    }*/
    /*}*/
    .custom-dropdown{
        border:none !important;
    }
    .custom-dropdown.w-dropdown-list .w-dropdown-link:hover {
     color: #fff !important;
    }

</style>
<script>
    window.addEventListener('scroll', function () {
        const header = document.querySelector('.navbar-container');

        if (window.scrollY > 80) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    

</script>
<div class="navbar-container sticky-top bg-white nbar-custrom-bg">
    <div class="main-container div-block-3 custom-header-bg">
        <div data-collapse="medium" data-animation="default" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
            <div class="navbar-justify-between">
                <div class="navbar-right-contents nbar-custom-menu">
                    <nav role="navigation" class="nav-menu nav-menu-right-aligned w-nav-menu">
                        @foreach($menus as $menu)
                            @if($menu->children->count() > 0)
                                <div data-delay="200" data-hover="true" class="dropdown-copy w-dropdown">
                                    <div class="nav-link w-dropdown-toggle">
                                        <div>{{ $menu->title }}</div>
                                        <img src="{{ $assets_url }}/../imgs/5f873812a9678846e70e2e8e_Drop%20Down%20Icon.png" alt="Drop Down Icon" class="dropdown-icon"/>
                                    </div>
                                    <nav class="dropdown-list w-dropdown-list custom-dropdown">
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
						<a href="https://clean-air.ae/blog/" class="nav-link w-nav-link ">Blog</a>
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
                        <img src="{{ $assets_url }}/../imgs/5f873678a4d7685ff0cb809c_Menu%20Button.png" alt="Menu Button" class="menu-button-image"/>
                        <img src="{{ $assets_url }}/../imgs/5f873794bd12173b2bcf0396_Close%20Menu%20Button.png" alt="Close Menu Button" class="menu-button-close-image"/>
                    </div>
                </div>
                <!--contact-us-removed-->
            </div>
        </div>
    </div>
</div>
