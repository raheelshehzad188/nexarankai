@php
    $data = $section->data ?? [];
@endphp

<section class="my-5 py-4">
    <div class="container">
        @if(isset($data['content']) && !empty($data['content']))
            <div class="content-section">{!! $data['content'] !!}</div>
        @else
            <div class="alert alert-info">Content section - Add content from admin panel</div>
        @endif
    </div>
</section>

