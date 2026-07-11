@php

    $data = $section->data ?? [];
    $heading = $data['heading'] ?? '';
    $paragraph = $data['paragraph'] ?? '';
    $imageSource = $data['image_source'] ?? 'upload';
    $uploadImage = $data['background_image'] ?? '';
    $imageUrl = $data['background_image_url'] ?? '';
    $logoImageSource = $data['logo_image_source'] ?? 'upload';
    $logoUpload = $data['logo_image'] ?? '';
    $logoUrl = $data['logo_image_url'] ?? '';
    $minHeight = isset($data['min_height']) ? (int)$data['min_height'] : 500;

    $backgroundImage = '';
    if ($imageSource === 'upload' && $uploadImage) {
        $normalizedImage = \Illuminate\Support\Str::startsWith($uploadImage, 'uploads/')
            ? $uploadImage
            : 'uploads/' . ltrim($uploadImage, '/');
        $backgroundImage = asset($normalizedImage);
    } elseif ($imageSource === 'url' && $imageUrl) {
        $backgroundImage = $imageUrl;
    }

    $logoImage = '';
    if ($logoImageSource === 'upload' && $logoUpload) {
        $normalizedLogo = \Illuminate\Support\Str::startsWith($logoUpload, 'uploads/')
            ? $logoUpload
            : 'uploads/' . ltrim($logoUpload, '/');
        $logoImage = asset($normalizedLogo);
    } elseif ($logoImageSource === 'url' && $logoUrl) {
        $logoImage = $logoUrl;
    }

    $styleParts = [
        'background-size: cover',
        'background-position: center',
        'background-repeat: no-repeat',
        'min-height: ' . max(400, $minHeight) . 'px'
    ];

    if ($backgroundImage) {
        $styleParts[] = "background-image: linear-gradient(180deg, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.45) 100%), url('{$backgroundImage}')";
    } else {
        $styleParts[] = 'background-color: #0d1b2a';
    }

    $sectionStyle = implode('; ', $styleParts);
@endphp
<style>
    .custom-top-hero-section{
        width: 70% !important;
        margin: 0px auto;
    }
    .main-hero-sec-custom{
        margin-top: -87px !important;
    }
    .hero-sec-main-banner{
        margin-top: 350px !important;
    }
    .custom-cont{
        display: flex !important;
        width: 100% !important;
        justify-content: center !important;
    }
    .inside-top-main-hero{
        width: 50% !important;
        max-width: 680px !important;
    }
</style>
<section class="home-hero-section d-flex align-items-center text-white main-hero-sec-custom" style="{{ $sectionStyle }}">
    <div class="custom-cont">
        <div class="row align-items-center inside-top-main-hero">
            <div class="col-lg-12 text-center">
                @if($logoImage)
                    <div class="home-hero-logo mb-4">
                        <img class="hero-sec-main-banner" src="{{ $logoImage }}" alt="Logo" class="img-fluid" style="max-height: 150px; width: auto;">
                    </div>
                @endif
                @if($heading)
                    <h1 class="display-heading-2 mb-4">{!! nl2br(e($heading)) !!}</h1>
                @endif
                @if($paragraph)
                    <p class="text-large-4 mb-0">{!! $paragraph !!}</p>
                @endif
                <div class="nbar-right-contact" style="width:100%;justify-content:center;">
                    <a href="https://clean-air.ae/#contact_us"> Contact Us </a>
                </div>
            </div>
        </div>
    </div>
</section>