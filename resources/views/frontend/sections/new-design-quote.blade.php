@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-quote');
    $bgStyle = ND::bgStyle($data, 'https://clean-air.ae/uploads/nadaca-background.png');
    $badgeImage = ND::imageUrl($data, 'badge_image', 'badge_image_url', ND::get($data, 'badge_image_url'));
@endphp

<section class="quote-section" @if($bgStyle) style="{{ $bgStyle }}" @endif>
    <div class="container">
        <div class="quote-wrapper">
            <div class="quote-left">
                @if(ND::get($data, 'eyebrow'))
                    <span class="quote-eyebrow">{{ ND::get($data, 'eyebrow') }}</span>
                @endif
                @if(ND::get($data, 'title'))
                    <h2 class="quote-title">{{ ND::get($data, 'title') }}</h2>
                @endif
                @if(ND::get($data, 'description'))
                    <p class="quote-text">{{ ND::get($data, 'description') }}</p>
                @endif
                <div class="quote-line"></div>

                <!-- Feature 1 -->

                <div class="quote-feature">

                    <div class="quote-icon">
                        📅
                    </div>

                    <div>

                        <h4>
                            Fast Response
                        </h4>

                        <p>
                            We'll get back to you within 1 business hour.
                        </p>

                    </div>

                </div>

                <!-- Feature 2 -->

                <div class="quote-feature">

                    <div class="quote-icon">
                        🛡️
                    </div>

                    <div>

                        <h4>
                            Tailored to You
                        </h4>

                        <p>
                            Custom recommendations based on your needs.
                        </p>

                    </div>

                </div>

                <!-- Feature 3 -->

                <div class="quote-feature">

                    <div class="quote-icon">
                        🏅
                    </div>

                    <div>

                        <h4>
                            No Obligation
                        </h4>

                        <p>
                            100% free quote with no commitment.
                        </p>

                    </div>

                </div>

                <!-- Feature 4 -->

                <div class="quote-feature">

                    <div class="quote-icon">
                        🔒
                    </div>

                    <div>

                        <h4>
                            Your Information is Safe
                        </h4>

                        <p>
                            We respect your privacy and never share your details.
                        </p>

                    </div>

                </div>

                <!--=========================
                NADCA CARD
                ==========================-->

                <div class="quote-nadca-card">

                    <div class="nadca-item">

                        <div class="nadca-icon2">
                            🛡️
                        </div>

                        <div>

                            <h4>
                                NADCA Accredited Specialists
                            </h4>

                            <p>
                                Industry recognized.<br>
                                Quality guaranteed.
                            </p>

                        </div>

                    </div>

                    <div class="nadca-divider2"></div>

                    <div class="nadca-logo2">

                        <img src="{{ $badgeImage ?? 'https://clean-air.ae/uploads/Nadca-logo-2.png' }}" alt="NADCA Logo">

                    </div>

                    <div class="nadca-text2">

                        <p>
                            The HVAC Inspection,<br>
                            Cleaning and Restoration<br>
                            Association
                        </p>

                    </div>

                </div>

            </div>

            <!--=================================
            RIGHT SIDE
            ==================================-->

            <div class="quote-right">

                <div class="quote-card">

                    <div class="quote-card-header">

                        <div class="quote-card-icon">
                            📋
                        </div>

                        <div>

                            <h3>
                                Tell Us About Your Property
                            </h3>

                            <p>
                                The more details you provide, the more accurate your quote will be.
                            </p>

                        </div>

                    </div>

                    <!--=========================
                    FORM
                    ==========================-->

                    <form class="quote-form">

                        <div class="quote-row">

                            <div class="quote-group">

                                <label>
                                    Full Name <span>*</span>
                                </label>

                                <input type="text" placeholder="Your full name">

                            </div>

                            <div class="quote-group">

                                <label>
                                    Phone Number <span>*</span>
                                </label>

                                <input type="tel" placeholder="+971 50 123 4567">

                            </div>

                        </div>

                        <div class="quote-row">

                            <div class="quote-group">

                                <label>
                                    Email Address <span>*</span>
                                </label>

                                <input type="email" placeholder="youremail@example.com">

                            </div>

                            <div class="quote-group">

                                <label>
                                    Property Type <span>*</span>
                                </label>

                                <select>

                                    <option>Select property type</option>
                                    <option>Apartment</option>
                                    <option>Villa</option>
                                    <option>Office</option>
                                    <option>Commercial</option>

                                </select>

                            </div>

                        </div>

                        <div class="quote-row">

                            <div class="quote-group">

                                <label>
                                    Area (sq.ft) / Number of AC Units <span>*</span>
                                </label>

                                <input type="text" placeholder="e.g. 1200 sq.ft or 5 AC units">

                            </div>

                            <div class="quote-group">

                                <label>
                                    Location <span>*</span>
                                </label>

                                <select>

                                    <option>Select your area</option>
                                    <option>Downtown Dubai</option>
                                    <option>Dubai Marina</option>
                                    <option>Jumeirah</option>
                                    <option>Business Bay</option>
                                    <option>Palm Jumeirah</option>
                                    <option>JVC</option>
                                    <option>Al Barsha</option>
                                    <option>Mirdif</option>

                                </select>

                            </div>

                        </div>

                        <div class="quote-group">

                            <label>
                                Service Interested In <span>*</span>
                            </label>

                            <div class="quote-services">

                                <label class="quote-check">

                                    <input type="checkbox" checked>

                                    <span>Deep Cleaning</span>

                                </label>

                                <label class="quote-check">

                                    <input type="checkbox">

                                    <span>Annual Maintenance</span>

                                </label>

                                <label class="quote-check">

                                    <input type="checkbox">

                                    <span>Mold Treatment</span>

                                </label>

                                <label class="quote-check">

                                    <input type="checkbox">

                                    <span>Other</span>

                                </label>

                            </div>

                        </div>

                        <div class="quote-group">

                            <label>
                                Additional Details (Optional)
                            </label>

                            <textarea placeholder="Tell us more about your property or any specific concerns..."></textarea>

                        </div>

                        <button class="quote-btn" type="submit">

                            Request Your Quote

                            <span>→</span>

                        </button>

                        <div class="quote-secure">

                            🔒 Your information is safe and secure.

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>
