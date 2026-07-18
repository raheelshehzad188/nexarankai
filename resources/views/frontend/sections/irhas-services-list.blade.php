@php
    use App\Models\Service;
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas-services-list');
    $services = Service::where('status', true)->with('serviceCategory')->orderBy('sort_order')->orderBy('title')->get();
    $defaultImage = I::themeAsset(I::get($data, 'default_card_image', 'img/service-1-service-page-irhas-3.png'));
@endphp

<div class="service-block">
    <div class="thaw-container">
        <div class="service-wrapper">
            @if($services->count())
                <div id="irhas-service-2" class="service-block-loop grid grid-cols-12 gap-6" data-aos="fade-in-zoom">
                    @foreach($services as $service)
                        @php
                            $image = $service->imageUrl('image') ?: $defaultImage;
                        @endphp
                        <div class="service-item col-span-4 sm:col-span-12 res:col-span-6">
                            <div class="service-style-2">
                                <a class="service-link" href="{{ $service->getUrl() }}"></a>
                                <div class="arrow"><i class="icon-irhas icon-themify"></i></div>
                                <div class="service-thumb-container">
                                    <div class="service-thumb">
                                        <img src="{{ $image }}" alt="{{ $service->title }}">
                                    </div>
                                </div>
                                <div class="service-hover"></div>
                                <div class="service-grid-content">
                                    <div class="service-grid-text">
                                        <div class="title-content"><h5>{{ $service->title }}</h5></div>
                                        @if($service->category_name)
                                            <div class="category-content"><p>{{ $service->category_name }}</p></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-5 text-center">
                    <p>No services published yet. Add services from the admin panel.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@if(I::get($data, 'contact_title'))
    <div class="banner-contact-block">
        <div class="thaw-container">
            <div class="title-banner-contact grid grid-cols-12">
                <div class="title-contact-banner col-span-12">
                    <div class="the-title">
                        <h2>{{ I::get($data, 'contact_title') }}</h2>
                        @if(I::get($data, 'contact_description'))
                            <p data-aos="fade-up" data-aos-duration="1500">{{ I::get($data, 'contact_description') }}</p>
                        @endif
                    </div>
                    @if(I::get($data, 'contact_button_text'))
                        <div class="button-banner-contact" data-aos="fade-up" data-aos-duration="1500">
                            <a href="{{ I::get($data, 'contact_button_url', '#') }}">{{ I::get($data, 'contact_button_text') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
