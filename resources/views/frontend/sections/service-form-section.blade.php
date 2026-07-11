@php
die();
    $data = $section->data ?? [];
    $shortHeading = $data['short_heading'] ?? 'Request A Quotation';
    $mainHeading = $data['main_heading'] ?? 'Fill in the form below and our team will be in touch to discuss your quote.';
    $submitText = $data['submit_text'] ?? 'Submit Form';
    $whatsappText = $data['whatsapp_text'] ?? 'WhatsApp Now';
    $whatsappUrl = $data['whatsapp_url'] ?? 'https://wa.me/+971556382341';
    $privacyText = $data['privacy_text'] ?? 'We don\'t share your data.';
    $privacyUrl = $data['privacy_url'] ?? '/privacy-policy';
@endphp

<div id="Contact-Now" class="quote-section">
    <div class="container-19 overlay-image">
        <div class="boxed-19 increased-padding shadow">
            @if($shortHeading)
                <h5 class="text-primary-1-form">{{ $shortHeading }}</h5>
            @endif
            @if($mainHeading)
                <h4 class="large-heading-form">{!! nl2br(e($mainHeading)) !!}</h4>
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
                    <div class="icon-form-input">
                        <img src="https://clean-air.ae/public/uploads/form-icons/email.png" alt="envelope" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" maxlength="256" name="email" placeholder="Email Address" type="email" id="Email" required>
                    </div>
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
                    <input type="hidden" name="message" id="message-field" value="">
                    <input type="submit" data-wait="Please wait..." class="button w-button" value="{{ $submitText }}">
                    <a href="{{ $whatsappUrl }}" class="button-green w-button">{{ $whatsappText }}</a>
                    <div class="text-small">
                        {{ $privacyText }}<a href="{{ $privacyUrl }}">View Privacy Policy</a>
                    </div>
                </form>
                <div class="form-success w-form-done" tabindex="-1" role="region" aria-label="Request Form 2 success">
                    <div>Thank you! Your submission has been received!</div>
                </div>
                <div class="form-error w-form-fail" tabindex="-1" role="region" aria-label="Request Form 2 failure">
                    <div>Oops! Something went wrong while submitting the form.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('wf-form-Request-Form-2');
    const serviceRequiredField = document.getElementById('Help-2');
    const messageField = document.getElementById('message-field');
    
    if (form && serviceRequiredField && messageField) {
        form.addEventListener('submit', function(e) {
            // Set message field to service_required value before submit
            messageField.value = serviceRequiredField.value || 'Service inquiry from ' + document.getElementById('Your-Name-3').value;
        });
    }
});
</script>

