@php
    $data = $section->data ?? [];
    $content = $data['content'] ?? '';
@endphp

<div class="section-coils-1 bg-coils-1">
    <div class="main-container text-center">
        @if($content)
            <div class="text-duct-cleaning">{!! $content !!}</div>
        @endif
    </div>
</div>

