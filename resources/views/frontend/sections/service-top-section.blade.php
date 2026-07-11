@php
    $data = $section->data ?? [];
    $shortHeading = $data['short_heading'] ?? '';
    $mainHeading = $data['main_heading'] ?? '';
    $content = $data['content'] ?? '';
@endphp

<div class="title-section-white-bg">
    <div class="main-container text-center">
        <div class="container-large page-title align-center">
            @if($shortHeading)
                <h5 class="text-primary-1">{{ $shortHeading }}</h5>
            @endif
            @if($mainHeading)
                <h1 class="display-heading-1 page-heading">{!! nl2br(e($mainHeading)) !!}</h1>
            @endif
        </div>
        @if($content)
            <div class="container-large align-center">
                <p class="text-large-4">
                    <span class="text-services">{!! $content !!}</span>
                </p>
            </div>
        @endif
    </div>
</div>

