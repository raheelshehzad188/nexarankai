@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas-portfolio');
    $items = I::items($data, 'items');
@endphp
<div class="portfolio-block portfolio-home3">
    @include('frontend.partials.irhas.svg-shape')
    <div class="thaw-container">
        <div class="portfolio-wrap">
            <div class="portfolio-title-wrap grid grid-cols-12">
                <div class="title-portfolio col-span-6 res:col-span-12 sm:col-span-12">
                    <div class="the-title">
                        @if(I::get($data, 'eyebrow'))<h5>{{ I::get($data, 'eyebrow') }}</h5>@endif
                        @if(I::get($data, 'title'))<h2>{{ I::get($data, 'title') }}</h2>@endif
                    </div>
                    @if(I::get($data, 'description'))
                        <div class="the-desc"><p>{{ I::get($data, 'description') }}</p></div>
                    @endif
                </div>
                @if(I::get($data, 'button_text'))
                    <div class="button-portfolio-wrap col-span-6 res:col-span-12 sm:col-span-12">
                        <div class="portfolio-button">
                            <a href="{{ I::get($data, 'button_url', '#') }}">{{ I::get($data, 'button_text') }}</a>
                        </div>
                    </div>
                @endif
            </div>
            @if(count($items))
                <div class="portfolio-item-loop grid grid-cols-12 gap-8" data-aos="fade-zoom-in">
                    @foreach($items as $item)
                        @php $image = I::themeAsset($item['image'] ?? ''); @endphp
                        <div class="portfolio-item col-span-3 sm:col-span-12 res:col-span-6">
                            <div class="portfolio-style-1">
                                <a class="portfolio-link" href="{{ $item['link'] ?? '#' }}"></a>
                                @if($image)
                                    <div class="portfolio-grid-image-container">
                                        <div class="portfolio-grid-image">
                                            <img loading="lazy" src="{{ $image }}" alt="{{ $item['title'] ?? '' }}" width="800" height="373">
                                        </div>
                                    </div>
                                @endif
                                <div class="portfolio-hover"></div>
                                <div class="portfolio-grid-content">
                                    <div class="portfolio-grid-text">
                                        @if(!empty($item['title']))<h5 class="portfolio-title">{{ $item['title'] }}</h5>@endif
                                        @if(!empty($item['category']))<p class="portfolio-cate">{{ $item['category'] }}</p>@endif
                                        @if(!empty($item['excerpt']))
                                            <div class="portfolio-excerpt"><p>{{ $item['excerpt'] }}</p></div>
                                        @endif
                                    </div>
                                    <div class="portfolio-read-more">Learn More</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
