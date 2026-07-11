@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
    $seoMetaTitle = isset($page) ? ($page->meta_title ?? $page->title) : 'Home';
    $seoMetaDesc = isset($page) ? ($page->meta_description ?? ($settings->seo_default_meta_description ?? $siteName . ' delivers professional duct, coil cleaning and sanitisation services. Enjoy better performance and air quality for your comfort and well-being!')) : ($settings->seo_default_meta_description ?? $siteName . ' delivers professional duct, coil cleaning and sanitisation services. Enjoy better performance and air quality for your comfort and well-being!');
    $seoKeywords = isset($page) && $page->meta_keywords ? $page->meta_keywords : ($settings->seo_default_meta_keywords ?? null);
    $seoCanonical = isset($page) && $page->canonical_url ? $page->canonical_url : url()->current();
    $seoOgTitle = isset($page) && $page->og_title ? $page->og_title : $seoMetaTitle . ' - ' . $siteName;
    $seoOgDesc = isset($page) && $page->og_description ? $page->og_description : $seoMetaDesc;
    $seoOgImage = null;
    if (isset($page) && $page->og_image) {
        $seoOgImage = \Illuminate\Support\Str::startsWith($page->og_image, 'http') ? $page->og_image : asset(\Illuminate\Support\Str::startsWith($page->og_image, 'uploads/') ? $page->og_image : 'uploads/' . ltrim($page->og_image, '/'));
    } elseif ($settings->seo_og_image) {
        $img = $settings->seo_og_image;
        $seoOgImage = \Illuminate\Support\Str::startsWith($img, 'http') ? $img : asset(\Illuminate\Support\Str::startsWith($img, 'uploads/') ? $img : 'uploads/' . ltrim($img, '/'));
    }
    $faviconPath = null;
    if ($settings->favicon) {
        $faviconPath = \Illuminate\Support\Str::startsWith($settings->favicon, 'uploads/') ? $settings->favicon : 'uploads/' . ltrim($settings->favicon, '/');
    }
