@php
    $data = $section->data ?? [];
    $shortHeading = $data['short_heading'] ?? '';
    $mainHeading = $data['main_heading'] ?? '';
    $content = $data['content'] ?? '';
    $imageSource = $data['image_source'] ?? 'upload';
    $imageUrl = $data['image_url'] ?? '';
    $image = $data['image'] ?? '';
    $imageAlt = $data['image_alt'] ?? '';
    
    // Determine image source
    $finalImageUrl = '';
    if ($imageSource === 'url' && $imageUrl) {
        $finalImageUrl = $imageUrl;
    } elseif ($imageSource === 'upload' && $image) {
        $imagePath = \Illuminate\Support\Str::startsWith($image, 'uploads/')
            ? $image
            : 'uploads/' . ltrim($image, '/');
        $finalImageUrl = asset($imagePath);
    }
@endphp

@if($shortHeading || $mainHeading || $content || $finalImageUrl)
<div class="section-coils-2 bg-coils-2">
    <div class="w-layout-grid grid-halves fullwidth-grid-halves reverse-direction">
        <div class="container align-center">
            @if($shortHeading)
                <h5 class="text-primary-1">{{ $shortHeading }}</h5>
            @endif
            @if($mainHeading)
                <h3 class="display-heading-2">
                    <span class="text-span-292">{!! $mainHeading !!}</span>
                </h3>
            @endif
            @if($content)
                <div class="text-large-40">
                    <span class="text-span-8-copy">{!! $content !!}</span>
                </div>
            @endif
        </div>
        @if($finalImageUrl)
            <div id="w-node-_2fe76fa5-bf49-7069-4b55-5f85a277f4fa-3c4af46a" class="container-large">
                <img src="{{ $finalImageUrl }}" 
                     sizes="(max-width: 479px) 100vw, (max-width: 767px) 90vw, 612px" 
                     alt="{{ $imageAlt ?: 'Service image' }}" 
                     class="rounded-right-large shadow-large">
            </div>
        @endif
    </div>
</div>
@endif

