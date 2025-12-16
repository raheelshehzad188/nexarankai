<!DOCTYPE html>
<html data-wf-domain="{{ config('app.url') }}" data-wf-page="{{ isset($page) ? $page->id : 'default' }}" lang="en">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title', (isset($page) ? ($page->meta_title ?? $page->title) : 'Home') . ' - Pro Clean AC')</title>
    <meta content="@yield('description', isset($page) ? ($page->meta_description ?? 'Pro Clean AC delivers professional duct, coil cleaning and sanitisation services. Enjoy better performance and air quality for your comfort and well-being!') : 'Pro Clean AC delivers professional duct, coil cleaning and sanitisation services. Enjoy better performance and air quality for your comfort and well-being!')" name="description"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    
    @php
        $assets_url = asset('assets/dubai/www.proclean-ac.com');
    @endphp
    
    <link href="{{ $assets_url }}/../css/pro-clean-ac.webflow.shared.f591dcfda.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/" rel="preconnect"/>
    <link href="https://fonts.gstatic.com/" rel="preconnect" crossorigin="anonymous"/>
    <script src="{{ $assets_url }}/../js/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({  google: {    families: ["Reenie Beanie:regular"]  }});</script>
    <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
    
    <style>
        body {
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
        }
        select { 
          -webkit-appearance: none;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="w-embed w-iframe">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5336HXF"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    </div>
    
    <div id="Top" class="back-to-top-container">
        <div class="back-to-top-button-container">
            <a href="#Top" class="button-round button-round-small w-inline-block">
                <img src="{{ $assets_url }}/../imgs/5f32dc906194421213e96ed5_icon-chevron-up.svg" alt="icon chevron up"/>
            </a>
        </div>
    </div>
    
    @include('frontend.partials.header')
    
    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')
    
    <script src="{{ $assets_url }}/../js/jquery-3.5.1.min.dc5e7f18c82aa4.js?site=5f32dc8fbfcb095f82c1b9ec" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ $assets_url }}/../js/webflow.schunk.36b8fb49256177c8.js" type="text/javascript"></script>
    <script src="{{ $assets_url }}/../js/webflow.schunk.2c6ec697e7b11302.js" type="text/javascript"></script>
    <script src="{{ $assets_url }}/../js/webflow.533f3baa.43125073672cdf8c.js" type="text/javascript"></script>
    
    @stack('scripts')
</body>
</html>
