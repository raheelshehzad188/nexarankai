@extends('admin.layout')

@section('title', 'Site Settings')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Site Settings</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="site_name" class="form-label">Site Name</label>
                <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name', $settings->site_name ?? 'Pro Clean AC') }}" placeholder="Pro Clean AC">
                <small class="form-text text-muted">This name will be used throughout the site instead of "Pro Clean AC"</small>
            </div>

            <div class="mb-3">
                <label for="site_logo" class="form-label">Site Logo</label>
                <input type="file" class="form-control" id="site_logo" name="site_logo">
                @if($settings->site_logo)
                    @php
                        $logoPath = \Illuminate\Support\Str::startsWith($settings->site_logo, 'uploads/')
                            ? $settings->site_logo
                            : 'uploads/' . ltrim($settings->site_logo, '/');
                    @endphp
                    <img src="{{ asset($logoPath) }}" alt="Logo" class="mt-2" style="max-height: 100px;">
                @endif
            </div>

            <div class="mb-3">
                <label for="favicon" class="form-label">Favicon</label>
                <input type="file" class="form-control" id="favicon" name="favicon" accept="image/x-icon,image/png,image/svg+xml">
                <small class="form-text text-muted">Upload favicon (ICO, PNG, or SVG format). Recommended size: 32x32 or 16x16 pixels.</small>
                @if($settings->favicon)
                    @php
                        $faviconPath = \Illuminate\Support\Str::startsWith($settings->favicon, 'uploads/')
                            ? $settings->favicon
                            : 'uploads/' . ltrim($settings->favicon, '/');
                    @endphp
                    <div class="mt-2">
                        <img src="{{ asset($faviconPath) }}" alt="Favicon" style="max-width: 32px; max-height: 32px;">
                        <small class="d-block text-muted mt-1">Current favicon</small>
                    </div>
                @endif
            </div>

            <h6 class="mt-4">Header Settings</h6>
            <div class="mb-3">
                <label for="header_phone" class="form-label">Header Phone</label>
                <input type="text" class="form-control" id="header_phone" name="header_phone" value="{{ old('header_phone', $settings->header_phone) }}">
            </div>

            <div class="mb-3">
                <label for="header_email" class="form-label">Header Email</label>
                <input type="email" class="form-control" id="header_email" name="header_email" value="{{ old('header_email', $settings->header_email) }}">
            </div>

            <div class="mb-3">
                <label for="site_address" class="form-label">Address / Location</label>
                <textarea class="form-control" id="site_address" name="site_address" rows="3" placeholder="Dubai, United Arab Emirates">{{ old('site_address', $settings->site_address) }}</textarea>
                <small class="form-text text-muted">Shown in the footer contact section.</small>
            </div>

            <div class="mb-3">
                <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}" placeholder="+971551234567">
                <small class="form-text text-muted">Enter WhatsApp number with country code (e.g., +971551234567). This will appear as a floating button in the footer.</small>
            </div>

            <div class="mb-3">
                <label for="header_cta_text" class="form-label">Header CTA Text</label>
                <input type="text" class="form-control" id="header_cta_text" name="header_cta_text" value="{{ old('header_cta_text', $settings->header_cta_text) }}">
            </div>

            <div class="mb-3">
                <label for="header_cta_link" class="form-label">Header CTA Link</label>
                <input type="url" class="form-control" id="header_cta_link" name="header_cta_link" value="{{ old('header_cta_link', $settings->header_cta_link) }}">
            </div>

            <h6 class="mt-4">Footer Settings</h6>
            <div class="mb-3">
                <label for="footer_text" class="form-label">Footer Text</label>
                <textarea class="form-control" id="footer_text" name="footer_text" rows="4">{{ old('footer_text', $settings->footer_text) }}</textarea>
            </div>

            <h6 class="mt-4 mb-3">Social Media Links</h6>
            <p class="text-muted small">Add your social media links. These will appear in the footer.</p>
            
            @php
                $socialLinks = is_array($settings->social_links ?? null) ? $settings->social_links : [];
                $facebookUrl = old('social_facebook', '');
                $instagramUrl = old('social_instagram', '');
                $youtubeUrl = old('social_youtube', '');
                $nadcaUrl = old('social_nadca', '');
                
                // Extract URLs from social_links array (new format: array of arrays with platform and url)
                foreach($socialLinks as $social) {
                    if (is_array($social) && isset($social['platform']) && isset($social['url'])) {
                        if ($social['platform'] === 'facebook') $facebookUrl = $social['url'];
                        if ($social['platform'] === 'instagram') $instagramUrl = $social['url'];
                        if ($social['platform'] === 'youtube') $youtubeUrl = $social['url'];
                        if ($social['platform'] === 'nadca') $nadcaUrl = $social['url'];
                    }
                }
                
                // Handle old format (associative array: ['facebook' => 'url', ...])
                if (empty($facebookUrl) && isset($socialLinks['facebook'])) {
                    $facebookUrl = $socialLinks['facebook'];
                }
                if (empty($instagramUrl) && isset($socialLinks['instagram'])) {
                    $instagramUrl = $socialLinks['instagram'];
                }
                if (empty($youtubeUrl) && isset($socialLinks['youtube'])) {
                    $youtubeUrl = $socialLinks['youtube'];
                }
            @endphp
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="social_facebook" class="form-label">Facebook URL</label>
                        <input type="url" class="form-control" id="social_facebook" name="social_facebook" value="{{ old('social_facebook', $facebookUrl) }}" placeholder="https://www.facebook.com/yourpage">
                    </div>
                    <div class="mb-3">
                        <label for="social_instagram" class="form-label">Instagram URL</label>
                        <input type="url" class="form-control" id="social_instagram" name="social_instagram" value="{{ old('social_instagram', $instagramUrl) }}" placeholder="https://www.instagram.com/yourpage">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="social_youtube" class="form-label">YouTube URL</label>
                        <input type="url" class="form-control" id="social_youtube" name="social_youtube" value="{{ old('social_youtube', $youtubeUrl) }}" placeholder="https://www.youtube.com/channel/yourchannel">
                    </div>
                    <div class="mb-3">
                        <label for="social_nadca" class="form-label">NADCA URL (Optional)</label>
                        <input type="url" class="form-control" id="social_nadca" name="social_nadca" value="{{ old('social_nadca', $nadcaUrl) }}" placeholder="https://nadca.com/...">
                    </div>
                </div>
            </div>

            <h6 class="mt-4 mb-3">SEO & Meta</h6>
            <p class="text-muted small">Default SEO settings. Page-specific overrides can be set per page in the Pages admin.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="seo_google_verification" class="form-label">Google Site Verification</label>
                        <input type="text" class="form-control" id="seo_google_verification" name="seo_google_verification" value="{{ old('seo_google_verification', $settings->seo_google_verification) }}" placeholder="FwsxHb032ShzzvWfXYxWJwjLg19V_I-qidUc-FIYqqM">
                        <small class="text-muted">meta name="google-site-verification" content value</small>
                    </div>
                    <div class="mb-3">
                        <label for="seo_gtm_id" class="form-label">Google Tag Manager ID</label>
                        <input type="text" class="form-control" id="seo_gtm_id" name="seo_gtm_id" value="{{ old('seo_gtm_id', $settings->seo_gtm_id) }}" placeholder="GTM-5336HXF">
                    </div>
                    <div class="mb-3">
                        <label for="seo_gtag_id" class="form-label">Google Analytics ID (gtag)</label>
                        <input type="text" class="form-control" id="seo_gtag_id" name="seo_gtag_id" value="{{ old('seo_gtag_id', $settings->seo_gtag_id) }}" placeholder="G-WV8MPWZ15J">
                    </div>
                    <div class="mb-3">
                        <label for="seo_default_meta_description" class="form-label">Default Meta Description</label>
                        <textarea class="form-control" id="seo_default_meta_description" name="seo_default_meta_description" rows="2">{{ old('seo_default_meta_description', $settings->seo_default_meta_description) }}</textarea>
                        <small class="text-muted">Used when page has no meta description (150–160 chars recommended)</small>
                    </div>
                    <div class="mb-3">
                        <label for="seo_default_meta_keywords" class="form-label">Default Meta Keywords</label>
                        <input type="text" class="form-control" id="seo_default_meta_keywords" name="seo_default_meta_keywords" value="{{ old('seo_default_meta_keywords', $settings->seo_default_meta_keywords) }}" placeholder="AC cleaning, duct cleaning, Dubai">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="seo_og_image" class="form-label">Default OG Image (social sharing)</label>
                        <input type="file" class="form-control" id="seo_og_image" name="seo_og_image" accept="image/*">
                        @if($settings->seo_og_image)
                            @php
                                $ogPath = \Illuminate\Support\Str::startsWith($settings->seo_og_image, 'uploads/') ? $settings->seo_og_image : 'uploads/' . ltrim($settings->seo_og_image, '/');
                            @endphp
                            <img src="{{ asset($ogPath) }}" alt="OG" class="mt-2" style="max-height: 80px;">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="seo_schema_json" class="form-label">Organization Schema (JSON-LD)</label>
                        <textarea class="form-control font-monospace small" id="seo_schema_json" name="seo_schema_json" rows="10" placeholder='{"@context":"https://schema.org","@type":"Organization","name":"..."}'>{{ old('seo_schema_json', $settings->seo_schema_json) }}</textarea>
                        <small class="text-muted">Optional. Valid JSON for Organization/LocalBusiness schema. Leave empty to use auto-generated schema from site info.</small>
                    </div>
                </div>
            </div>

            <h6 class="mt-4 mb-3">Color Settings</h6>
            <p class="text-muted small">Change site colors. All colors will update across the entire site.</p>
            
            <div class="row">
                <div class="col-md-6">
                    <h6 class="mt-3 mb-2">Primary Colors</h6>
                    <div class="mb-3">
                        <label for="color_pro_clean_blue" class="form-label">Pro Clean Blue</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_pro_clean_blue" name="color_pro_clean_blue" value="{{ old('color_pro_clean_blue', $settings->color_pro_clean_blue ?? '#00237d') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_pro_clean_blue', $settings->color_pro_clean_blue ?? '#00237d') }}" onchange="document.getElementById('color_pro_clean_blue').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_pro_clean_red" class="form-label">Pro Clean Red</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_pro_clean_red" name="color_pro_clean_red" value="{{ old('color_pro_clean_red', $settings->color_pro_clean_red ?? '#fdaa90') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_pro_clean_red', $settings->color_pro_clean_red ?? '#fdaa90') }}" onchange="document.getElementById('color_pro_clean_red').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_primary_1" class="form-label">Primary 1</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_primary_1" name="color_primary_1" value="{{ old('color_primary_1', $settings->color_primary_1 ?? '#fdaa90') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_primary_1', $settings->color_primary_1 ?? '#fdaa90') }}" onchange="document.getElementById('color_primary_1').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_primary_2" class="form-label">Primary 2</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_primary_2" name="color_primary_2" value="{{ old('color_primary_2', $settings->color_primary_2 ?? '#00237d') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_primary_2', $settings->color_primary_2 ?? '#00237d') }}" onchange="document.getElementById('color_primary_2').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_primary_3" class="form-label">Primary 3</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_primary_3" name="color_primary_3" value="{{ old('color_primary_3', $settings->color_primary_3 ?? '#81a094') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_primary_3', $settings->color_primary_3 ?? '#81a094') }}" onchange="document.getElementById('color_primary_3').value = this.value">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="mt-3 mb-2">Gray Colors</h6>
                    <div class="mb-3">
                        <label for="color_gray_1" class="form-label">Gray 1</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_gray_1" name="color_gray_1" value="{{ old('color_gray_1', $settings->color_gray_1 ?? '#2c2d36') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_gray_1', $settings->color_gray_1 ?? '#2c2d36') }}" onchange="document.getElementById('color_gray_1').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_gray_2" class="form-label">Gray 2</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_gray_2" name="color_gray_2" value="{{ old('color_gray_2', $settings->color_gray_2 ?? '#e2e2e2') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_gray_2', $settings->color_gray_2 ?? '#e2e2e2') }}" onchange="document.getElementById('color_gray_2').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_gray_3" class="form-label">Gray 3</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_gray_3" name="color_gray_3" value="{{ old('color_gray_3', $settings->color_gray_3 ?? '#f9f5ec') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_gray_3', $settings->color_gray_3 ?? '#f9f5ec') }}" onchange="document.getElementById('color_gray_3').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_gray_4" class="form-label">Gray 4</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_gray_4" name="color_gray_4" value="{{ old('color_gray_4', $settings->color_gray_4 ?? '#ffffff') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_gray_4', $settings->color_gray_4 ?? '#ffffff') }}" onchange="document.getElementById('color_gray_4').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_white" class="form-label">White</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_white" name="color_white" value="{{ old('color_white', $settings->color_white ?? '#ffffff') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_white', $settings->color_white ?? '#ffffff') }}" onchange="document.getElementById('color_white').value = this.value">
                        </div>
                    </div>
                    <h6 class="mt-3 mb-2">Status Colors</h6>
                    <div class="mb-3">
                        <label for="color_success" class="form-label">Success</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_success" name="color_success" value="{{ old('color_success', $settings->color_success ?? '#559866') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_success', $settings->color_success ?? '#559866') }}" onchange="document.getElementById('color_success').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_warning" class="form-label">Warning</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_warning" name="color_warning" value="{{ old('color_warning', $settings->color_warning ?? '#eaa235') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_warning', $settings->color_warning ?? '#eaa235') }}" onchange="document.getElementById('color_warning').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_danger" class="form-label">Danger</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_danger" name="color_danger" value="{{ old('color_danger', $settings->color_danger ?? '#dc3545') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_danger', $settings->color_danger ?? '#dc3545') }}" onchange="document.getElementById('color_danger').value = this.value">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="color_lime_green" class="form-label">Lime Green</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_lime_green" name="color_lime_green" value="{{ old('color_lime_green', $settings->color_lime_green ?? '#25d366') }}" title="Choose color">
                            <input type="text" class="form-control" value="{{ old('color_lime_green', $settings->color_lime_green ?? '#25d366') }}" onchange="document.getElementById('color_lime_green').value = this.value">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update Settings</button>
            </div>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5>Sitemap Management</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">Generate or update the sitemap.xml file for search engines.</p>
        
        @if(session('sitemap_url'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Sitemap generated successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @php
            $sitemapUrl = session('sitemap_url') ?? url('/sitemap.xml');
            $sitemapExists = file_exists(public_path('sitemap.xml'));
        @endphp
        
        @if($sitemapExists || session('sitemap_url'))
            <div class="mb-3">
                <label class="form-label">Sitemap URL:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="sitemap-url" value="{{ $sitemapUrl }}" readonly>
                    <a href="{{ $sitemapUrl }}" target="_blank" class="btn btn-outline-primary" title="Open sitemap in new tab">
                        Open Sitemap
                    </a>
                    <button class="btn btn-outline-secondary" type="button" id="copy-sitemap-btn" onclick="copySitemapUrl()">
                        Copy Link
                    </button>
                </div>
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.settings.generate-sitemap') }}" id="sitemap-form">
            @csrf
            <button type="submit" class="btn btn-success" id="sitemap-btn">
                <span id="sitemap-btn-text">Regenerate Sitemap</span>
                <span id="sitemap-btn-loading" style="display: none;">Generating...</span>
            </button>
        </form>
        <p class="mt-2 mb-0">
            <a href="{{ route('admin.settings.regenerate-sitemap') }}" class="text-primary" style="text-decoration: underline;">
                Click this link to update sitemap
            </a>
        </p>
        <p class="mt-2 mb-0">
            <strong>Public link (cron ya bookmark):</strong>
            <a href="{{ url('/sitemap-update') }}" target="_blank" class="text-primary" style="text-decoration: underline;">
                {{ url('/sitemap-update') }}
            </a>
            — Is link par click karte hi sitemap naya ban jayega
        </p>
    </div>
</div>

<script>
    document.getElementById('sitemap-form').addEventListener('submit', function(e) {
        const btn = document.getElementById('sitemap-btn');
        const btnText = document.getElementById('sitemap-btn-text');
        const btnLoading = document.getElementById('sitemap-btn-loading');
        
        btn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline';
    });
    
    function copySitemapUrl() {
        const sitemapUrlInput = document.getElementById('sitemap-url');
        const copyBtn = document.getElementById('copy-sitemap-btn');
        
        // Select the text
        sitemapUrlInput.select();
        sitemapUrlInput.setSelectionRange(0, 99999); // For mobile devices
        
        // Copy to clipboard
        try {
            document.execCommand('copy');
            
            // Update button text temporarily
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="bi bi-check"></i> Copied!';
            copyBtn.classList.remove('btn-outline-secondary');
            copyBtn.classList.add('btn-success');
            
            setTimeout(function() {
                copyBtn.innerHTML = originalText;
                copyBtn.classList.remove('btn-success');
                copyBtn.classList.add('btn-outline-secondary');
            }, 2000);
        } catch (err) {
            // Fallback for modern browsers
            if (navigator.clipboard) {
                navigator.clipboard.writeText(sitemapUrlInput.value).then(function() {
                    const originalText = copyBtn.innerHTML;
                    copyBtn.innerHTML = '<i class="bi bi-check"></i> Copied!';
                    copyBtn.classList.remove('btn-outline-secondary');
                    copyBtn.classList.add('btn-success');
                    
                    setTimeout(function() {
                        copyBtn.innerHTML = originalText;
                        copyBtn.classList.remove('btn-success');
                        copyBtn.classList.add('btn-outline-secondary');
                    }, 2000);
                });
            } else {
                alert('Failed to copy. Please copy manually: ' + sitemapUrlInput.value);
            }
        }
    }
</script>

<script>
    // Sync color picker with text input
    document.querySelectorAll('input[type="color"]').forEach(function(colorPicker) {
        colorPicker.addEventListener('input', function() {
            const textInput = this.parentElement.querySelector('input[type="text"]');
            if (textInput) {
                textInput.value = this.value;
            }
        });
    });

    // Sync text input with color picker
    document.querySelectorAll('input[type="text"]').forEach(function(textInput) {
        if (textInput.parentElement.querySelector('input[type="color"]')) {
            textInput.addEventListener('input', function() {
                const colorPicker = this.parentElement.querySelector('input[type="color"]');
                if (colorPicker && /^#[0-9A-F]{6}$/i.test(this.value)) {
                    colorPicker.value = this.value;
                }
            });
        }
    });
</script>
@endsection

