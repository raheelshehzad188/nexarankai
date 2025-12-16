@php
    $data = $section->data ?? [];
    $heading = $data['heading'] ?? 'How our customers feel about our service.';
    $testimonials = \App\Models\Testimonial::getActive();
    $assets_url = asset('assets/dubai/www.proclean-ac.com');
    
    // Group testimonials into slides (3 per slide: left, center rating, right)
    $slides = [];
    $testimonialArray = $testimonials->toArray();
    $totalTestimonials = count($testimonialArray);
    
    // Create slides with 3 testimonials each (left testimonial, rating in middle, right testimonial)
    for ($i = 0; $i < $totalTestimonials; $i += 3) {
        $slide = [];
        $slide['left'] = $testimonialArray[$i] ?? null;
        $slide['rating'] = $testimonialArray[$i] ?? null; // Use first testimonial's rating
        $slide['right'] = $testimonialArray[$i + 1] ?? null;
        if ($slide['left'] || $slide['right']) {
            $slides[] = $slide;
        }
    }
    
    $totalSlides = count($slides);
    $slideHeadings = [
        'How our customers feel about our service.',
        'When was the last time you had your AC cleaned?',
        'Customer satisfaction is our top priority.'
    ];
@endphp

@if($testimonials->count() > 0)
    <div data-delay="4000" 
         data-animation="slide" 
         class="testimonal-slider w-slider" 
         data-autoplay="false" 
         data-easing="ease" 
         data-hide-arrows="false" 
         data-disable-swipe="false" 
         data-autoplay-limit="0" 
         data-nav-spacing="3" 
         data-duration="500" 
         data-infinite="true" 
         role="region" 
         aria-label="carousel">
        
        <div class="mask w-slider-mask" id="w-slider-mask-testimonials">
            @foreach($slides as $slideIndex => $slide)
                <div class="slide w-slide {{ $slideIndex === 0 ? '' : 'slide-' . ($slideIndex + 1) }}" 
                     aria-label="{{ $slideIndex + 1 }} of {{ $totalSlides }}" 
                     role="group">
                    <div>
                        <h2 class="heading-slider-testimonals">{{ $slideHeadings[$slideIndex] ?? $heading }}</h2>
                        <div class="container-slider">
                            <div class="w-layout-grid {{ $slideIndex === 0 ? 'ratings-grid-thirds' : 'ratings-grid-thirds-middle' }}">
                                @if($slide['left'])
                                    <div class="container-small narrow">
                                        <div class="justify-content-center text-center">
                                            <div class="text-large-4">"{{ $slide['left']['review'] }}"</div>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="justify-content-center">
                                    <div class="display-heading-2 ratings-heading">
                                        <span class="text-30">5/5</span>
                                    </div>
                                    <div>
                                        <span class="text-31">{{ $slideIndex === 0 ? '1200+ Reviews' : '1200+ Reviews' }}</span>
                                    </div>
                                    <div class="stars-row ratings-summary-stars">
                                        @php
                                            $rating = $slide['rating']['rating'] ?? 5;
                                        @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $rating)
                                                <img src="{{ asset('assets/dubai/imgs/5f32dc906194429924e96ef8_icon-star.svg') }}" alt="star icon"/>
                                            @else
                                                <img src="{{ asset('assets/dubai/imgs/61bf5c4e1c5fbcc20331951e_icon-star.svg') }}" alt="star icon"/>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                
                                @if($slide['right'])
                                    <div class="container-small narrow">
                                        <div class="justify-content-center text-center">
                                            <div class="text-large-4">"{{ $slide['right']['review'] }}"</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div aria-live="off" aria-atomic="true" class="w-slider-aria-label" data-wf-ignore=""></div>
        </div>
        
        <div class="left-arrow w-slider-arrow-left" role="button" tabindex="0" aria-controls="w-slider-mask-testimonials" aria-label="previous slide">
            <div class="w-icon-slider-left"></div>
        </div>
        <div class="right-arrow w-slider-arrow-right" role="button" tabindex="0" aria-controls="w-slider-mask-testimonials" aria-label="next slide">
            <div class="w-icon-slider-right"></div>
        </div>
        <div class="w-slider-nav w-round">
            @for($i = 1; $i <= $totalSlides; $i++)
                <div class="w-slider-dot {{ $i === 1 ? 'w-active' : '' }}" 
                     data-wf-ignore="" 
                     aria-label="Show slide {{ $i }} of {{ $totalSlides }}" 
                     aria-pressed="{{ $i === 1 ? 'true' : 'false' }}" 
                     role="button" 
                     tabindex="{{ $i === 1 ? '0' : '-1' }}" 
                     style="margin-left: 3px; margin-right: 3px;"></div>
            @endfor
        </div>
    </div>
@else
    <div class="alert alert-info text-center">No testimonials available. Add testimonials from admin panel.</div>
@endif

@push('scripts')
<script>
    // Initialize Webflow slider - will use Webflow JS if available, otherwise fallback
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.querySelector('.testimonal-slider');
        if (!slider) return;
        
        // Wait a bit for Webflow JS to load
        setTimeout(function() {
            // Check if Webflow slider is initialized
            if (typeof window.Webflow !== 'undefined' && window.Webflow.require) {
                try {
                    window.Webflow.require('ix2').init();
                } catch(e) {
                    initCustomSlider();
                }
            } else {
                initCustomSlider();
            }
        }, 100);
        
        function initCustomSlider() {
            const slides = slider.querySelectorAll('.w-slide');
            const dots = slider.querySelectorAll('.w-slider-dot');
            const leftArrow = slider.querySelector('.w-slider-arrow-left');
            const rightArrow = slider.querySelector('.w-slider-arrow-right');
            let currentSlide = 0;
            const totalSlides = slides.length;
            
            function showSlide(index) {
                slides.forEach((slide, i) => {
                    if (i === index) {
                        slide.style.display = 'block';
                        slide.style.opacity = '1';
                        slide.setAttribute('aria-hidden', 'false');
                    } else {
                        slide.style.display = 'none';
                        slide.style.opacity = '0';
                        slide.setAttribute('aria-hidden', 'true');
                    }
                });
                
                dots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.add('w-active');
                        dot.setAttribute('aria-pressed', 'true');
                        dot.setAttribute('tabindex', '0');
                    } else {
                        dot.classList.remove('w-active');
                        dot.setAttribute('aria-pressed', 'false');
                        dot.setAttribute('tabindex', '-1');
                    }
                });
            }
            
            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }
            
            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(currentSlide);
            }
            
            if (rightArrow) {
                rightArrow.addEventListener('click', nextSlide);
            }
            
            if (leftArrow) {
                leftArrow.addEventListener('click', prevSlide);
            }
            
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                });
            });
            
            // Auto-play if enabled
            const autoplay = slider.getAttribute('data-autoplay') === 'true';
            if (autoplay) {
                const delay = parseInt(slider.getAttribute('data-delay')) || 4000;
                setInterval(nextSlide, delay);
            }
            
            // Initialize
            showSlide(0);
        }
    });
</script>
@endpush
