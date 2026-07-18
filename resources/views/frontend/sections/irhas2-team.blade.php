@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas2-team');
    $items = I::items($data, 'items');
@endphp
<div class="team-block-home2">
    <div class="thaw-container">
        <div class="team-wrap grid grid-cols-12 gap-6">
            <div class="title-team-wrap col-span-6 res:col-span-6 sm:col-span-12">
                <div class="title-team the-title">
                    @if(I::get($data, 'eyebrow'))<h5>{{ I::get($data, 'eyebrow') }}</h5>@endif
                    @if(I::get($data, 'title'))<h2>{{ I::get($data, 'title') }}</h2>@endif
                </div>
                @if(I::get($data, 'description'))
                    <div class="desc-team"><p>{{ I::get($data, 'description') }}</p></div>
                @endif
            </div>
            @if(I::get($data, 'button_text'))
                <div class="button-team-wrap col-span-6 res:col-span-6 sm:col-span-12">
                    <div class="button-team">
                        <a href="{{ I::get($data, 'button_url', '#') }}">{{ I::get($data, 'button_text') }}</a>
                    </div>
                </div>
            @endif
        </div>
        @if(count($items))
            <div class="team-loop-wrap grid grid-cols-12 gap-8" data-aos="fade-zoom-in">
                @foreach($items as $item)
                    <div class="team-style-1 col-span-3 res:col-span-6 sm:col-span-12 team-item">
                        <div class="team-container text-center clearfix">
                            <img src="{{ I::themeAsset($item['image'] ?? 'img/img-team-1- irhas2.png') }}" alt="{{ $item['name'] ?? 'Team' }}">
                            <div class="item-content">
                                @if(!empty($item['name']))
                                    <div class="title-style"><h3>{{ $item['name'] }}</h3></div>
                                @endif
                                @if(!empty($item['role']))
                                    <div class="job-style"><span>{{ $item['role'] }}</span></div>
                                @endif
                                <div class="social-links clearfix">
                                    <ul class="clearfix">
                                        @if(!empty($item['facebook']))
                                            <li><a href="{{ $item['facebook'] }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li>
                                        @endif
                                        @if(!empty($item['twitter']))
                                            <li><a href="{{ $item['twitter'] }}" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></li>
                                        @endif
                                        @if(!empty($item['linkedin']))
                                            <li><a href="{{ $item['linkedin'] }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
