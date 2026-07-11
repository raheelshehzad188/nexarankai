@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-included');
    $items = ND::items($data, 'items');
@endphp

<section class="included-section">
    <div class="container">
        @if(ND::get($data, 'eyebrow'))
            <span class="section-eyebrow">{{ ND::get($data, 'eyebrow') }}</span>
        @endif
        @if(ND::get($data, 'title'))
            <h2>{{ ND::get($data, 'title') }}</h2>
        @endif
        @if(count($items))
            <div class="included-grid">
                @foreach($items as $item)
                    <div class="service-card">
                        <div class="service-icon">{{ $item['icon'] ?? '' }}</div>
                        <h3>{{ $item['title'] ?? '' }}</h3>
                        <p>{{ $item['text'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
