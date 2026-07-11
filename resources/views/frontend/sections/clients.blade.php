@php
    $data = $section->data ?? [];
    $heading = $data['heading'] ?? 'Our Corporate Clients';
    $description = $data['description'] ?? 'Our extensive experience gives us the chance to work with some of the most renowned names in Dubai. Contact our team today for any B2B related enquires.';
    $buttonText = $data['button_text'] ?? 'Corporate Enquiry';
    $buttonLink = $data['button_link'] ?? '/contact';
    $clients = \App\Models\ClientLogo::getActive();
@endphp

<div class="title margin-top">
    <div class="main-container">
        <div class="container-large wide align-center">
            <div class="section-title-19 text-center">
                    <h3 class="display-heading-3">{{ $heading }}</h3>
                    <div class="text-large-2">{{ $description }}</div>
            </div>
            @if($clients->count() > 0)
                <div class="logo-row">
                    @foreach($clients as $client)
                            @php
                            $logoUrl = '';
                            if ($client->logo_source === 'url' && $client->logo_url) {
                                $logoUrl = $client->logo_url;
                            } elseif ($client->logo_source === 'upload' && $client->logo) {
                                $logoPath = \Illuminate\Support\Str::startsWith($client->logo, 'uploads/')
                                    ? $client->logo
                                    : 'uploads/' . ltrim($client->logo, '/');
                                $logoUrl = asset($logoPath);
                            }
                            $logoAlt = $client->logo_alt ?? $client->name . ' Logo';
                            $customClass = strtolower(str_replace(' ', '-', $client->name));
                            // Special classes for specific clients
                            if (stripos($client->name, 'costa') !== false) {
                                $customClass .= ' costa';
                            }
                            if (stripos($client->name, 'rak') !== false || stripos($client->name, 'rakbank') !== false) {
                                $customClass .= ' rak';
                            }
                            @endphp
                        @if($logoUrl)
                            <img src="{{ $logoUrl }}" 
                                 width="auto" 
                                 alt="{{ $logoAlt }}" 
                                 class="logo-row-item {{ $customClass }}">
                        @endif
                    @endforeach
                </div>
                <div class="justify-corporate">
                    <a href="{{ $buttonLink }}" class="button-2 logo-row-button w-inline-block">
                        <div>{{ $buttonText }}</div>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
