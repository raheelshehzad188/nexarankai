@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas-services');
    $items = I::items($data, 'items');
@endphp
<div class="service-block">
    @include('frontend.partials.irhas.svg-shape')
    <div class="thaw-container">
        <div class="service-wrapper">
            <div class="service-title-wrap grid grid-cols-12">
                <div class="title-service-wrap col-span-6 sm:col-span-12 res:col-span-8">
                    <div class="the-title">
                        @if(I::get($data, 'eyebrow'))<h5>{{ I::get($data, 'eyebrow') }}</h5>@endif
                        @if(I::get($data, 'title'))<h2>{{ I::get($data, 'title') }}</h2>@endif
                    </div>
                    @if(I::get($data, 'description'))
                        <div class="the-desc"><p>{{ I::get($data, 'description') }}</p></div>
                    @endif
                </div>
                @if(I::get($data, 'button_text'))
                    <div class="service-button-wrap col-span-6 sm:col-span-12 res:col-span-4">
                        <div class="service-button">
                            <a href="{{ I::get($data, 'button_url', '#') }}">{{ I::get($data, 'button_text') }}</a>
                        </div>
                    </div>
                @endif
            </div>
            @if(count($items))
                <div id="irhas-service-2" class="service-block-loop grid grid-cols-12 gap-12" data-aos="fade-zoom-in">
                    @foreach($items as $item)
                        @php $image = I::themeAsset($item['image'] ?? ''); @endphp
                        <div class="service-item col-span-3 sm:col-span-12 res:col-span-6">
                            <div class="service-style-2">
                                <a class="service-link" href="{{ $item['link'] ?? '#' }}"></a>
                                <div class="arrow"><i class="icon-irhas icon-themify"></i></div>
                                @if($image)
                                    <div class="service-thumb-container">
                                        <div class="service-thumb">
                                            <img src="{{ $image }}" alt="{{ $item['title'] ?? '' }}">
                                        </div>
                                    </div>
                                @endif
                                <div class="service-hover"></div>
                                <div class="service-grid-content">
                                    <div class="service-grid-text">
                                        @if(!empty($item['title']))
                                            <div class="title-content"><h5>{{ $item['title'] }}</h5></div>
                                        @endif
                                        @if(!empty($item['category']))
                                            <div class="category-content"><p>{{ $item['category'] }}</p></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
