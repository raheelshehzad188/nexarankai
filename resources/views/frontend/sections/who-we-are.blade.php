@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
    $data = $section->data ?? [];
    $shortHeading = $data['short_heading'] ?? 'Who We Are';
    $mainHeading = $data['main_heading'] ?? 'How can ' . $siteName . ' help you?';
    $content = $data['content'] ?? '';
@endphp

<section id="Who-We-Are" class="our-services-section background-spotlight">
    <div class="main-container-2">
        <div class="container-large align-center section-title">
            @if($shortHeading)
                <h5 class="text-primary-4">{{ $shortHeading }}</h5>
            @endif
            @if($mainHeading)
                <h3 class="services-header services-sub-heading">
                    <span class="text-span-293">{{ $mainHeading }}</span>
                </h3>
            @endif
            @if($content)
                <p class="paragraph-10">{!! $content !!}</p>
            @endif
        </div>
        <div class="container-large-services align-center"></div>
    </div>
</section>

