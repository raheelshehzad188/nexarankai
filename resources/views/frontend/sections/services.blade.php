@php
    $services = \App\Models\Service::getActive();
@endphp

<section class="my-5 py-4">
    <div class="container">
        <h2 class="text-center mb-5">Our Services</h2>
        @if($services->count() > 0)
            <div class="row">
                @foreach($services as $service)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($service->image)
                                @php
                                    $imagePath = \Illuminate\Support\Str::startsWith($service->image, 'uploads/')
                                        ? $service->image
                                        : 'uploads/' . ltrim($service->image, '/');
                                @endphp
                                <img src="{{ asset($imagePath) }}" class="card-img-top" alt="{{ $service->title }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $service->title }}</h5>
                                <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">No services available. Add services from admin panel.</div>
        @endif
    </div>
</section>

