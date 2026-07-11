@php
    $bodyClass = 'irhas1 service1';
    $theme = \App\Support\IrhasSectionData::THEME_BASE;
    $thumb = $service->imageUrl('image');
    $accordions = is_array($service->accordions) ? $service->accordions : [];
    $testimonials = is_array($service->sidebar_testimonials) ? $service->sidebar_testimonials : [];
    $publishedDate = $service->published_at ? $service->published_at->format('F j, Y') : $service->created_at->format('F j, Y');
@endphp
@extends('frontend.layout-irhas')

@section('content')
<div class="single-service wrapper clearfix">
    <div class="thaw-container">
        <div class="row clearfix">
            <div class="blog-service">
                <div class="blog-sidebar column column-75">
                    <div class="post-thumb-wrap clearfix">
                        <div class="post-thumb">
                            @if($thumb)
                                <img src="{{ $thumb }}" alt="{{ $service->image_alt ?? $service->title }}">
                            @else
                                <img src="{{ asset($theme . '/img/tumbnail-single-service.png') }}" alt="{{ $service->title }}">
                            @endif
                            <div class="irhas-overlay"></div>
                            <div class="inner-img">
                                <div class="left-inner">
                                    @if($service->category_name)
                                        <div class="category">
                                            <h3 class="the-category"><a href="#">{{ $service->category_name }}</a></h3>
                                        </div>
                                    @endif
                                    <div class="title-content">
                                        <h2>{{ $service->title }}</h2>
                                    </div>
                                    <div class="standard-post-date span-head">{{ $publishedDate }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="post-content pad-3">
                        <div class="inner-content">
                            @if($service->excerpt)
                                <p>{{ $service->excerpt }}</p>
                            @endif
                            @if($service->content)
                                {!! $service->content !!}
                            @elseif($service->description)
                                <p>{{ $service->description }}</p>
                            @endif
                            @if($service->content_image)
                                <p><img src="{{ $service->imageUrl('content_image') }}" alt="{{ $service->title }}"></p>
                            @endif
                        </div>
                    </div>

                    @if($service->features_section_title || count($accordions))
                        <div class="related-services-wrap pad-3 clearfix">
                            @if($service->features_section_title)
                                <div class="related-service-section">
                                    <h2 class="section-title">{{ $service->features_section_title }}</h2>
                                </div>
                            @endif
                            @if(count($accordions))
                                <div class="tab-services clearfix">
                                    @foreach($accordions as $accordion)
                                        <div class="accordion-1">
                                            <div class="head">
                                                <h4>{{ $accordion['title'] ?? '' }}</h4>
                                                <i class="fas fa-angle-down arrow"></i>
                                            </div>
                                            <div class="content">
                                                <p>{{ $accordion['content'] ?? '' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="sidebar column column-25 clearfix">
                    <div id="archives-2" class="widget widget_archive">
                        <h4 class="widget-title"><span>Recent Services</span></h4>
                        <div class="service-thumb-widget clearfix">
                            <div class="service-thumb-wrap clearfix">
                                @forelse($recentServices as $recent)
                                    <div class="post-item clearfix">
                                        <div class="inner-service-widget">
                                            <div class="content column column-1">
                                                <h4 class="the-title"><a href="{{ $recent->getUrl() }}">{{ $recent->title }}</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted small px-2">No other services yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    @if($service->brochure_doc_url || $service->brochure_pdf_url)
                        <div class="widget pdf-download clearfix">
                            <div class="heading-block">
                                <h4 class="widget-title">Our Brochures</h4>
                            </div>
                            <ul>
                                @if($service->brochure_doc_url)
                                    <li>
                                        <img src="{{ asset($theme . '/img/document.png') }}" alt="Download Doc">
                                        <a href="{{ $service->brochure_doc_url }}" download>Download Doc</a>
                                    </li>
                                @endif
                                @if($service->brochure_pdf_url)
                                    <li>
                                        <img src="{{ asset($theme . '/img/pdf.png') }}" alt="Download PDF">
                                        <a href="{{ $service->brochure_pdf_url }}" download>Download PDF</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif

                    @if(count($testimonials))
                        <div class="widget service-testimonial widget_irhas_testimonial clearfix">
                            <h4 class="widget-title"><span>Testimonial</span></h4>
                            <div class="carousel-testi-nav">
                                <div class="carousel-button-prev car-page-arrow"><i class="post-carousel-arrow fa fa-chevron-left"></i></div>
                                <div class="carousel-button-next car-page-arrow"><i class="post-carousel-arrow fa fa-chevron-right"></i></div>
                            </div>
                            <div class="testimonial-wrap service-testi-slide swiper-container">
                                <div class="swiper-wrapper testimonial-inner-content">
                                    @foreach($testimonials as $testimonial)
                                        @php
                                            $testiImage = ! empty($testimonial['image'])
                                                ? (\App\Support\IrhasSectionData::themeAsset($testimonial['image']) ?? asset($theme . '/img/testimonial-profile.png'))
                                                : asset($theme . '/img/testimonial-profile.png');
                                        @endphp
                                        <div class="swiper-slide">
                                            <div class="testimonial-image-wrap clearfix">
                                                <div class="testimonial-image">
                                                    <img src="{{ $testiImage }}" alt="{{ $testimonial['author'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="inner-details">
                                                @if(!empty($testimonial['quote']))
                                                    <div class="content-testi"><p>{{ $testimonial['quote'] }}</p></div>
                                                @endif
                                                <div class="testimonial-detail-inner">
                                                    @if(!empty($testimonial['author']))
                                                        <h5 class="testi-author">{{ $testimonial['author'] }}</h5>
                                                    @endif
                                                    @if(!empty($testimonial['job']))
                                                        <cite class="testi-job">{{ $testimonial['job'] }}</cite>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="widget widget_text">
                        <h4 class="widget-title"><span>quick contact</span></h4>
                        <div class="textwidget">
                            <form class="irhas-service-contact" action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <input type="text" name="name" placeholder="Name" required><br>
                                <input type="text" name="phone" placeholder="Phone"><br>
                                <textarea name="message" placeholder="Message" rows="10" required></textarea><br>
                                <input type="hidden" name="service_required" value="{{ $service->title }}">
                                <input type="submit" value="Send Email">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
