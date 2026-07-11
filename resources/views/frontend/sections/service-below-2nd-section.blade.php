@php
    $data = $section->data ?? [];
    $content = $data['content'] ?? '';
@endphp

@if($content)
<div class="section-coils-1 bg-coils-1">
    <div class="main-container text-center">
        <div class="text-duct-cleaning">{!! nl2br(strip_tags($content, '<strong><em><b><i><br><br/>')) !!}</div>
    </div>
</div>
@endif