@endphp
<!DOCTYPE html>
<html data-wf-domain="{{ config('app.url') }}" data-wf-page="{{ isset($page) ? $page->id : 'default' }}" lang="en">
<head>
    <meta charset="utf-8"/>
    @if($settings->seo_google_verification ?? null)
	<meta name="google-site-verification" content="{{ $settings->seo_google_verification }}" />
    @endif
    <title>{{ $seoMetaTitle }}{{ $seoMetaTitle !== $siteName ? ' - ' . $siteName : '' }}</title>
    <meta name="description" content="{{ $seoMetaDesc }}"/>
    @if($seoKeywords)
        <meta name="keywords" content="{{ $seoKeywords }}"/>
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="canonical" href="{{ $seoCanonical }}"/>
    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $seoOgTitle }}"/>
    <meta property="og:description" content="{{ $seoOgDesc }}"/>
    <meta property="og:url" content="{{ $seoCanonical }}"/>
    <meta property="og:type" content="website"/>
    @if($seoOgImage)
    <meta property="og:image" content="{{ $seoOgImage }}"/>
    @endif
    <meta property="og:site_name" content="{{ $siteName }}"/>
    
    @if($faviconPath)
        <link rel="icon" href="{{ asset($faviconPath) }}" type="image/x-icon">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif
    
    @php
        
        // Get color values from settings or use defaults (matching CSS file defaults)
        $colors = [
            '--pro-clean-blue' => $settings->color_pro_clean_blue ?? '#00237d',
            '--pro-clean-red' => $settings->color_pro_clean_red ?? '#cd2f2c',
            '--primary-1' => $settings->color_primary_1 ?? '#e14817',
            '--primary-2' => $settings->color_primary_2 ?? '#1e2749',
            '--primary-3' => $settings->color_primary_3 ?? '#81a094',
            '--gray-1' => $settings->color_gray_1 ?? '#2c2d36',
            '--gray-2' => $settings->color_gray_2 ?? '#00000014',
            '--gray-3' => $settings->color_gray_3 ?? '#f9f5ec',
            '--gray-4' => $settings->color_gray_4 ?? '#fbfaf8',
            '--white' => $settings->color_white ?? 'white',
            '--success' => $settings->color_success ?? '#559866',
            '--warning' => $settings->color_warning ?? '#eaa235',
            '--danger' => $settings->color_danger ?? '#ad343e',
            '--lime-green' => $settings->color_lime_green ?? '#25d366',
            '--input-border' => $settings->color_input_border ?? '#2c2d362b',
        ];
        
        $cssVariables = '';
        foreach ($colors as $var => $value) {
            $cssVariables .= "{$var}: {$value}; ";
        }
    @endphp
    
    <style>
        :root {
            {!! $cssVariables !!}
        }
    </style>
    <!-- CSS Variables defined above will override any color definitions in the CSS file below -->
    <link href="{{ asset('assets/dubai/css/pro-clean-ac.webflow.shared.f591dcfda.min.css') }}?v={{ time() }}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/" rel="preconnect"/>
    <link href="https://fonts.gstatic.com/" rel="preconnect" crossorigin="anonymous"/>
    <script src="{{ asset('assets/dubai/js/webfont.js') }}" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({  google: {    families: ["Reenie Beanie:regular"]  }});</script>
    <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
    @if($settings->seo_gtm_id ?? null)
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $settings->seo_gtm_id }}');</script>
    <!-- End Google Tag Manager -->
    @endif
    @if($settings->seo_gtag_id ?? null)
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->seo_gtag_id }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $settings->seo_gtag_id }}');
    </script>
    @endif
    @php
        $schemaHtml = null;
        $baseUrl = rtrim(config('app.url') ?: url('/'), '/');
        if (isset($page) && $page->schema_markup) {
            $schemaHtml = $page->schema_markup;
        } elseif (isset($page) && ($page->schema_type ?? null) === 'service') {
            $providerName = $siteName;
            $providerUrl = $baseUrl . '/';
            $providerPhone = $settings->header_phone ?? null;
            $providerEmail = $settings->header_email ?? null;
            $addrLocality = $settings->schema_provider_address_locality ?? 'Dubai';
            $addrCountry = $settings->schema_provider_address_country ?? 'UAE';
            $sameAs = $settings->schema_provider_same_as;
            if (is_string($sameAs)) $sameAs = @json_decode($sameAs, true);
            if (!is_array($sameAs) && $settings->social_links) {
                $sameAs = array_filter(array_map(fn($s) => $s['url'] ?? null, is_array($settings->social_links) ? $settings->social_links : []));
            }
            if (!is_array($sameAs)) $sameAs = [$baseUrl . '/'];
            $schema = [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $page->meta_title ?? $page->title,
                'description' => $page->meta_description ?? ($page->title . ' - ' . $providerName),
                'url' => $page->canonical_url ?: url('/' . ltrim($page->slug, '/')),
                'serviceType' => $page->schema_service_type ?? $page->title,
                'areaServed' => ['@type' => 'City', 'name' => $page->schema_area_locality ?? $addrLocality],
                'provider' => [
                    '@type' => 'LocalBusiness',
                    'name' => $providerName,
                    'url' => $providerUrl,
                    'address' => ['@type' => 'PostalAddress', 'addressLocality' => $addrLocality, 'addressCountry' => $addrCountry],
                    'sameAs' => array_values($sameAs),
                ],
            ];
            if ($providerPhone) $schema['provider']['telephone'] = $providerPhone;
            if ($providerEmail) $schema['provider']['email'] = $providerEmail;
            $schemaHtml = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } elseif ($settings->seo_schema_json) {
            $decoded = @json_decode($settings->seo_schema_json);
            $schemaHtml = $decoded ? json_encode($decoded, JSON_UNESCAPED_SLASHES) : null;
        }
        if (!$schemaHtml && $siteName) {
            $logoUrl = $settings->site_logo ? asset(\Illuminate\Support\Str::startsWith($settings->site_logo, 'uploads/') ? $settings->site_logo : 'uploads/' . ltrim($settings->site_logo, '/')) : null;
            $schema = ['@context' => 'https://schema.org', '@type' => 'Organization', 'name' => $siteName, 'url' => $baseUrl . '/'];
            if ($logoUrl) $schema['logo'] = $logoUrl;
            if ($settings->header_phone ?? null) $schema['telephone'] = $settings->header_phone;
            if ($settings->header_email ?? null) $schema['email'] = $settings->header_email;
            $schemaHtml = json_encode($schema, JSON_UNESCAPED_SLASHES);
        }
    @endphp
    @if($schemaHtml)
    <script type="application/ld+json">{!! $schemaHtml !!}</script>
    @endif
    <style>
        body {
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
        }
        select { 
          -webkit-appearance: none;
        }
		
		@media (max-width: 767px) {
			.section-67 .w-layout-grid{
				display: flex !important;
				flex-direction: column !important;
			}
			.section-67 .w-layout-grid .w-embed{
				overflow:hidden !important;
			}
			.cont-custom-top{
				display:flex !important;
				flex-direction:column !important;
			}
			.cont-custom-top .con-wrap-custom{
				width:100% !important;
			}
			.cont-custom-top .con-wrap-custom .link-6{
				font-size:20px !important;
			}
			.custom-cont .inside-top-main-hero{
				width:100% !important;
				padding:0px 10px !important;
			}
		}
		
    </style>
    
    @stack('styles')
	
	<!--kami-css-->
	
