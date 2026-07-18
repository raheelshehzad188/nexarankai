@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas2-about-video');
    $poster = I::imageUrl($data, 'video_poster', 'img/img-video-irhas-2.png');
    $secondary = I::imageUrl($data, 'secondary_image', 'img/smartobject.png');
@endphp
<div class="about2-home2-block" id="mouseover">
    <div class="thaw-container">
        <div class="about2-home2-wrap grid grid-cols-12 gap-6">
            <div class="about2-video-wrap col-span-6 sm:col-span-12 res:col-span-12" data-aos="fade-right">
                <div class="smart-object" id="inner1">
                    <a href data-lg-size="1280-720"
                        data-src="{{ I::get($data, 'video_url', 'https://www.youtube.com/watch?v=BsafeSHN_II') }}"
                        data-poster="{{ $poster }}">
                        @if($poster)<img src="{{ $poster }}" alt="video-banner">@endif
                        <div class="play-button"><i class="fas fa-play"></i></div>
                    </a>
                </div>
                @if($secondary)
                    <div class="smart-object2" id="inner2">
                        <img src="{{ $secondary }}" alt="smartobject">
                    </div>
                @endif
            </div>
            <div class="about2-title-wrap the-title col-span-6 sm:col-span-12 res:col-span-12" data-aos="fade-left">
                @if(I::get($data, 'eyebrow'))<h5>{{ I::get($data, 'eyebrow') }}</h5>@endif
                @if(I::get($data, 'title'))<h2>{{ I::get($data, 'title') }}</h2>@endif
                @if(I::get($data, 'quote'))
                    <div class="the-desc"><i>"{{ I::get($data, 'quote') }}"</i></div>
                @endif
                @if(I::get($data, 'description'))
                    <p>{{ I::get($data, 'description') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
