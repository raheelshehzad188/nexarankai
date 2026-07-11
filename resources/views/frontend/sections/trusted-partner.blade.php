@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
    $data = $section->data ?? [];
    $shortHeading = $data['short_heading'] ?? 'A trusted partner';
    $mainHeading = $data['main_heading'] ?? 'We are NADCA Accredited';
    $content = $data['content'] ?? $siteName . ' is a member of the National Air Duct Cleaners Association (NADCA) and adheres to stringent industry standards and best practices in HVAC system cleaning and restoration.';
    $image = $data['image'] ?? '';
    $imageUrl = $data['image_url'] ?? '';
    $imageAlt = $data['image_alt'] ?? 'Duct cleaning Dubai';
    $defaultImage = 'https://cdn.prod.website-files.com/5f32dc8fbfcb095f82c1b9ec/65c9cf5e94615ead720fcb8c_NADCA%20PRO%20CLEAN%20%20(2).png';
    $defaultSrcset = [
        'https://cdn.prod.website-files.com/5f32dc8fbfcb095f82c1b9ec/65c9cf5e94615ead720fcb8c_NADCA%20PRO%20CLEAN%20%20(2)-p-500.png 500w',
        'https://cdn.prod.website-files.com/5f32dc8fbfcb095f82c1b9ec/65c9cf5e94615ead720fcb8c_NADCA%20PRO%20CLEAN%20%20(2)-p-800.png 800w',
        'https://cdn.prod.website-files.com/5f32dc8fbfcb095f82c1b9ec/65c9cf5e94615ead720fcb8c_NADCA%20PRO%20CLEAN%20%20(2).png 1080w',
    ];
    
    // Determine image source
    $imageSource = $data['image_source'] ?? 'url'; // 'url' or 'upload'
    $finalImageUrl = '';
    
    if ($imageSource === 'upload' && $image) {
        $normalizedImage = \Illuminate\Support\Str::startsWith($image, 'uploads/')
            ? $image
            : 'uploads/' . ltrim($image, '/');
        $finalImageUrl = asset($normalizedImage);
    } elseif ($imageSource === 'url' && $imageUrl) {
        $finalImageUrl = $imageUrl;
    } elseif (!$image && !$imageUrl) {
        // Default NADCA image
        $finalImageUrl = $defaultImage;
    }
@endphp

<div class="section-coils-2 bg-coils-2 _2">
    <div class="w-layout-grid grid-halves fullwidth-grid-halves reverse-direction">
        <div class="container align-center">
            @if($shortHeading)
                <h5 class="text-primary-1">{{ $shortHeading }}</h5>
            @endif
            @if($mainHeading)
                <h3 class="display-heading-2">
                    <span class="text-span-292">{{ $mainHeading }}</span>
                </h3>
            @endif
            @if($content)
                <div class="text-large-40">
                    <span class="text-span-8-copy"><br>{!! nl2br(e($content)) !!}<br></span>
                </div>
            @endif
        </div>
        @if($finalImageUrl)
            <div id="w-node-trusted-partner" class="container-large">
                <img src="{{ $finalImageUrl }}" 
                     width="360" 
                     sizes="(max-width: 479px) 100vw, 360px"
                     @if($finalImageUrl === $defaultImage)
                        srcset="{{ implode(', ', $defaultSrcset) }}"
                     @endif
                     alt="{{ $imageAlt ?: $mainHeading }}" 
                     class="rounded-right-large shadow-large"/>
            </div>
        @endif
    </div>
</div>


