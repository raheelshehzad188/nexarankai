@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-nadca');
    $bgStyle = ND::bgStyle($data, 'https://clean-air.ae/uploads/nadaca-background.png');
    $features = ND::items($data, 'features');
    $logoImage = ND::imageUrl($data, 'logo_image', 'logo_image_url', ND::get($data, 'logo_image_url'));
@endphp

<section class="nadca-section" @if($bgStyle) style="{{ $bgStyle }}" @endif>
    <div class="container">
        <div class="nadca-wrapper">
            <div class="nadca-left">
                @if(ND::get($data, 'eyebrow'))
                    <span class="nadca-eyebrow">{{ ND::get($data, 'eyebrow') }}</span>
                @endif
                @if(ND::get($data, 'title'))
                    <h2 class="nadca-title">{!! ND::nl2br(ND::get($data, 'title')) !!}</h2>
                @endif
                @if(ND::get($data, 'description'))
                    <p class="nadca-text">{{ ND::get($data, 'description') }}</p>
                @endif
                @if(count($features))
                    <div class="nadca-features">
                        @foreach($features as $feature)
                            <div class="nadca-feature">
                                <div class="nadca-icon">{{ $feature['icon'] ?? '' }}</div>
                                <div class="nadca-content">
                                    <h4>{{ $feature['title'] ?? '' }}</h4>
                                    <p>{{ $feature['text'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="nadca-right">
                <div class="nadca-card">
                    @if($logoImage)
                        <div class="nadca-logo">
                            <img src="{{ $logoImage }}" alt="NADCA Logo">
                        </div>
                    @endif
                    <div class="nadca-divider"></div>
                    @if(ND::get($data, 'card_text'))
                        <p class="nadca-card-text">{{ ND::get($data, 'card_text') }}</p>
                    @else
                        <p class="nadca-card-text">
                            Clean Air is a NADCA accredited company committed to delivering professional AC duct cleaning services that meet international standards for safety, hygiene and HVAC system performance.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
