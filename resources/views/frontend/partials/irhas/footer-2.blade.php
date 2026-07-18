@php
    use App\Support\IrhasSectionData as I;
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Irhas';
    $footerMenus = \App\Models\Menu::getByLocation('footer');
    $footerServices = \App\Models\Service::getActive()->take(4);
    $footerPosts = \App\Models\BlogPost::publishedList(3);
    $logoUrl = I::themeAsset('img/irhas2.png');
    if ($settings->site_logo) {
        $logoUrl = I::themeAsset($settings->site_logo);
    }
    $footerText = $settings->footer_text ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore dolore. Nam tincidunt, tellus quis maximus consequat. et malesuada nibh lorem vel.';
    $phone = $settings->header_phone ?? '+62 828 111 96 75';
    $email = $settings->header_email ?? 'irhas@contact.com';
    $address = $settings->site_address ?? null;
    $phoneHref = $phone ? 'tel:' . preg_replace('/[^0-9+]/', '', $phone) : '#';
    $whatsappNumber = $settings->whatsapp_number ? preg_replace('/[^0-9]/', '', $settings->whatsapp_number) : null;
@endphp
<footer class="footer">
    <div class="footer-widgets-holder-home2">
        <div class="thaw-container">
            <div class="footer-widgets2 grid grid-cols-12 gap-24">
                <div class="footer-widget item col-span-3 sm:col-span-12 res:col-span-12">
                    <div class="widget-footer widget_text">
                        <div class="textwidget">
                            <p><img src="{{ $logoUrl }}" alt="{{ $siteName }}"></p>
                            <p>{{ $footerText }}</p>
                        </div>
                    </div>
                </div>
                <div class="footer-widget item col-span-3 sm:col-span-12 res:col-span-12">
                    <div class="widget-footer widget_irhas_servicepost">
                        <div class="title"><h4 class="widget-title">Services</h4></div>
                        <div class="sidebar-recent-post">
                            @foreach($footerServices as $service)
                                <div class="post-item">
                                    <div class="latest-post-content">
                                        <h4>
                                            <a href="{{ $service->getUrl() }}">
                                                <i class="fa fa-chevron-right"></i>
                                                <span>{{ $service->title }}</span>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="footer-widget item col-span-3 sm:col-span-12 res:col-span-12">
                    <div class="widget-footer widget_irhas_newestpostthumb">
                        <div class="title"><h4 class="widget-title">Newest Post</h4></div>
                        <div class="custom-post-widget clearfix">
                            <div class="custom-post-wrap">
                                @foreach($footerPosts->take(2) as $post)
                                    @php
                                        $postDate = $post->published_at ?? $post->created_at;
                                        $postImage = $post->imageUrl() ?? I::themeAsset('img/newest-post-footer-1.png');
                                    @endphp
                                    <div class="post-item clearfix">
                                        <div class="post-content clearfix">
                                            <div class="post-thumb-wrap">
                                                <div class="post-thumb">
                                                    <a href="{{ $post->getUrl() }}">
                                                        <img src="{{ $postImage }}" alt="{{ $post->title }}">
                                                        <div class="irhas-overlay"></div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-inner-content has-thumb clearfix">
                                                <h5><a href="{{ $post->getUrl() }}">{{ $post->title }}</a></h5>
                                                @if($postDate)
                                                    <div class="meta-latest-news">
                                                        <div class="meta-info">
                                                            <span class="date span-head">
                                                                <a href="{{ $post->getUrl() }}"><span>{{ $postDate->format('F j, Y') }}</span></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-widget item col-span-3 sm:col-span-12 res:col-span-12">
                    <div class="widget-footer widget_text">
                        <div class="title"><h4 class="widget-title">Get In Touch</h4></div>
                        <div class="textwidget">
                            @if($phone)<p><strong><a href="{{ $phoneHref }}">{{ $phone }}</a></strong></p>@endif
                            @if($address)<p>{{ $address }}</p>@endif
                            @if($email)<p><a href="mailto:{{ $email }}">{{ $email }}</a></p>@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-holder-home2">
        <div class="thaw-container">
            <div class="footer-bottom grid grid-cols-12">
                <div class="footer-bottom-lisensi col-span-6 sm:col-span-12 self-center">
                    <p class="copyright-footer">&copy; {{ date('Y') }} {{ $siteName }}</p>
                </div>
                <div class="footer-bottom-contact col-span-6 sm:col-span-12 self-center flex justify-end flex-wrap items-stretch items-center">
                    <div class="contact-footer items-center">
                        <div class="contact-footer-menu">
                            <ul class="sm">
                                @if($footerMenus->count())
                                    @foreach($footerMenus->take(3) as $menu)
                                        <li class="menu-item"><a href="{{ $menu->getUrl() }}">{{ $menu->title }}</a></li>
                                    @endforeach
                                @else
                                    <li class="menu-item"><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@if($whatsappNumber)
    <div class="irhas-whatsapp-float" style="position:fixed;bottom:24px;right:24px;z-index:999;">
        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp"
           style="display:inline-flex;align-items:center;justify-content:center;width:58px;height:58px;border-radius:50%;background:#25d366;color:#fff;font-size:28px;box-shadow:0 8px 24px rgba(0,0,0,.22);">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
@endif
