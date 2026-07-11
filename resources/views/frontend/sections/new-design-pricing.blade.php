@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-pricing');
    $bgStyle = ND::bgStyle($data, 'https://clean-air.ae/uploads/nadaca-background.png');
@endphp

<section class="pricing-section" @if($bgStyle) style="{{ $bgStyle }}" @endif>
    <div class="container">
        <div class="pricing-heading">
            @if(ND::get($data, 'eyebrow'))
                <span class="pricing-eyebrow">{{ ND::get($data, 'eyebrow') }}</span>
            @endif
            @if(ND::get($data, 'title'))
                <h2 class="pricing-title">{{ ND::get($data, 'title') }}</h2>
            @endif
            @if(ND::get($data, 'subtitle'))
                <h4 class="pricing-subtitle">{{ ND::get($data, 'subtitle') }}</h4>
            @endif
            @if(ND::get($data, 'description'))
                <p>{{ ND::get($data, 'description') }}</p>
            @endif
        </div>

        <!--=========================
        PRICING CARDS
        ==========================-->

        <div class="pricing-cards">

            <!-- Apartment -->

            <div class="pricing-card">

                <div class="pricing-top">

                    <div class="pricing-icon">
                        🏢
                    </div>

                    <div>

                        <h3>
                            Apartment
                        </h3>

                        <span>
                            1–2 AC Units
                        </span>

                    </div>

                </div>

                <div class="pricing-divider"></div>
                
                <div class="pricing-wraper">

                    <div class="pricing-price">
                        <small>Starting From</small>
                        <h2>699</h2>
                        <h5> AED <span> / Unit </span> </h5>
                    </div>
                    <div class="pricing-features">
                        <div><span class="tick-icon">✔</span> Deep Cleaning</div>
                        <div><span class="tick-icon">✔</span> Sanitization</div>
                        <div><span class="tick-icon">✔</span> Filter Cleaning</div>
                        <div><span class="tick-icon">✔</span> Performance Check</div>
                    </div>
                    
                </div>
                
                <a href="#" class="pricing-btn dark-btn">
                    Book Now
                    <span>→</span>
                </a>
            </div><!--pricing-card-->

            <!-- Villa -->

            <div class="pricing-card featured-card">

                <div class="popular-badge">
                    MOST POPULAR
                </div>

                <div class="pricing-top">

                    <div class="pricing-icon">
                        🏡
                    </div>

                    <div>

                        <h3>
                            Villa Package
                        </h3>

                        <span>
                            3+ AC Units
                        </span>

                    </div>

                </div>

                <div class="pricing-divider"></div>
                    
                    
                        <div class="pricing-price">
                            <small>Starting From</small>
                            <h2 class="custom-price">  Custom Quote</h2>
                        </div>
                        <div class="pricing-features">
                            <div><span class="tick-icon">✔</span> Full Property Assessment</div>
                            <div><span class="tick-icon">✔</span> Multiple Units Cleaning</div>
                            <div><span class="tick-icon">✔</span> Priority Booking</div>
                            <div><span class="tick-icon">✔</span> NADCA Accredited Specialists</div>
                        </div>
                        

                <a href="#" class="pricing-btn">

                    Get a Quote

                    <span>→</span>

                </a>

            </div>

            <!-- Annual -->

            <div class="pricing-card">

                <div class="pricing-top">

                    <div class="pricing-icon">
                        📅
                    </div>

                    <div>

                        <h3>
                            Annual Maintenance
                        </h3>

                        <span>
                            Best for Long-Term Care
                        </span>

                    </div>

                </div>

                <div class="pricing-divider"></div>
                    
                    <div class="pricing-wraper">
                        <div class="pricing-price">
        
                            <small>Starting From</small>
        
                            <h2>
                                2,499
                            </h2>
        
                            <h5>
                                AED <span>/ Year</span>
                            </h5>
        
                        </div>
        
                        <div class="pricing-features">
        
                            <div><span class="tick-icon">✔</span> Scheduled Visits</div>
                            <div><span class="tick-icon">✔</span> Priority Support</div>
                            <div><span class="tick-icon">✔</span> Performance Monitoring</div>
                            <div><span class="tick-icon">✔</span> Discounts on Deep Cleaning</div>
        
                        </div>
                    </div>    

                <a href="#" class="pricing-btn dark-btn">

                    Learn More

                    <span>→</span>

                </a>

            </div>

        </div>

        <!--=========================
        SUMMER OFFER
        ==========================-->

        <div class="offer-card" style="background-image: url('https://clean-air.ae/uploads/about-us-bg.png');background-position:top;">

            <div class="offer-left">

                <div class="offer-icon">

                    ☀️

                </div>

                <div class="offer-content">

                    <span>
                        EARLY BIRD SUMMER OFFER
                    </span>

                    <h2>
                        Beat the Summer Rush & Save 20%
                    </h2>

                    <p>
                        Book your AC Deep Cleaning before the peak season
                        and enjoy exclusive savings.
                    </p>

                    <ul>

                        <li>✔ 20% OFF all AC Deep Cleaning services</li>

                        <li>✔ Better cooling performance before summer arrives</li>

                        <li>✔ Limited-time offer</li>

                    </ul>

                    <div class="offer-price">

                        <strong>
                            From AED
                        </strong>

                        <del>
                            399
                        </del>

                        <span>
                            →
                        </span>

                        <b>
                            AED 349
                        </b>

                        <small>
                            per unit
                        </small>

                    </div>

                </div>

            </div>

            <div class="offer-right">

                <div class="offer-circle">

                    <span>
                        Cooler Home.<br>
                        Lower Bills.<br>
                        Better Air.
                    </span>

                </div>

            </div>

        </div>

        <!--=========================
        BOTTOM FEATURES
        ==========================-->

        <div class="pricing-bottom">

            <div class="bottom-item">

                <div class="bottom-icon">
                    🕒
                </div>

                <div>

                    <h4>
                        2–3 Hours
                    </h4>

                    <p>
                        Average Service Time
                    </p>

                </div>

            </div>

            <div class="bottom-item">

                <div class="bottom-icon">
                    🏅
                </div>

                <div>

                    <h4>
                        100% Satisfaction
                    </h4>

                    <p>
                        Guaranteed
                    </p>

                </div>

            </div>

            <div class="bottom-item">

                <div class="bottom-icon">
                    📅
                </div>

                <div>

                    <h4>
                        Same Day Booking
                    </h4>

                    <p>
                        Available
                    </p>

                </div>

            </div>

            <div class="bottom-item">

                <div class="bottom-icon">
                    🎧
                </div>

                <div>

                    <h4>
                        24/7 Support
                    </h4>

                    <p>
                        We're Here to Help
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
