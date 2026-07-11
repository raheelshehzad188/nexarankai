@php
    $data = $section->data ?? [];
    $heading = $data['heading'] ?? '';
    $content = $data['content'] ?? '';
    $buttonText = $data['button_text'] ?? 'Contact Now';
    $buttonLink = $data['button_link'] ?? '/contact';
    $linkText = $data['link_text'] ?? 'Plan A Visit';
    $linkUrl = $data['link_url'] ?? '/contact';
    $imageUrl = $data['image_url'] ?? '';
    $imageAlt = $data['image_alt'] ?? 'AC duct cleaning';
@endphp

<div class="w-layout-grid grid-halves fullwidth-grid-halves">
    <div class="container align-center">
        @if($heading)
            <h4 class="display-heading-3 left-allign">
                <span>{!! nl2br(e($heading)) !!}</span>
            </h4>
        @endif
        @if($content)
            <p class="text-block-3 blue">{!! $content !!}</p>
        @endif
        <div class="button-with-link-container">
            @if($buttonText && $buttonLink)
                <a href="{{ $buttonLink }}" class="button-2 w-inline-block">
                    <div>{{ $buttonText }}</div>
                </a>
            @endif
            @if($linkText && $linkUrl)
                <a href="{{ $linkUrl }}" class="link-with-arrow adjacent-to-button w-inline-block">
                    <div class="text-block-13">{{ $linkText }}</div>
                    <img src="{{ asset('assets/dubai/imgs/5f32dc906194420135e96ef7_icon-arrow-right.svg') }}" alt="icon arrow right" class="link-arrow-2">
                </a>
            @endif
        </div>
    </div>
    @if($imageUrl)
        <div id="w-node-de39eb38-af1b-603e-8d23-2eedd9986aa9-3c4af46a" class="container-large">
            <div class="video-wrapper">
                <img src="{{ $imageUrl }}" 
                     sizes="(max-width: 479px) 100vw, (max-width: 767px) 90vw, 612px"
                     alt="{{ $imageAlt }}" 
                     class="rounded-left shadow-large">
            </div>
        </div>
    @endif
</div>

