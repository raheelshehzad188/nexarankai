@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-privacy-content');
    $blocks = ND::items($data, 'blocks');
@endphp

<section class="privacy-content-section">
    <div class="container">
        <div class="privacy-card">
            @forelse($blocks as $block)
                <div class="privacy-row {{ $loop->last ? 'privacy-row-last' : '' }}">
                    @if(!empty($block['icon']))
                        <div class="privacy-icon">{{ $block['icon'] }}</div>
                    @endif
                    <div class="privacy-content">
                        @if(!empty($block['title']))
                            <h2>{{ $block['title'] }}</h2>
                        @endif
                        @if(!empty($block['content']))
                            <div>{!! $block['content'] !!}</div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="privacy-row">
                    <div class="privacy-icon">🛡️</div>
                    <div class="privacy-content">
                        <h2>Privacy Content</h2>
                        <p>Add content blocks from the admin panel to display your privacy policy sections.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
