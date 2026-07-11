@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas-testimonial');
    $items = I::items($data, 'items');
    $sideImage = I::imageUrl($data, 'side_image');
@endphp
<div class="testimonial-block" id="testi-mouseover">
    @include('frontend.partials.irhas.svg-shape')
    <div class="thaw-container">
        <div class="testimonial-wrap">
            <div class="title-testimonial-wrap grid grid-cols-12" data-aos="fade-zoom-in">
                <div class="title-testimonial the-title col-span-6 mobile-show">
                    @if(I::get($data, 'eyebrow'))<h5>{{ I::get($data, 'eyebrow') }}</h5>@endif
                    @if(I::get($data, 'title_mobile', I::get($data, 'title')))<h2>{{ I::get($data, 'title_mobile', I::get($data, 'title')) }}</h2>@endif
                    @if(I::get($data, 'description'))
                        <div class="the-desc"><p>{{ I::get($data, 'description') }}</p></div>
                    @endif
                    @if(I::get($data, 'button_text'))
                        <div class="button-testi"><a href="{{ I::get($data, 'button_url', '#') }}">{{ I::get($data, 'button_text') }}</a></div>
                    @endif
                </div>
                <div class="testimonial-swiper-wrap col-span-6">
                    <div class="testimonial-style-3">
                        <div class="swiper-container">
                            <div class="navigation-swipper clearfix">
                                <div class="progress-swiper"><div id="progress-irhas"></div></div>
                                <div class="swipper-button clearfix">
                                    <div class="swiper-button-next"><i class="fa fa-chevron-right"></i></div>
                                    <div class="swiper-button-prev"><i class="fa fa-chevron-left"></i></div>
                                </div>
                            </div>
                            <div class="swiper-wrapper">
                                @foreach($items as $item)
                                    <div class="swiper-slide">
                                        <div class="testimonial-detail-inner">
                                            @if(!empty($item['author']))<h5 class="testi-author">{{ $item['author'] }}</h5>@endif
                                            @if(!empty($item['job']))<p class="testi-job">{{ $item['job'] }}</p>@endif
                                            @if(!empty($item['quote']))<h3>"{{ $item['quote'] }}"</h3>@endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($sideImage)
                                <div id="smartobject-testi" class="smartobject-testi">
                                    <img src="{{ $sideImage }}" alt="testimonial">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="title-testimonial the-title col-span-6 mobile-hide">
                    @if(I::get($data, 'eyebrow'))<h5>{{ I::get($data, 'eyebrow') }}</h5>@endif
                    @if(I::get($data, 'title'))<h2>{{ I::get($data, 'title') }}</h2>@endif
                    @if(I::get($data, 'description'))
                        <div class="the-desc"><p>{{ I::get($data, 'description') }}</p></div>
                    @endif
                    @if(I::get($data, 'button_text'))
                        <div class="button-testi"><a href="{{ I::get($data, 'button_url', '#') }}">{{ I::get($data, 'button_text') }}</a></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
