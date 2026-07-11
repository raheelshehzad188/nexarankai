@php

    $data = $section->data ?? [];
    $heading = $data['heading'] ?? 'Request A Quotation';
    $subheading = $data['subheading'] ?? 'Fill in the form below and our team will be in touch to discuss your AC Cleaning quote.';
    $submitText = $data['submit_text'] ?? 'Submit Form';
    $whatsappText = $data['whatsapp_text'] ?? 'WhatsApp Now';
    $whatsappUrl = $data['whatsapp_url'] ?? 'https://wa.me/+971556382341';
    $privacyText = $data['privacy_text'] ?? 'We don’t share your data.';
    $privacyUrl = $data['privacy_url'] ?? '/privacy-policy';
@endphp
<style>
    .custom-submit-btn {
    width: 100%;
    padding: 16px 20px;
    background-color: var(--pro-clean-blue);
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.custom-submit-btn:hover {
    background-color: #15183a; /* slightly darker */
}

.custom-submit-btn:active {
    transform: scale(0.98);
}

.custom-submit-btn:focus {
    outline: none;
}

</style>
<section id="Contact-Us" class="section-50">
    <div class="container-19 overlay-image"  id="contact_us">
        <div class="boxed-19 increased-padding shadow">
            @if($heading)
                <h5 class="text-primary-1-form">{{ $heading }} </h5>
            @endif
            @if($subheading)
                <h4 class="large-heading-form form-heading">{!! nl2br(e($subheading)) !!}</h4>
            @endif

            @if(session('success'))
                <div class="alert alert-success text-center my-3">{{ session('success') }}</div>
            @endif

            <div class="form-block w-form">
                <form id="wf-form-Request-Form-2" name="wf-form-Request-Form-2" data-name="Request Form 2" method="POST" action="{{ route('contact.store') }}" class="form-grid-vertical" aria-label="Request Form 2">
                    @csrf
                    <div class="icon-form-input">
                        <img src="https://clean-air.ae/public/uploads/form-icons/name.png" alt="user application identity authentication login" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" maxlength="256" name="name" placeholder="Your Name" type="text" id="Your-Name-3" required>
                    </div>
                    <!--<div class="icon-form-input">-->
                    <!--    <img src="https://clean-air.ae/public/uploads/form-icons/email.png" alt="envelope" class="icon-form-input-image">-->
                    <!--    <input class="form-input-unstyled w-input" maxlength="256" name="email" placeholder="Email Address" type="email" id="Email" required>-->
                    <!--</div>-->
                    <div class="icon-form-input">
                        <img src="https://clean-air.ae/public/uploads/form-icons/phone.png" alt="Phone" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" maxlength="256" name="phone" placeholder="Phone Number" type="tel" id="Phone-2" required>
                    </div>
                    <div class="icon-form-input">
                        <img src="https://clean-air.ae/public/uploads/form-icons/location.png" alt="paper plane toy" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" maxlength="256" name="location" placeholder="Location" type="text" id="Location-2" required>
                    </div>
                    <div class="icon-form-input">
                        <img src="https://clean-air.ae/public/uploads/form-icons/service-required.png" alt="user chat talk" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" maxlength="256" name="service_required" placeholder="Service Required" type="text" id="Help-2" required>
                    </div>
                    <div class="icon-form-input">
                        <img src="https://clean-air.ae/public/uploads/form-icons/service-required.png" alt="user chat talk" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" name="message" placeholder="Message" type="textarea" id="Help-2" required>
                    </div>
                    <button type="submit" class="custom-submit-btn">
                       Submit {{ $submitText }}
                    </button>

                    <a href="{{ $whatsappUrl }}" class="button-green w-button">{{ $whatsappText }}</a>
                    <div class="text-small">
                        {{ $privacyText }}<a href="{{ $privacyUrl }}">View Privacy Policy</a>
                    </div>
                </form>
                <div class="form-success w-form-done" tabindex="-1" role="region" aria-label="Request Form success">
                    <div>Thank you! Your submission has been received!</div>
                </div>
                <div class="form-error w-form-fail" tabindex="-1" role="region" aria-label="Request Form failure">
                    <div>Oops! Something went wrong while submitting the form.</div>
                </div>
            </div>
        </div>
    </div>
</section>

