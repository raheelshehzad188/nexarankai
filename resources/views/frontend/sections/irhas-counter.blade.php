@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas-counter');
    $items = I::items($data, 'items');
@endphp
<div class="counter-block" id="testi2-mouseover">
    <div class="thaw-container">
        <div class="counter-wrap grid grid-cols-12" data-aos="fade-zoom-in">
            @foreach($items as $item)
                <div class="counter-item col-span-4 sm:col-span-12 sm:grid-cols-12">
                    <div class="number-counter flex">
                        @if(!empty($item['prefix']))<span>{{ $item['prefix'] }}</span>@endif
                        <h3 class="timer counter-number count-number" data-to="{{ $item['number'] ?? '0' }}" data-speed="10000">{{ $item['number'] ?? '0' }}</h3>
                        @if(!empty($item['suffix']))<span>{{ $item['suffix'] }}</span>@endif
                    </div>
                    @if(!empty($item['label']))
                        <div class="desc-counter">
                            <p><span class="divider-counter"></span>{{ $item['label'] }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
