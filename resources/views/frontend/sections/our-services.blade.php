@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
    $data = $section->data ?? [];
    $shortHeading = $data['short_heading'] ?? 'Our Services';
    $mainHeading = $data['main_heading'] ?? 'What ' . $siteName . ' can do for you.';
    $selectedServiceIds = $data['service_ids'] ?? [];
    
    // Get services from database
    if (empty($selectedServiceIds)) {
        $services = \App\Models\Service::where('status', true)->orderBy('sort_order')->orderBy('title')->get();
    } else {
        $services = \App\Models\Service::whereIn('id', $selectedServiceIds)
            ->where('status', true)
            ->orderByRaw('FIELD(id, ' . implode(',', $selectedServiceIds) . ')')
            ->get();
    }
    
    $servicePageMap = $data['service_page_map'] ?? [];
    $mapPageIds = array_filter(array_values($servicePageMap));
    $pageSlugs = empty($mapPageIds)
        ? collect()
        : \App\Models\Page::whereIn('id', $mapPageIds)->pluck('slug', 'id');
    
    // Helper function to get service page URL by finding matching page
    $getServiceUrl = function($serviceTitle) {
        // Try to find page by matching title or slug
        $page = \App\Models\Page::where('title', 'like', '%' . $serviceTitle . '%')
            ->orWhere('slug', 'like', '%' . strtolower(str_replace(' ', '-', $serviceTitle)) . '%')
            ->where('status', 'published')
            ->first();
        
        if ($page) {
            return '/' . $page->slug;
        }
        
        // Fallback: Common service slugs mapping
        $slugMap = [
            'duct cleaning' => 'duct-cleaning-dubai',
            'sanitisation' => 'sanitization',
            'coil cleaning' => 'coil-cleaning-dubai',
            'ac cleaning' => 'ac-cleaning',
        ];
        
        $slug = strtolower($serviceTitle);
        return '/' . ($slugMap[$slug] ?? str_replace(' ', '-', $slug));
    };
@endphp

<section id="Our-Services" class="our-services-section background-spotlight">
    <div class="main-container-2">
        <div class="container-large align-center section-title">
            @if($shortHeading)
                <h5 class="text-primary-4">{{ $shortHeading }}</h5>
            @endif
            @if($mainHeading)
                <h3 class="services-header services-sub-heading">
                    <span class="text-span-293">{{ $mainHeading }}</span>
                </h3>
            @endif
        </div>
        <div class="container-large-services align-center">
            @if($services->count() > 0)
                <div class="w-layout-grid image-link-box-grid halves">
                    @foreach($services as $service)
                        <div class="container-small align-center">
                            @php
                                if ($service->slug) {
                                    $serviceUrl = $service->getUrl();
                                } elseif (isset($servicePageMap[$service->id])) {
                                    $mappedPageId = $servicePageMap[$service->id];
                                    $mappedSlug = $mappedPageId && $pageSlugs->has($mappedPageId) ? $pageSlugs[$mappedPageId] : null;
                                    $serviceUrl = $mappedSlug ? '/' . $mappedSlug : $getServiceUrl($service->title);
                                } else {
                                    $serviceUrl = $getServiceUrl($service->title);
                                }
                            @endphp
                            <a href="{{ $serviceUrl }}" class="image-link-box w-inline-block">
                                @if($service->image)
                                    @php
                                        // Check if image path starts with 'imgs/' (from assets) or uploads path
                                        if (str_starts_with($service->image, 'imgs/')) {
                                            $imagePath = asset('assets/dubai/www.proclean-ac.com/' . $service->image);
                                        } else {
                                            $normalizedPath = \Illuminate\Support\Str::startsWith($service->image, 'uploads/')
                                                ? $service->image
                                                : 'uploads/' . ltrim($service->image, '/');
                                            $imagePath = asset($normalizedPath);
                                        }
                                    @endphp
                                    <img src="{{ $imagePath }}" 
                                         alt="{{ $service->title }}" 
                                         sizes="(max-width: 1080px) 100vw, 1080px"
                                         class="service-image"/>
                                @else
                                    <div class="service-placeholder" style="width: 100%; height: 300px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                        <span>{{ $service->title }}</span>
                                    </div>
                                @endif
                                <div class="boxed-2 square-top boxed-small">
                                    <div class="image-link-box-content">
                                        <div>{{ $service->title }}</div>
                                        <img src="{{ asset('assets/dubai/imgs/5f32dc906194422c18e96ec0_icon-chevron-right.svg') }}" alt="icon chevron right"/>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center">
                    No services available. Add services from admin panel.
                </div>
            @endif
        </div>
    </div>
</section>