</head>
<body>
    @if($settings->seo_gtm_id ?? null)
    <div class="w-embed w-iframe">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $settings->seo_gtm_id }}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    </div>
    @endif
    
    <div id="Top" class="back-to-top-container">
        <div class="back-to-top-button-container">
            <a href="#Top" class="button-round button-round-small w-inline-block">
                <img src="{{ asset('assets/dubai/imgs/5f32dc906194421213e96ed5_icon-chevron-up.svg') }}" alt="icon chevron up"/>
            </a>
        </div>
    </div>
    @include('frontend.partials.header')
    
    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')
    
    <script src="{{ asset('assets/dubai/js/jquery-3.5.1.min.dc5e7f18c82aa4.js') }}?site=5f32dc8fbfcb095f82c1b9ec" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/dubai/js/webflow.schunk.36b8fb49256177c8.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/dubai/js/webflow.schunk.2c6ec697e7b11302.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/dubai/js/webflow.533f3baa.43125073672cdf8c.js') }}" type="text/javascript"></script>
    <script>
    /* DISABLED: Right-click, text selection, copy/cut/paste, and keyboard shortcuts
    // Disable Right Click
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // Disable text selection
    document.addEventListener('selectstart', function(e) {
        e.preventDefault();
    });

    // Disable copy, cut, paste
    document.addEventListener('copy', function(e) {
        e.preventDefault();
    });
    document.addEventListener('cut', function(e) {
        e.preventDefault();
    });
    document.addEventListener('paste', function(e) {
        e.preventDefault();
    });

    // Disable keyboard shortcuts
    document.addEventListener('keydown', function(e) {

        // Ctrl + C, Ctrl + X, Ctrl + V, Ctrl + U, Ctrl + S
        if (e.ctrlKey && (
            e.key === 'c' ||
            e.key === 'x' ||
            e.key === 'v' ||
            e.key === 'u' ||
            e.key === 's'
        )) {
            e.preventDefault();
        }

        // Ctrl + Shift + I / J (DevTools)
        if (e.ctrlKey && e.shiftKey && (
            e.key === 'I' ||
            e.key === 'J'
        )) {
            e.preventDefault();
        }

        // F12 (DevTools)
        if (e.key === 'F12') {
            e.preventDefault();
        }
    });
    */
</script>

    
    @stack('scripts')
</body>
</html>
