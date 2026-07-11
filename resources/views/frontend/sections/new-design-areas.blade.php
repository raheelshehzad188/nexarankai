@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-areas');
    $bgStyle = ND::bgStyle($data, 'https://clean-air.ae/uploads/nadaca-background.png');
    $locations = ND::items($data, 'locations');
    $locationKeys = ['downtown', 'marina', 'jumeirah', 'businessbay', 'arabian', 'palm', 'jvc', 'mirdif', 'barsha'];
    $vanImage = ND::imageUrl($data, 'van_image', 'van_image_url', ND::get($data, 'van_image_url'));
@endphp

<section class="areas-section" @if($bgStyle) style="{{ $bgStyle }}" @endif>

    <div class="container">

        <div class="areas-wrapper">

            <!-- ==========================
            LEFT CONTENT
            ========================== -->

            <div class="areas-left">

                <span class="areas-eyebrow">{{ ND::get($data, 'eyebrow', 'SERVICE AREAS') }}</span>

                <h2 class="areas-title">{!! ND::nl2br(ND::get($data, 'title', "Proudly Serving\nAcross Dubai")) !!}</h2>

                <p class="areas-text">{{ ND::get($data, 'description') }}</p>

                <div class="areas-line"></div>

                <!-- Feature 1 -->

                <div class="areas-feature">

                    <div class="areas-icon">
                        📍
                    </div>

                    <div class="areas-feature-content">

                        <h4>
                            Wide Coverage
                        </h4>

                        <p>
                            Serving homes, apartments and businesses throughout Dubai.
                        </p>

                    </div>

                </div>

                <!-- Feature 2 -->

                <div class="areas-feature">

                    <div class="areas-icon">
                        📅
                    </div>

                    <div class="areas-feature-content">

                        <h4>
                            Same Day Service
                        </h4>

                        <p>
                            Fast response and same day appointments in most areas.
                        </p>

                    </div>

                </div>

                <!-- Feature 3 -->

                <div class="areas-feature">

                    <div class="areas-icon">
                        🛡️
                    </div>

                    <div class="areas-feature-content">

                        <h4>
                            Trusted by Thousands
                        </h4>

                        <p>
                            Homes and businesses rely on our experienced team.
                        </p>

                    </div>

                </div>

            </div>

            <!-- ==========================
            RIGHT SIDE
            ========================== -->

            <div class="areas-right">

                <!-- ======================
                MAP CARD
                ======================= -->

                <div class="areas-map-card">

                    <!-- Location List -->

                    <div class="areas-list">

                        <h3>
                            Popular Areas
                        </h3>

                        <ul>
                            @foreach($locations as $index => $location)
                                @php
                                    $name = is_array($location) ? ($location['name'] ?? '') : $location;
                                    $key = is_array($location) ? ($location['key'] ?? ($locationKeys[$index] ?? 'area'.$index)) : ($locationKeys[$index] ?? 'area'.$index);
                                @endphp
                                <li class="{{ $index === 0 ? 'active' : '' }}" data-location="{{ $key }}">📍 {{ $name }}</li>
                            @endforeach
                            <li>📍 And Many More...</li>
                        </ul>

                        <a href="#" class="areas-btn">
                            View All Areas
                            <span>→</span>
                        </a>

                    </div>

                    <!-- Google Map -->

                    <div class="areas-map">

                        <iframe
                            id="dubaiMap"
                            src="https://www.google.com/maps?q=Downtown+Dubai&output=embed"
                            loading="lazy"
                            allowfullscreen>
                        </iframe>

                    </div>

                </div>

                <!-- ======================
                VAN CARD
                ======================= -->

                <div class="areas-van-card" @if($vanImage) style="background-image:url('{{ $vanImage }}');" @endif>

                    <div class="van-left">

                        <div class="van-icon">
                            🚚
                        </div>

                        <div class="van-content">

                            <span>
                                FAST & RELIABLE
                            </span>

                            <h3>
                                We Come to You!
                            </h3>

                            <p>
                                No matter where you are in Dubai,
                                our technicians are ready to help.
                            </p>

                        </div>

                    </div>

                    <!--<div class="van-image">-->

                    <!--    <img src="images/service-van.png" alt="Service Van">-->

                    <!--</div>-->

                </div>

                <!-- ======================
                CONTACT STRIP
                ======================= -->

                <div class="areas-contact">

                    <div class="contact-box">

                        <div class="contact-icon">
                            📞
                        </div>

                        <div>

                            <span>Call Us</span>

                            <h4>{{ ND::get($data, 'phone', '+971542140166') }}</h4>
                            <p>{{ ND::get($data, 'phone_label', 'Available 7 Days a Week') }}</p>

                        </div>

                    </div>

                    <div class="contact-divider"></div>

                    <div class="contact-box">

                        <div class="contact-icon">
                            💬
                        </div>

                        <div>

                            <span>WhatsApp Us</span>

                            <h4>{{ ND::get($data, 'whatsapp', '+971542140166') }}</h4>
                            <p>{{ ND::get($data, 'whatsapp_label', 'Quick Response') }}</p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!--MAP-->

<script>
document.addEventListener("DOMContentLoaded", function () {

    const map = document.getElementById("dubaiMap");
    const locations = document.querySelectorAll(".areas-list li[data-location]");

    const mapLocations = {

        downtown: "Downtown Dubai",
        marina: "Dubai Marina",
        jumeirah: "Jumeirah Dubai",
        businessbay: "Business Bay Dubai",
        arabian: "Arabian Ranches Dubai",
        palm: "Palm Jumeirah Dubai",
        jvc: "Jumeirah Village Circle Dubai",
        mirdif: "Mirdif Dubai",
        barsha: "Al Barsha Dubai"

    };

    locations.forEach(function (item) {

        item.addEventListener("click", function () {

            // Remove active class
            locations.forEach(function (li) {
                li.classList.remove("active");
            });

            // Add active class
            this.classList.add("active");

            // Get selected location
            const key = this.dataset.location;

            // Update Google Map
            if (mapLocations[key]) {

                map.src =
                    "https://www.google.com/maps?q=" +
                    encodeURIComponent(mapLocations[key]) +
                    "&output=embed";

            }

        });

    });

});
</script>
