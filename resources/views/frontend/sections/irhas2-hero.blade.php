@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas2-hero');
    $bg = I::themeAsset(I::get($data, 'background_image', 'img/hero-image.png'));
@endphp
<div class="bg-image-block" @if($bg) style="background-image:url('{{ $bg }}');" @endif>
    <div class="bg-image-overlay2"></div>
    <div class="thaw-container">
        <div class="head-title-wrap2 grid grid-cols-12" data-aos="fade-zoom-in">
            <div class="head-title col-span-12">
                @if(I::get($data, 'eyebrow'))
                    <h5 class="white">{{ I::get($data, 'eyebrow') }}</h5>
                @endif
                @if(I::get($data, 'title'))
                    <h2 class="the-title">{{ I::get($data, 'title') }}</h2>
                @endif
                @if(I::get($data, 'description'))
                    <p>{{ I::get($data, 'description') }}</p>
                @endif
                @if(I::get($data, 'button_text'))
                    <div class="button-head">
                        <a href="{{ I::get($data, 'button_url', '#') }}">{{ I::get($data, 'button_text') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
