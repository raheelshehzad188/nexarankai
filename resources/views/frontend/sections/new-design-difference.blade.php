@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-difference');
    $features = ND::items($data, 'features');
    $beforeImage = ND::imageUrl($data, 'before_image', 'before_image_url', ND::get($data, 'before_image_url'));
    $afterImage = ND::imageUrl($data, 'after_image', 'after_image_url', ND::get($data, 'after_image_url'));
@endphp

<section class="difference-section">
    <div class="container">
        <div class="difference-top">
            <div class="difference-content">
                @if(ND::get($data, 'eyebrow'))
                    <span class="section-eyebrow">{{ ND::get($data, 'eyebrow') }}</span>
                @endif
                @if(ND::get($data, 'title'))
                    <h2>{!! ND::nl2br(ND::get($data, 'title')) !!}</h2>
                @endif
                @if(ND::get($data, 'description'))
                    <p>{{ ND::get($data, 'description') }}</p>
                @endif
                @if(count($features))
                    <div class="difference-features">
                        @foreach($features as $feature)
                            <div class="diff-feature">
                                <span>{{ $feature['icon'] ?? '' }}</span>
                                <p>{{ $feature['text'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="difference-images">
                @if($beforeImage)
                    <div class="before-card">
                        <img src="{{ $beforeImage }}" alt="Before">
                        <div class="image-badge before">Before</div>
                    </div>
                @endif
                @if($afterImage)
                    <div class="after-card">
                        <img src="{{ $afterImage }}" alt="After">
                        <div class="image-badge after">After</div>
                    </div>
                @endif
                <div class="slider-icon">❮ ❯</div>
            </div>
        </div>
    </div>
</section>
