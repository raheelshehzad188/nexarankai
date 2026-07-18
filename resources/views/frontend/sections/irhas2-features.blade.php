@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas2-features');
    $items = I::items($data, 'items');
@endphp
<div class="about-block-home2">
    <div class="thaw-container">
        <div class="about-home2-wrap grid grid-cols-12 gap-6">
            <div class="title-about-home2 col-span-12">
                <div class="the-title about-title-home2">
                    @if(I::get($data, 'eyebrow'))<h5>{{ I::get($data, 'eyebrow') }}</h5>@endif
                    @if(I::get($data, 'title'))<h2>{{ I::get($data, 'title') }}</h2>@endif
                    @if(I::get($data, 'description'))<p>{{ I::get($data, 'description') }}</p>@endif
                </div>
            </div>
        </div>
        @if(count($items))
            <div class="service-about-home2 grid grid-cols-12" data-aos="fade-up">
                @foreach($items as $item)
                    <div class="service-item-style-1 content-item col-span-4 res:col-span-4 sm:col-span-12">
                        <div class="post-content-wrap clearfix">
                            <div class="post-inner">
                                <div class="post-thumb">
                                    <img src="{{ I::themeAsset($item['image'] ?? 'img/img-home-gif-1.png') }}" alt="{{ $item['title'] ?? '' }}">
                                </div>
                                <div class="image-description-content">
                                    @if(!empty($item['title']))
                                        <div class="title-content"><h4>{{ $item['title'] }}</h4></div>
                                    @endif
                                    @if(!empty($item['excerpt']))
                                        <div class="item-excerpt"><p>{{ $item['excerpt'] }}</p></div>
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
