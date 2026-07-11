@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
    $menus = \App\Models\Menu::getByLocation('footer');
    
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
<style>
    .footer-logo-custom{
        width: 275px !important;
    }
</style>

<div class="footer-2">
    <div class="main-container">
        <div class="footer-2-top-row">
            <div class="container-small">
                <a href="/" class="footer-2-logo w-inline-block">
                    @if($settings->site_logo)
                        @php
                            $logoPath = \Illuminate\Support\Str::startsWith($settings->site_logo, 'uploads/')
                                ? $settings->site_logo
                                : 'uploads/' . ltrim($settings->site_logo, '/');
                        @endphp
                        <img class="footer-logo-custom" src="{{ asset($logoPath) }}" width="160" alt="{{ $siteName }} Logo">
                    @else
                        <span>{{ $siteName }}</span>
                    @endif
                </a>
                @if($settings->footer_text)
                    <div class="text-block-2">{{ $settings->footer_text }}</div>
                @endif
            </div>
            <div class="footer-2-menus-container">
                <div class="container-large1 align-center">
                    <div class="w-layout-grid footer-2-menus-grid">
                        @if($pageMenus->count() > 0)
                            <div class="div-block">
                                <h6 class="footer-menu-heading">Pages</h6>
                                <div class="w-layout-grid menu-grid-vertical">
                                    @foreach($pageMenus->take(4) as $menu)
                                        <a href="{{ $menu->getUrl() }}" class="hover-link">{{ $menu->title }}</a>
                                    @endforeach
									<a href="https://clean-air.ae/blog/" class="hover-link">Blog</a>
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
                                        <img src="https://clean-air.ae/public/uploads/form-icons/footer-email-icon.png" alt="envelope" class="icon-form-input-image">
                                        <div class="icon-horizontal-heading reduced-margin">{{ $settings->header_email }}</div>
                                    </a>
                                @endif
                                @if($settings->header_phone)
                                    <a href="tel:{{ $settings->header_phone }}" class="icon-horizontal w-inline-block">
                                        <img src="https://clean-air.ae/public/uploads/form-icons/footer-phone-icon.png" alt="Phone" class="icon-form-input-image">
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
                <div class="text-block-4">© Copyright {{ $siteName }} {{ date('Y') }}</div>
            </div>
            <div class="social-links">
                @foreach($socialLinks as $social)
                
                    @if(isset($social['platform']) && isset($social['url']))
                        @if($social['platform'] === 'instagram')
                            <a href="{{ $social['url'] }}" target="_blank" class="social-link hover-link w-inline-block">
                                <img src="{{ asset('assets/dubai/imgs/5f7f553f4cd6680289523cd1_IG.png') }}" alt="IG" class="social-link-image"/>
                            </a>
                        @elseif($social['platform'] === 'youtube')
                            <a href="{{ $social['url'] }}" target="_blank" class="social-link hover-link w-inline-block">
                                <img src="{{ asset('assets/dubai/imgs/5f7f553f6e405a7c57cf2ee0_Youtube.png') }}" alt="Youtube" class="social-link-image"/>
                            </a>
                        @elseif($social['platform'] === 'facebook')
                            <a href="{{ $social['url'] }}" target="_blank" class="social-link hover-link w-inline-block">
                                <img src="{{ asset('assets/dubai/imgs/5f7f553f41abca2fb1d167df_Facebook.png') }}" alt="Facebook" class="social-link-image"/>
                            </a>
                        @elseif($social['platform'] === 'nadca')
                            <a href="{{ $social['url'] }}" target="_blank" class="social-link hover-link w-inline-block">
                                <img src="{{ asset('assets/dubai/imgs/65c9ac6a6a04bc152dbaa67c_Nadca.png') }}" alt="National Air Duct Cleaners Association (NADCA) logo" class="social-link-image"/>
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@if($settings->whatsapp_number)
    @php
        // Clean the WhatsApp number (remove spaces, dashes, etc.)
        $whatsappNumber = preg_replace('/[^0-9+]/', '', $settings->whatsapp_number);
        // Ensure it starts with + if it doesn't
        if (substr($whatsappNumber, 0, 1) !== '+') {
            $whatsappNumber = '+' . $whatsappNumber;
        }
        $whatsappUrl = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsappNumber);
    @endphp
    <div style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" 
           style="display: flex; align-items: center; justify-content: center; 
                  width: 60px; height: 60px; background-color: #25d366; 
                  border-radius: 50%; box-shadow: 0 4px 12px rgba(0,0,0,0.3); 
                  text-decoration: none; transition: transform 0.3s ease, box-shadow 0.3s ease;"
           onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 6px 16px rgba(0,0,0,0.4)';"
           onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.3)';"
           title="Chat on WhatsApp">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
        </a>
    </div>
