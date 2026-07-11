@php
    $data = $section->data ?? [];
    $shortHeading = $data['short_heading'] ?? 'About Us';
    $mainHeading = $data['main_heading'] ?? 'Cleaner air for you and your family.';
    $content = $data['content'] ?? '';
@endphp

<div class="title mobile phone">
    <div class="w-layout-grid grid-about-us fullwidth-grid-halves-about-us">
        <div class="container-about-us align-center">
            @if($shortHeading)
                <h5 class="text-primary-1">
                    <span class="text-span-3">{{ $shortHeading }}</span>
                </h5>
            @endif
            @if($mainHeading)
                <h1 class="display-heading-2">
                    <span class="text-35">{{ $mainHeading }}</span>
                </h1>
            @endif
            @if($content)
                <div class="text-large-4-about mobile">
                    <span class="text-36">{!! nl2br(e($content)) !!}</span>
                </div>
            @endif
        </div>
    </div>
</div>

