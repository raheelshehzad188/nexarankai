@php

    $data = $section->data ?? [];
    // Hero Section
    $heroHeading = $data['hero_heading'] ?? 'Get in touch';
    $heroDescription = $data['hero_description'] ?? 'Want to get in touch with Pro Clean AC? We\'d love to hear from you. Here\'s how you can reach us..';
    
    // Contact Option 1 - Message
    $messageHeading = $data['message_heading'] ?? 'Leave us a Message';
    $messageDescription = $data['message_description'] ?? 'Interested in Pro Clean AC? Just leave us a message and our team will get back to you as quickly as possible..';
    $onlineFormText = $data['online_form_text'] ?? 'Online Form';
    $messageWhatsappText = $data['message_whatsapp_text'] ?? 'WhatsApp';
    $messageWhatsappUrl = $data['message_whatsapp_url'] ?? 'https://wa.me/971556382341?text=Hi!%20I\'d%20like%20to%20know%20more%20about%20your%20AC%20cleaning%20service.';
    
    // Contact Option 2 - Call
    $callHeading = $data['call_heading'] ?? 'Give us a Call';
    $callDescription = $data['call_description'] ?? 'Want to speak directly with Pro Clean AC? Just pick up the phone to chat with our team directly..';
    $phone1 = $data['phone_1'] ?? '+971 55 638 2341';
    $phone2 = $data['phone_2'] ?? '+971 4 372 1198';
    
    // Form Section
    $formHeading = $data['form_heading'] ?? 'Request A Quotation';
    $formSubheading = $data['form_subheading'] ?? 'Fill in the form below and our team will be in touch to discuss your AC Cleaning quote.';
    $submitText = $data['submit_text'] ?? 'Submit Form';
    $formWhatsappText = $data['form_whatsapp_text'] ?? 'WhatsApp Now';
    $formWhatsappUrl = $data['form_whatsapp_url'] ?? 'https://wa.me/+971556382341';
    $privacyText = $data['privacy_text'] ?? 'We don\'t share your data.';
    $privacyUrl = $data['privacy_url'] ?? '/privacy-policy';
    
    // Map Section
    $mapHeading = $data['map_heading'] ?? 'How to find us';
    $officeName = $data['office_name'] ?? 'Pro Clean AC - Dubai Office';
    $officeAddress = $data['office_address'] ?? '9th Floor, The H Office, 1 Sheikh Zayed Road, Dubai';
    $officePhone1 = $data['office_phone_1'] ?? '+971 556 382 341';
    $officePhone2 = $data['office_phone_2'] ?? '+971 4 372 1198';
    $officeEmail = $data['office_email'] ?? 'info@proclean-ac.com';
    $mapEmbedUrl = $data['map_embed_url'] ?? '';
@endphp

<style>
    .cont-custom-top{
        top:0px !important;
        margin: 60px 50px !important;
        display: flex;
        justify-content: space-between !important;
    }
    .con-wrap-custom{
        width: 48% ;
    }
</style>

<!-- Contact Options -->
<div>
    <div class="w-layout-grid grid-7 cont-custom-top">
        <div class="contact-wrapper con-wrap-custom">
            <img src="https://clean-air.ae/public/uploads/form-icons/email.png" loading="lazy" width="50" alt="chat"/>
            <h2 class="h1-small">{{ $messageHeading }}</h2>
            <p class="paragraph-5">{!! nl2br(e($messageDescription)) !!}</p>
            <div class="div-block-16">
                <a href="#Contact-Us" class="button contact form w-button">{{ $onlineFormText }}</a>
                <a href="{{ $messageWhatsappUrl }}" class="button blue contact w-button">{{ $messageWhatsappText }}</a>
            </div>
        </div>
        <div class="contact-wrapper con-wrap-custom">
            <img src="https://clean-air.ae/public/uploads/form-icons/phone.png" loading="lazy" width="50" alt="phone"/>
            <h2 class="h1-small">{{ $callHeading }}</h2>
            <p class="paragraph-5">{!! nl2br(e($callDescription)) !!}</p>
            @if($phone1)
                <a href="tel:{{ str_replace(' ', '', $phone1) }}" class="link-6">{{ $phone1 }}</a>
            @endif
            @if($phone2)
                <a href="tel:{{ str_replace(' ', '', $phone2) }}" class="link-6">{{ $phone2 }}</a>
            @endif
        </div>
    </div>
