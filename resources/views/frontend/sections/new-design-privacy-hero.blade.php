@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-privacy-hero');
    $bgStyle = ND::bgStyle($data, 'https://clean-air.ae/uploads/banner-area-background.png');
@endphp

<section class="privacy-hero" @if($bgStyle) style="{{ $bgStyle }}" @endif>
    <div class="privacy-hero-overlay"></div>
    <div class="container">
        <div class="privacy-hero-content">
            @if(ND::get($data, 'title'))
                <h1 class="privacy-hero-title">{{ ND::get($data, 'title') }}</h1>
            @endif
            <div class="privacy-hero-divider">
                <span class="privacy-line"></span>
                <div class="privacy-divider-icon">🛡️</div>
                <span class="privacy-line"></span>
            </div>
            @if(ND::get($data, 'updated_text'))
                <p class="privacy-hero-update">{{ ND::get($data, 'updated_text') }}</p>
            @endif
            @if(ND::get($data, 'description'))
                <p class="privacy-hero-text">{{ ND::get($data, 'description') }}</p>
            @endif
        </div>
    </div>
</section>
