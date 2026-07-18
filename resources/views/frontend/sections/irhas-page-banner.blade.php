@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas-page-banner');
    $bg = I::themeAsset(I::get($data, 'background_image', 'img/banner-header-service.png'));
@endphp
<div class="banner-header-style2" @if($bg) style="background-image:url('{{ $bg }}');background-position:center center;background-size:cover;" @endif>
    <div class="banner-header-style2-overlay"></div>
    <div class="thaw-container">
        <div class="title-banner-style2-wrap grid grid-cols-12">
            <div class="title-banner-style2 the-title col-span-12">
                @if(I::get($data, 'eyebrow'))
                    <h5 data-aos="fade-up" data-aos-duration="3000">{{ I::get($data, 'eyebrow') }}</h5>
                @endif
                @if(I::get($data, 'title'))
                    <h2 data-aos="fade-up" data-aos-duration="3000">{{ I::get($data, 'title') }}</h2>
                @endif
            </div>
        </div>
    </div>
</div>
