@php
    use App\Models\Service;
    use App\Models\SiteSetting;
    use App\Support\IrhasSectionData as I;

    $data = I::withDefaults($section->data ?? [], 'irhas-contact');
    $settings = SiteSetting::getSettings();
    $phone = $settings->header_phone;
    $email = $settings->header_email;
    $address = $settings->site_address;
    $socialLinks = is_array($settings->social_links ?? null) ? $settings->social_links : [];
    $services = Service::where('status', true)->orderBy('sort_order')->orderBy('title')->get();
    $socialIcons = [
        'facebook' => 'fab fa-facebook-f',
        'instagram' => 'fab fa-instagram',
        'youtube' => 'fab fa-youtube',
        'twitter' => 'fab fa-twitter',
        'x' => 'fab fa-x-twitter',
        'linkedin' => 'fab fa-linkedin-in',
        'google' => 'fab fa-google',
    ];
    $mapUrl = I::get($data, 'map_embed_url', 'https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&t=m&z=18&output=embed&iwloc=near');
@endphp

<div class="navigation-block">
    <div class="thaw-container">
        <div class="navigation-wrap grid grid-cols-12 gap-8">
            <div class="maps-wrap col-span-6 sm:col-span-12 res:col-span-12" data-aos="fade-right">
                <iframe src="{{ $mapUrl }}" title="Location map" loading="lazy"></iframe>
            </div>
            <div class="detail-navigation-wrap col-span-6 sm:col-span-12 res:col-span-12 grid grid-cols-12">
                <div class="title-navigation the-title col-span-12">
                    @if(I::get($data, 'eyebrow'))
                        <h5>{{ I::get($data, 'eyebrow') }}</h5>
                    @endif
                    @if(I::get($data, 'title'))
                        <h2>{{ I::get($data, 'title') }}</h2>
                    @endif
                </div>
                @if($address)
                    <div class="item-detail-contact col-span-6 sm:col-span-12">
                        <h4>LOCATION</h4>
                        <p>{!! nl2br(e($address)) !!}</p>
                    </div>
                @endif
                @if($phone || $email)
                    <div class="item-detail-contact col-span-6 sm:col-span-12">
                        <h4>CONTACT US</h4>
                        @if($phone)
                            Phone : <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}">{{ $phone }}</a><br>
                        @endif
                        @if($email)
                            Email : <a href="mailto:{{ $email }}">{{ $email }}</a>
                        @endif
                    </div>
                @endif
                @if(I::get($data, 'weekday_hours') || I::get($data, 'weekend_hours'))
                    <div class="item-detail-contact open-hours col-span-6 sm:col-span-12">
                        <h4>OUR HOURS</h4>
                        @if(I::get($data, 'weekday_hours'))
                            <p>{{ I::get($data, 'weekday_hours') }}</p>
                        @endif
                        @if(I::get($data, 'weekend_hours'))
                            <p>{{ I::get($data, 'weekend_hours') }}</p>
                        @endif
                    </div>
                @endif
                @if(!empty($socialLinks))
                    <div class="item-detail-contact col-span-6 sm:col-span-12">
                        <h4>FOLLOW US</h4>
                        <ul>
                            @foreach($socialLinks as $key => $social)
                                @php
                                    $platform = is_array($social) ? ($social['platform'] ?? $key) : $key;
                                    $url = is_array($social) ? ($social['url'] ?? null) : $social;
                                    $icon = $socialIcons[strtolower((string) $platform)] ?? 'fa fa-link';
                                @endphp
                                @if($url)
                                    <li class="sosmed-icon">
                                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($platform) }}">
                                            <span class="{{ $icon }}"></span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="contact-form-block">
    <div class="thaw-container">
        <div class="contact-form-wrap">
            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mb-4">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="irhas-contact-form" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="icf-wrap grid grid-cols-12">
                    <div class="icf-field col-span-6 sm:col-span-12">
                        <label for="form-field-name" class="field-label">Username</label>
                        <input size="1" type="text" id="form-field-name" name="username" class="icf-input" placeholder="Username" value="{{ old('username', old('name')) }}" required>
                    </div>
                    <div class="icf-field col-span-6 sm:col-span-12">
                        <label for="form-field-email" class="field-label">E-mail</label>
                        <input size="1" type="email" id="form-field-email" name="email" class="icf-input" placeholder="Your Email" value="{{ old('email') }}">
                    </div>
                    <div class="icf-field col-span-6 sm:col-span-12">
                        <label for="form-field-service" class="field-label">Service</label>
                        <select name="service" id="form-field-service" class="icf-input">
                            <option value="">Select a service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->title }}" {{ old('service', old('service_required')) === $service->title ? 'selected' : '' }}>
                                    {{ $service->title }}
                                </option>
                            @endforeach
                        </select>
                        <i class="fas fa-caret-down"></i>
                    </div>
                    <div class="icf-field col-span-6 sm:col-span-12">
                        <label for="form-field-phone" class="field-label">Your phone</label>
                        <input size="1" type="text" id="form-field-phone" name="phone" class="icf-input" value="{{ old('phone') }}">
                    </div>
                    <div class="icf-field col-span-12">
                        <label for="form-field-message" class="field-label">Message</label>
                        <textarea class="icf-input" id="form-field-message" name="message" rows="4" placeholder="Your Text" required>{{ old('message') }}</textarea>
                    </div>
                    <div class="icf-field col-span-12 flex justify-end sm:justify-start">
                        <button type="submit" class="icf-input-button">
                            <span>
                                <span class="icf-button-text">{{ I::get($data, 'submit_button_text', 'Send Message') }}</span>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
