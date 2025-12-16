@php
    $data = $section->data ?? [];
    $shortHeading = $data['short_heading'] ?? 'A trusted partner';
    $mainHeading = $data['main_heading'] ?? 'We are NADCA Accredited';
    $content = $data['content'] ?? '';
    $image = $data['image'] ?? '';
    $imageUrl = $data['image_url'] ?? '';
    $assets_url = asset('assets/dubai/www.proclean-ac.com');
    
    // Determine image source
    $imageSource = $data['image_source'] ?? 'url'; // 'url' or 'upload'
    $finalImageUrl = '';
    
    if ($imageSource === 'upload' && $image) {
        $finalImageUrl = asset('storage/' . $image);
    } elseif ($imageSource === 'url' && $imageUrl) {
        $finalImageUrl = $imageUrl;
    } elseif (!$image && !$imageUrl) {
        // Default NADCA image
        $finalImageUrl = $assets_url . '/../imgs/65c9cf5e94615ead720fcb8c_NADCA%20PRO%20CLEAN%20%20(2).png';
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
                     alt="{{ $mainHeading }}" 
                     class="rounded-right-large shadow-large"/>
            </div>
        @endif
    </div>
</div>

