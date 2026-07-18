@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas2-testimonial');
    $items = I::items($data, 'items');
@endphp
<div class="testimonial-home2-block">
    <div class="thaw-container">
        <div class="testimonial-home2-title grid grid-cols-12">
            <div class="the-title col-span-12">
                @if(I::get($data, 'eyebrow'))<h5>{{ I::get($data, 'eyebrow') }}</h5>@endif
                @if(I::get($data, 'title'))<h2 class="white">{{ I::get($data, 'title') }}</h2>@endif
            </div>
        </div>
        @if(count($items))
            <div class="testimonial-style-1" data-aos="fade-zoom-in">
                <div class="swiper-button clearfix">
                    <div class="swiper-button-next"><i class="icon-irhas icon-right-arrow-1"></i></div>
                    <div class="swiper-button-prev"><i class="icon-irhas icon-left-arrow"></i></div>
                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($items as $item)
                            <div class="swiper-slide">
                                <div class="testimonial-detail-inner">
                                    @if(!empty($item['quote']))
                                        <h3>"{{ $item['quote'] }}"</h3>
                                    @endif
                                    @if(!empty($item['author']))
                                        <h5 class="testi-author">{{ $item['author'] }}</h5>
                                    @endif
                                    @if(!empty($item['job']))
                                        <p class="testi-job">{{ $item['job'] }}</p>
                                    @endif
                                </div>
                                <div class="swiper-image-testimonial">
                                    <figure class="swiper-image">
                                        <img src="{{ I::themeAsset($item['logo'] ?? 'img/testimonial-img-logo-1.png') }}" alt="{{ $item['author'] ?? 'testimonial' }}">
                                    </figure>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
