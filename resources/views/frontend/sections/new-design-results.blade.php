@php
    use App\Support\NewDesignSectionData as ND;
    $data = ND::withDefaults($section->data ?? [], 'new-design-results');
    $slides = ND::items($data, 'slides');
@endphp

<section class="results-section">
    <div class="container">
        <div class="results-heading">
            @if(ND::get($data, 'eyebrow'))
                <span class="results-eyebrow">{{ ND::get($data, 'eyebrow') }}</span>
            @endif
            @if(ND::get($data, 'title'))
                <h2 class="results-title">{{ ND::get($data, 'title') }}</h2>
            @endif
        </div>
        @if(count($slides))
            <div class="results-slider">
                <div class="results-track">
                    @foreach($slides as $slide)
                        @php
                            $before = ND::imageUrl($slide, 'before_image', 'before_image_url', $slide['before_image_url'] ?? null);
                            $after = ND::imageUrl($slide, 'after_image', 'after_image_url', $slide['after_image_url'] ?? null);
                        @endphp
                        <div class="results-slide">
                            <div class="results-card">
                                <div class="results-images">
                                    @if($before)<div class="results-image"><img src="{{ $before }}" alt="Before Cleaning"></div>@endif
                                    @if($after)<div class="results-image"><img src="{{ $after }}" alt="After Cleaning"></div>@endif
                                </div>
                                <div class="results-content">
                                    @if(!empty($slide['location']))<span>{{ $slide['location'] }}</span>@endif
                                    <div class="results-stars">★★★★★</div>
                                    @if(!empty($slide['review']))<p class="results-review">"{{ $slide['review'] }}"</p>@endif
                                    @if(!empty($slide['name']))<h4>{{ $slide['name'] }}</h4>@endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="results-prev">&#10094;</button>
                <button class="results-next">&#10095;</button>
            </div>
        @endif
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".results-track");
    const slides = document.querySelectorAll(".results-slide");
    const prevBtn = document.querySelector(".results-prev");
    const nextBtn = document.querySelector(".results-next");
    const slider = document.querySelector(".results-slider");
    if (!track || !slides.length || !prevBtn || !nextBtn) return;
    let currentSlide = 0;
    function updateSlider() {
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
    }
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateSlider();
    }
    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateSlider();
    }
    nextBtn.addEventListener("click", nextSlide);
    prevBtn.addEventListener("click", prevSlide);
    if (slider) {
        let startX = 0, endX = 0;
        slider.addEventListener("touchstart", (e) => { startX = e.touches[0].clientX; });
        slider.addEventListener("touchmove", (e) => { endX = e.touches[0].clientX; });
        slider.addEventListener("touchend", () => {
            const distance = startX - endX;
            if (distance > 50) nextSlide();
            if (distance < -50) prevSlide();
        });
    }
    updateSlider();
});
</script>