@endif
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@if(session('success'))
<script>
    toastr.success("{{ session('success') }}");
</script>
@endif

@if(session('error'))
<script>
    toastr.error("{{ session('error') }}");
</script>
@endif

<style>

/*=====================================
footer
======================================*/

.clean-footer{
    background: #0D1823;
}
.clean-footer-wraper{
    display:flex;
    flex-direction: column;
}
.footer-top{
    display:flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    border-bottom: 0.5px solid var(--primary);
}
.footer-logo{
    width: 24%;
    
}
.footer-logo img{
    width: 200px;
    height:150px;
    object-fit: contain;
}
.footer-col-content{
    width: 24%;
    display: flex;
    flex-direction: row;
    justify-content: center;
    border-left:0.5px solid var(--primary);
}
.left-side-icon-foot{
    width: 10%;
}
.right-side-text-foot a{
    font-size:17px;
    font-weight:500;
    color:var(--white);
    line-height:22px;
    text-decoration:none;
    margin: 0px;
}
.right-side-text-foot span{
    font-size:17px;
    font-weight:500;
    color:var(--white);
    line-height:22px;
}
.right-side-text-foot p{
    color:#ffffff8a;
    font-size: 14px;
    line-height: 20px;
}
.footer-privacy{
    display: flex;
    flex-direction: row;
    justify-content: center;
    padding: 15px 0px;
}
.footer-privacy a{
    font-size:17px;
    font-weight:500;
    color:#ffffff8a;
    line-height:22px;
    text-decoration:none;
    margin: 0px;
}
.footer-privacy a:first-child{
    border-right: 1px solid gray;
    margin-right: 20px;
    padding-right: 20px;
}

@media(max-width:767px){
    .footer-top{
        display:flex;
        flex-direction: column;
    }
    .footer-logo{
        width: 50%;
    }
    .footer-col-content{
    width: 50%;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    border-left:0px;
    gap:15px;
    }
}    

@media(min-width:320px) and (max-width:380px){
    .right-side-text-foot a{
        font-size:15px;
    }
    .right-side-text-foot span{
        font-size:15px;
    }
}
    
</style>

<section class="clean-footer">
    <div class="container">
        <div class="clean-footer-wraper">
            <div class="footer-top">
                <div class="footer-logo">
                    <img src="https://clean-air.ae/uploads/clean-air-footer-logo.webp" alt="CleanAir"> 
                </div>
                <div class="footer-col-content">
                    <div class="left-side-icon-foot">
                        <span> 📞 </span>
                    </div>
                    <div class="right-side-text-foot">
                        <a href="tel:+971 54 214 0166"> +971 54 214 0166 </a>
                        <p> Call or Whatsapp</p>
                    </div>
                </div>
                <div class="footer-col-content">
                    <div class="left-side-icon-foot">
                        <span>✉️  </span>
                    </div>
                    <div class="right-side-text-foot">
                        <a href="mailto:info@clean-air.ae"> info@clean-air.ae </a>
                        <p> Email Us</p>
                    </div>
                </div>
                <div class="footer-col-content">
                    <div class="left-side-icon-foot">
                        <span>📍  </span>
                    </div>
                    <div class="right-side-text-foot">
                        <span>Dubai, United Arab Emirates </span>
                        <p> Serving Across Dubai </p>
                    </div>
                </div>
            </div><!--footer-top-->
            <div class="footer-privacy">
                <a href="#"> Privacy Policy</a>
                <a href="#"> Terms and Conditions</a>
            </div>
        </div><!--clean-footer-wraper-->
        
    </div>

</section>



