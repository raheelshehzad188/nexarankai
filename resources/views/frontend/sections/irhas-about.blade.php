@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas-about');
    $poster = I::imageUrl($data, 'video_poster');
    $secondary = I::imageUrl($data, 'secondary_image');
@endphp
<div class="about-block" id="mouseover">
    <div class="thaw-container">
        <div class="about-wrap grid grid-cols-12 gap-6">
            <div class="about-desc col-span-6 sm:col-span-12 res:col-span-12">
                <div class="the-title">
                    @if(I::get($data, 'eyebrow'))
                        <h5>{{ I::get($data, 'eyebrow') }}</h5>
                    @endif
                    @if(I::get($data, 'title'))
                        <h1>{{ I::get($data, 'title') }}</h1>
                    @endif
                </div>
                @if(I::get($data, 'description'))
                    <div class="the-desc">
                        <p>{{ I::get($data, 'description') }}</p>
                    </div>
                @endif
                @if(I::get($data, 'button_text'))
                    <div class="button-about-wrap" data-aos="fade-up">
                        <div class="button-about">
                            <a href="{{ I::get($data, 'button_url', '#') }}">{{ I::get($data, 'button_text') }}</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="about-image col-span-6 sm:col-span-12 res:col-span-12">
                <div class="about2-video-wrap col-span-6">
                    <div id="inner1" class="smart-object" data-aos="fade-left" data-aos-duration="1500">
                        <a href data-lg-size="1280-720"
                            data-src="{{ I::get($data, 'video_url', '#') }}"
                            data-poster="{{ $poster }}">
                            @if($poster)
                                <img src="{{ $poster }}" alt="video">
                            @endif
                            <div class="button-embed-play" role="button">
                                <i class="fa fa-play" aria-hidden="true"></i>
                                <span class="screen-only"></span>
                            </div>
                        </a>
                    </div>
                    @if($secondary)
                        <div id="inner2" class="smart-object2" data-aos="fade-left" data-aos-duration="1000">
                            <img src="{{ $secondary }}" alt="about">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
