@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Clean Air';
    $footerMenus = \App\Models\Menu::getByLocation('footer');
    $phone = $settings->header_phone ?? '+971542140166';
    $email = $settings->header_email ?? 'info@clean-air.ae';

    $logoUrl = 'https://clean-air.ae/uploads/clean-air-head-logo.webp';
    if ($settings->site_logo) {
        $logoPath = \Illuminate\Support\Str::startsWith($settings->site_logo, 'uploads/')
            ? $settings->site_logo
            : 'uploads/' . ltrim($settings->site_logo, '/');
        $logoUrl = asset($logoPath);
    }
@endphp

<footer class="new-footer">
    <div class="container">
        <div class="new-footer-grid">
            <div class="new-footer-brand">
                <a href="{{ url('/') }}">
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}">
                </a>
                @if($settings->footer_text)
                    <p>{{ $settings->footer_text }}</p>
                @else
                    <p>Professional AC deep cleaning services in Dubai. Breathe cleaner, healthier air with Clean Air.</p>
                @endif
            </div>

            <div class="new-footer-links">
                <h4 class="new-footer-heading">Quick Links</h4>
                <ul>
                    @if($footerMenus->count() > 0)
                        @foreach($footerMenus->take(8) as $menu)
                            <li><a href="{{ $menu->getUrl() }}">{{ $menu->title }}</a></li>
                        @endforeach
                    @else
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                        <li><a href="{{ url('/blog') }}">Blog</a></li>
                    @endif
                </ul>
            </div>

            <div class="new-footer-contact">
                <h4 class="new-footer-heading">Contact Us</h4>

                <div class="new-footer-contact-item">
                    <span class="icon">📞</span>
                    <div>
                        <h4>Call Us</h4>
                        <p><a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" style="color:inherit;">{{ $phone }}</a></p>
                    </div>
                </div>

                <div class="new-footer-contact-item">
                    <span class="icon">✉️</span>
                    <div>
                        <h4>Email</h4>
                        <p><a href="mailto:{{ $email }}" style="color:inherit;">{{ $email }}</a></p>
                    </div>
                </div>

                <div class="new-footer-contact-item">
                    <span class="icon">📍</span>
                    <div>
                        <h4>Location</h4>
                        <p>Dubai, United Arab Emirates</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="new-footer-bottom">
            <p>&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
        </div>
    </div>
</footer>
