@php
    $data = $section->data ?? [];
@endphp

<section class="bg-primary text-white py-5 mb-4">
    <div class="container text-center">
        <h1 class="display-4 mb-3">{!! $data['title'] ?? 'Welcome' !!}</h1>
        @if(isset($data['subtitle']) && !empty($data['subtitle']))
            <p class="lead">{!! $data['subtitle'] !!}</p>
        @endif
    </div>
</section>

