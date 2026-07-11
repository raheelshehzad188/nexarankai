@php
    $data = $section->data ?? [];
@endphp

{{-- Legacy section: use individual "New design" section types instead. --}}
@if(!empty($data['title']))
<section class="new-full-section" style="width:100%;padding:60px 20px;text-align:center;">
    <div class="new-full-inner" style="max-width:1140px;margin:0 auto;">
        <h2 class="new-full-title">{{ $data['title'] }}</h2>
    </div>
</section>
@endif
