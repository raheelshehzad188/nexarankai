@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-promise');
    $bgStyle = ND::bgStyle($data, 'https://clean-air.ae/uploads/about-us-bg.png');
    $features = ND::items($data, 'features');
    $features2 = ND::items($data, 'features_2');
    $cardImage = ND::imageUrl($data, 'card_image', 'card_image_url', ND::get($data, 'card_image_url'));
@endphp

<section class="promise-section" @if($bgStyle) style="{{ $bgStyle }}" @endif>
    <div class="container">
        <div class="promise-header">
            @if(ND::get($data, 'eyebrow'))
                <div class="promise-eyebrow">{{ ND::get($data, 'eyebrow') }}</div>
            @endif
            @if(ND::get($data, 'title'))
                <h2>{!! ND::nl2br(ND::get($data, 'title')) !!}</h2>
            @endif
            @if(ND::get($data, 'paragraph_1'))
                <p class="promise-subtitle">{{ ND::get($data, 'paragraph_1') }}</p>
            @endif
            @if(ND::get($data, 'paragraph_2'))
                <p class="promise-subtitle">{{ ND::get($data, 'paragraph_2') }}</p>
            @endif
        </div>

        @if(count($features))
            <div class="promise-features">
                @foreach($features as $feature)
                    <div class="promise-item">
                        <span class="promise-item-icon">{{ $feature['icon'] ?? '' }}</span>
                        <h4>{!! ND::nl2br($feature['title'] ?? '') !!}</h4>
                        <p>{{ $feature['text'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="promise-features2">
            @if($cardImage || ND::get($data, 'card_title'))
                <div class="promise-item2">
                    @if($cardImage)
                        <div class="promise-item2-img">
                            <img src="{{ $cardImage }}" alt="{{ ND::get($data, 'card_title') }}">
                        </div>
                    @endif
                    <div class="promise-item2-content">
                        @if(ND::get($data, 'card_title'))<h4>{{ ND::get($data, 'card_title') }}</h4>@endif
                        @if(ND::get($data, 'card_text'))<p>{{ ND::get($data, 'card_text') }}</p>@endif
                    </div>
                </div>
            @endif
            @foreach($features2 as $feature)
                <div class="promise-item">
                    <span class="promise-item-icon">{{ $feature['icon'] ?? '' }}</span>
                    <h4>{{ $feature['title'] ?? '' }}</h4>
                    <p>{{ $feature['text'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
