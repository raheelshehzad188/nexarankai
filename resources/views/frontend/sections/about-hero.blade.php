@php
    $data = $section->data ?? [];
    $heading = $data['heading'] ?? 'About Us';
    $subheading = $data['subheading'] ?? '';
    $imageSource = $data['image_source'] ?? 'upload';
    $uploadImage = $data['image'] ?? '';
    $imageUrl = $data['image_url'] ?? '';
    $minHeight = isset($data['min_height']) ? (int)$data['min_height'] : 380;

    $backgroundImage = '';
    if ($imageSource === 'upload' && $uploadImage) {
        $normalizedImage = \Illuminate\Support\Str::startsWith($uploadImage, 'uploads/')
            ? $uploadImage
            : 'uploads/' . ltrim($uploadImage, '/');
        $backgroundImage = asset($normalizedImage);
    } elseif ($imageSource === 'url' && $imageUrl) {
        $backgroundImage = $imageUrl;
    }

    $styleParts = [
        'background-size: cover',
        'background-position: center',
        'background-repeat: no-repeat',
        'min-height: ' . max(240, $minHeight) . 'px'
    ];

    if ($backgroundImage) {
        $styleParts[] = "background-image: linear-gradient(180deg, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.45) 100%), url('{$backgroundImage}')";
    } else {
        $styleParts[] = 'background-color: #0d1b2a';
    }

    $sectionStyle = implode('; ', $styleParts);
@endphp

<section class="about-us-hero d-flex align-items-center text-white" style="{{ $sectionStyle }}">
    <div class="container py-5 position-relative">
        @if($heading)
            <h1 class="display-heading-2 mb-3">{!! nl2br(e($heading)) !!}</h1>
        @endif
        @if($subheading)
            <p class="text-large-40 mb-0">{!! nl2br(e($subheading)) !!}</p>
        @endif
    </div>
</section>

