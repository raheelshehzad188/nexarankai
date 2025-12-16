@php
    $data = $section->data ?? [];
    $heading = $data['heading'] ?? 'Our Corporate Clients';
    $description = $data['description'] ?? '';
    $clients = \App\Models\ClientLogo::getActive();
    $assets_url = asset('assets/dubai/www.proclean-ac.com');
@endphp

<div class="title margin-top">
    <div class="main-container">
        <div class="container-large wide align-center">
            <div class="section-title-19 text-center">
                @if($heading)
                    <h3 class="display-heading-3">{{ $heading }}</h3>
                @endif
                @if($description)
                    <div class="text-large-2">{{ $description }}</div>
                @endif
            </div>
            @if($clients->count() > 0)
                <div class="logo-row">
                    @foreach($clients as $client)
                        @if($client->logo)
                            <img src="{{ asset('storage/' . $client->logo) }}" 
                                 alt="{{ $client->name }}" 
                                 class="logo-row-item {{ strtolower(str_replace(' ', '-', $client->name)) }}"
                                 width="auto"/>
                        @else
                            <span class="logo-row-item">{{ $client->name }}</span>
                        @endif
                    @endforeach
                </div>
                <div class="justify-corporate">
                    <a href="/contact" class="button-2 logo-row-button w-inline-block">
                        <div>Corporate Enquiry</div>
                    </a>
                </div>
            @else
                <div class="alert alert-info text-center">No client logos available. Add client logos from admin panel.</div>
            @endif
        </div>
    </div>
</div>
