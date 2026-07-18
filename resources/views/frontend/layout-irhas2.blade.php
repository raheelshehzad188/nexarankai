@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Irhas';
    $theme = \App\Support\IrhasSectionData::THEME_BASE;
    $seoMetaTitle = isset($page) ? ($page->meta_title ?? $page->title) : 'Home 2';
    $seoMetaDesc = isset($page) ? ($page->meta_description ?? $siteName) : $siteName;
    $seoKeywords = isset($page) ? $page->meta_keywords : null;
    $seoCanonical = isset($page) && $page->canonical_url ? $page->canonical_url : url()->current();
    $seoOgTitle = isset($page) && $page->og_title ? $page->og_title : ($seoMetaTitle . ' - ' . $siteName);
    $seoOgDesc = isset($page) && $page->og_description ? $page->og_description : $seoMetaDesc;
    $seoOgImage = null;
    if (isset($page) && $page->og_image) {
        $seoOgImage = \Illuminate\Support\Str::startsWith($page->og_image, 'http') ? $page->og_image : asset(\Illuminate\Support\Str::startsWith($page->og_image, 'uploads/') ? $page->og_image : 'uploads/' . ltrim($page->og_image, '/'));
    }
    $faviconPath = null;
    if ($settings->favicon) {
        $faviconPath = \Illuminate\Support\Str::startsWith($settings->favicon, 'uploads/') ? $settings->favicon : 'uploads/' . ltrim($settings->favicon, '/');
    }
    $bodyClass = $bodyClass ?? 'irhas2 home2';
@endphp
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>{{ $seoMetaTitle }}{{ $seoMetaTitle !== $siteName ? ' | ' . $siteName : '' }}</title>
    <meta name="description" content="{{ $seoMetaDesc }}" />
    @if(!empty($seoKeywords))
        <meta name="keywords" content="{{ $seoKeywords }}" />
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="canonical" href="{{ $seoCanonical }}" />
    <meta property="og:title" content="{{ $seoOgTitle }}" />
    <meta property="og:description" content="{{ $seoOgDesc }}" />
    <meta property="og:url" content="{{ $seoCanonical }}" />
    <meta property="og:type" content="website" />
    @if(!empty($seoOgImage))
        <meta property="og:image" content="{{ $seoOgImage }}" />
    @endif
    @if($faviconPath)
        <link rel="icon" href="{{ asset($faviconPath) }}" type="image/x-icon">
    @endif

    <link rel="stylesheet" href="{{ asset($theme . '/css/aos.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset($theme . '/css/plugin.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset($theme . '/css/swiper-bundle.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset($theme . '/css/thaw-flexgrid.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset($theme . '/css/font.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset($theme . '/css/all.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset($theme . '/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset($theme . '/css/responsive.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset($theme . '/css/lightgallery.min.css') }}" type="text/css">

    @stack('styles')
</head>
<body class="{{ $bodyClass }}">
    <div id="main-wrapper" class="animsition clearfix">
        @include('frontend.partials.irhas.header-2')

        <section class="content">
            @yield('content')
        </section>

        @include('frontend.partials.irhas.footer-2')
    </div>

    <script src="{{ asset($theme . '/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset($theme . '/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset($theme . '/js/aos.js') }}"></script>
    <script src="{{ asset($theme . '/js/jquery.smartmenus.min.js') }}"></script>
    <script src="{{ asset($theme . '/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset($theme . '/js/main.js') }}"></script>

    @stack('scripts')
</body>
</html>
