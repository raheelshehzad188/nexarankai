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
<html lang="en">
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

    @if($settings->seo_gtm_id ?? null)
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $settings->seo_gtm_id }}');</script>
    @endif
    @if($settings->seo_gtag_id ?? null)
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

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    @include('frontend.partials.new-layout.styles')
    @include('frontend.partials.new-layout.section-styles')

    @stack('styles')
</head>
<body>
    @if($settings->seo_gtm_id ?? null)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $settings->seo_gtm_id }}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    @include('frontend.partials.new-layout.header')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.new-layout.footer')

    @include('frontend.partials.new-layout.scripts')

    @stack('scripts')
</body>
</html>