</div>

<!-- Contact Form Section -->
<div id="Contact-Us" class="section-50">
    <div class="container-19 overlay-image">
        <div class="boxed-19 increased-padding shadow">
            <h5 class="text-primary-1-form">{{ $formHeading }}</h5>
            <h4 class="large-heading-form form-heading">{!! nl2br(e($formSubheading)) !!}</h4>
            
            @if(session('success'))
                <div class="alert alert-success text-center my-3">{{ session('success') }}</div>
            @endif

            <div class="form-block w-form">
                <form id="wf-form-Request-Form-2" name="wf-form-Request-Form-2" data-name="Request Form 2" method="POST" action="{{ route('contact.store') }}" class="form-grid-vertical" aria-label="Request Form 2">
                    @csrf
                    <div class="icon-form-input">
                        <img src="https://clean-air.ae/public/uploads/form-icons/name.png" alt="user application identity authentication login" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" maxlength="256" name="name" placeholder="Your Name" type="text" id="Your-Name-3" required/>
                    </div>
                    <div class="icon-form-input">
                        <img src="https://clean-air.ae/public/uploads/form-icons/email.png" alt="envelope" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" maxlength="256" name="email" placeholder="Email Address" type="email" id="Email" required/>
                    </div>
                    <div class="icon-form-input">
                        <img src="https://clean-air.ae/public/uploads/form-icons/phone.png" alt="Phone" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" maxlength="256" name="phone" placeholder="Phone Number" type="tel" id="Phone-2" required/>
                    </div>
                    <div class="icon-form-input-landing-2">
                        <img src="https://clean-air.ae/public/uploads/form-icons/location.png" alt="paper plane toy" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" maxlength="256" name="location" placeholder="Location" type="text" id="Location-2" required/>
                    </div>
                    <div class="icon-form-input-landing">
                        <img src="https://clean-air.ae/public/uploads/form-icons/service-required.png" alt="user chat talk" class="icon-form-input-image">
                        <input class="form-input-unstyled w-input" maxlength="256" name="service_required" placeholder="Service Required" type="text" id="Help-2" required/>
                    </div>
                    <input type="hidden" name="message" id="message-field" value="">
                    <input type="submit" data-wait="Please wait..." class="button w-button" value="{{ $submitText }}"/>
                    <a href="{{ $formWhatsappUrl }}" class="button-green w-button">{{ $formWhatsappText }}</a>
                    <div class="text-small">
                        <span class="text-span-294">{{ $privacyText }}</span><a href="{{ $privacyUrl }}" class="link-3 link-privacy">View Privacy Policy</a>
                    </div>
                </form>
                <div class="form-success w-form-done">
                    <div>Thank you! Your submission has been received!</div>
                </div>
                <div class="form-error w-form-fail">
                    <div>Oops! Something went wrong while submitting the form.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map & Office Details Section -->
<div class="section-67 position-none bg no-margin">
    <h2 class="heading-31">{{ $mapHeading }}</h2>
    <div class="w-layout-grid grid-7 position-none">
        <div class="contact-wrapper office">
            <h2 class="h1-small">{{ $officeName }}</h2>
            <p class="paragraph-5">
                {!! nl2br(e($officeAddress)) !!}<br/><br/>
                @if($officePhone1)
                    <a href="tel:{{ str_replace(' ', '', $officePhone1) }}"><strong class="bold-text-2">{{ $officePhone1 }}</strong></a><strong class="bold-text-2"><br/></strong>
                @endif
                @if($officePhone2)
                    <a href="tel:{{ str_replace(' ', '', $officePhone2) }}"><strong class="bold-text-2">{{ $officePhone2 }}<br/></strong></a>
                @endif
                @if($officeEmail)
                    <a href="mailto:{{ $officeEmail }}" target="_blank"><strong class="bold-text-2">{{ $officeEmail }}</strong></a>
                @endif
            </p>
        </div>
        @if($mapEmbedUrl)
            <div>
                <div class="w-embed w-iframe">
                    
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3377.414401709105!2d55.2341163!3d25.115046699999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6996ac4ca51f%3A0x628888ca539f38d2!2sClean%20Air!5e1!3m2!1sen!2sae!4v1769164408366!5m2!1sen!2sae" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        @endif
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

