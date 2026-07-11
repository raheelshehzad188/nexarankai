@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
    $data = $section->data ?? [];
    $headingBefore = $data['heading_before'] ?? 'Get a';
    $linkText = $data['link_text'] ?? 'free quotation';
    $linkUrl = $data['link_url'] ?? '/contact';
    $headingAfter = $data['heading_after'] ?? 'today!';
    $description = $data['description'] ?? 'Click below to plan a visit with the ' . $siteName . ' team. Our team of experts will help guide, advise and execute any AC cleaning related work that you need.';
    $btnText = $data['btn_text'] ?? 'Free Quotation';
    $btnLink = $data['btn_link'] ?? '/contact';
@endphp

<div class="section-21">
    <div class="main-container-2">
        <div class="container-large wide align-center">
            <h3 class="display-heading-3">
                {{ $headingBefore }}
                <a href="{{ $linkUrl }}" class="link-7">
                    <span class="text-span-298">{{ $linkText }}</span>
                </a>
                {{ $headingAfter }}
            </h3>
            <div class="section-title text-center">
                <div class="text-large-2">{{ $description }}</div>
            </div>
            <div class="justify-content-center">
                <a href="{{ $btnLink }}" class="button-2 logo-row-button w-inline-block">
                    <div>{{ $btnText }}</div>
                </a>
            </div>
        </div>
    </div>
</div>

