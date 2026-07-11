@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-breathe');
    $bgStyle = ND::bgStyle($data, 'https://clean-air.ae/uploads/banner-area-background.png', 'background-position: center');
@endphp

<section class="breathe-section" @if($bgStyle) style="{{ $bgStyle }}" @endif>
    <div class="container">
        <div class="breathe-wrapper">
            <div class="breathe-left">
                @if(ND::get($data, 'eyebrow'))
                    <span class="breathe-eyebrow">{{ ND::get($data, 'eyebrow') }}</span>
                @endif
                @if(ND::get($data, 'title'))
                    <h2 class="breathe-title">{!! ND::nl2br(ND::get($data, 'title')) !!}</h2>
                @endif
                @if(ND::get($data, 'description'))
                    <p class="breathe-text">{{ ND::get($data, 'description') }}</p>
                @endif
                @if(ND::get($data, 'button_text'))
                    <a href="{{ ND::get($data, 'button_url', '#') }}" class="breathe-btn">
                        {{ ND::get($data, 'button_text') }}
                        <span>→</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
