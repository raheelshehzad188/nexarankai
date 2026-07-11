@php
    $data = $section->data ?? [];
    $heading = $data['heading'] ?? 'Interested in booking a visit with Pro Clean AC?';
    $buttonText = $data['button_text'] ?? 'Plan A Visit';
    $buttonLink = $data['button_link'] ?? '/contact';
@endphp

<div class="horizontal-cta-2 bg-prim-2">
    <div class="main-container-2">
        <div class="horizontal-cta-row">
            @if($heading)
                <h4 class="medium-heading horizontal-cta-heading">
                    <span class="get-in-touch">{{ $heading }}</span>
                </h4>
            @endif
            @if($buttonText && $buttonLink)
                <a href="{{ $buttonLink }}" class="button-5 w-inline-block">
                    <div>{{ $buttonText }}</div>
                </a>
            @endif
        </div>
    </div>
</div>

