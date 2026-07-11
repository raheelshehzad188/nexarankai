@php
    $data = $section->data ?? [];
    $heading = $data['heading'] ?? 'What We Do.';
    $selectedServiceIds = $data['service_ids'] ?? [];
    
    // Get selected services or all active services if none selected
    if (empty($selectedServiceIds)) {
        $services = \App\Models\Service::where('status', true)->orderBy('title')->get();
    } else {
        $services = \App\Models\Service::whereIn('id', $selectedServiceIds)
            ->where('status', true)
            ->orderByRaw('FIELD(id, ' . implode(',', $selectedServiceIds) . ')')
            ->get();
    }
    
    // Handle background image
    $backgroundImage = '';
    $imageSource = $data['image_source'] ?? 'upload';
    $uploadImage = $data['image'] ?? '';
    $imageUrl = $data['image_url'] ?? '';
    
    if ($imageSource === 'url' && $imageUrl) {
        $backgroundImage = $imageUrl;
    } elseif ($imageSource === 'upload' && $uploadImage) {
        $normalizedImage = \Illuminate\Support\Str::startsWith($uploadImage, 'uploads/')
            ? $uploadImage
            : 'uploads/' . ltrim($uploadImage, '/');
        $backgroundImage = asset($normalizedImage);
    }
    
    // Build style string
    $styleParts = [];
    if ($backgroundImage) {
        $styleParts[] = "background-image: url('{$backgroundImage}')";
        $styleParts[] = "background-size: cover";
        $styleParts[] = "background-position: center";
        $styleParts[] = "background-repeat: no-repeat";
    }
    $divStyle = !empty($styleParts) ? implode('; ', $styleParts) . ';' : '';
@endphp

<div class="section-grid-halves bg-primary-2">
    <div class="section-block no-padding">
        <div class="div-image" style="{{ $divStyle }}"></div>
    </div>
    <div class="section-block">
        <div class="container tablet">
            <div class="section-title text-center">
                @if($heading)
                    <h3 class="large-heading-copy section-title allign-left">{{ $heading }}</h3>
                @endif
            </div>
            @if($services->count() > 0)
                <div class="w-layout-grid icon-circle-horizontal-grid-vertical">
                    @foreach($services as $service)
                        @if($service->icon_url || $service->description)
                            <div class="icon-circle-horizontal">
                                @if($service->icon_url)
                                    <div class="icon-circle bg-primary-1">
                                        <img src="{{ $service->icon_url }}" width="35" alt="{{ $service->title }}" class="image-icon">
                                    </div>
                                @endif
                                <div class="icon-circle-horizontal-content">
                                    @if($service->title)
                                        <h5>{{ $service->title }}</h5>
                                    @endif
                                    @if($service->description)
                                        <div>{{ $service->description }}</div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center">No services available. Add services from admin panel.</div>
            @endif
        </div>
    </div>
</div>

