@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
    $data = $section->data ?? [];
    $heading = $data['heading'] ?? 'Interested in booking a visit with ' . $siteName . '?';
    $btnText = $data['btn_text'] ?? 'Plan A Visit';
    $btnLink = $data['btn_link'] ?? '/contact';
@endphp

<div class="horizontal-cta-2 bg-prim-2">
    <div class="main-container-2">
        <div class="horizontal-cta-row">
            @if($heading)
                <h4 class="medium-heading horizontal-cta-heading">
                    <span class="get-in-touch">{{ $heading }}</span>
                </h4>
            @endif
            @if($btnText && $btnLink)
                <a href="{{ $btnLink }}" class="button-5 w-inline-block">
                    <div>{{ $btnText }}</div>
                </a>
            @endif
        </div>
    </div>
</div>


