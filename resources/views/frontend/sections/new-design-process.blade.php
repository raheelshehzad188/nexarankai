@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-process');
    $steps = ND::items($data, 'steps');
@endphp

<section class="process-section">
    <div class="container">
        <div class="process-wrapper">
            <div class="process-left">
                @if(ND::get($data, 'eyebrow'))
                    <span class="process-eyebrow">{{ ND::get($data, 'eyebrow') }}</span>
                @endif
                @if(ND::get($data, 'title'))
                    <h2 class="process-title">{{ ND::get($data, 'title') }}</h2>
                @endif
                @if(ND::get($data, 'description'))
                    <p class="process-text">{{ ND::get($data, 'description') }}</p>
                @endif
                @if(ND::get($data, 'button_text'))
                    <a href="{{ ND::get($data, 'button_url', '#') }}" class="process-btn">
                        {{ ND::get($data, 'button_text') }}
                        <span>→</span>
                    </a>
                @endif
            </div>
            @if(count($steps))
                <div class="process-right">
                    @foreach($steps as $step)
                        <div class="process-card {{ !empty($step['last']) ? 'process-last' : '' }}">
                            <div class="process-number">{{ $step['number'] ?? '' }}</div>
                            @if(empty($step['last']))<div class="process-line"></div>@endif
                            <div class="process-icon">{{ $step['icon'] ?? '' }}</div>
                            <h3>{{ $step['title'] ?? '' }}</h3>
                            <p>{{ $step['text'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
