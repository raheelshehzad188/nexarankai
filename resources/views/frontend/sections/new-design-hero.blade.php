@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-hero');
    $bgStyle = ND::bgStyle($data, 'https://clean-air.ae/uploads/banner-area-background.png');
    $mobileBg = ND::mobileBgStyle($data, 'https://clean-air.ae/uploads/hero-banner-mobile.jpeg');
    $features = ND::items($data, 'features');
@endphp

@if($mobileBg)
    @push('styles')
    <style>@media(max-width:768px){ .new-design-hero { {{ $mobileBg }}; } }</style>
    @endpush
@endif

<section class="hero new-design-hero" @if($bgStyle) style="{{ $bgStyle }}" @endif>
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-left">
                <span class="hero-line"></span>
                @if(ND::get($data, 'title'))
                    <h1>{!! ND::nl2br(ND::get($data, 'title')) !!}</h1>
                @endif
                @if(ND::get($data, 'subtitle'))
                    <p class="hero-subtitle">{{ ND::get($data, 'subtitle') }}</p>
                @endif
                @if(count($features))
                    <div class="hero-features">
                        @foreach($features as $feature)
                            <div class="feature-item">
                                <span>{{ $feature['icon'] ?? '' }}</span>
                                <p>{{ $feature['text'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if(ND::get($data, 'button_text'))
                    <a href="{{ ND::get($data, 'button_url', '#') }}" class="hero-btn">
                        {{ ND::get($data, 'button_text') }}
                        <span>→</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
