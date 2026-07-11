@php
    use App\Support\IrhasSectionData as I;
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Irhas';
    $footerMenus = \App\Models\Menu::getByLocation('footer');
    $footerServices = \App\Models\Service::getActive()->take(4);
    $footerPosts = \App\Models\BlogPost::publishedList(3);
    $logoUrl = I::themeAsset('img/irhas3.png');
    if ($settings->site_logo) {
        $logoUrl = I::themeAsset($settings->site_logo);
    }
    $footerText = $settings->footer_text ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore dolore. Nam tincidunt, tellus quis maximus consequat. et malesuada nibh lorem vel.';
    $phone = $settings->header_phone ?? '+62 828 111 96 75';
    $email = $settings->header_email ?? 'irhas@contact.com';
    $address = $settings->site_address ?? null;
    $phoneHref = $phone ? 'tel:' . preg_replace('/[^0-9+]/', '', $phone) : '#';
    $socialLinks = is_array($settings->social_links ?? null) ? $settings->social_links : [];
    $socialIcons = [
        'facebook' => 'fab fa-facebook-f',
        'instagram' => 'fab fa-instagram',
        'youtube' => 'fab fa-youtube',
        'linkedin' => 'fab fa-linkedin-in',
        'twitter' => 'fab fa-twitter',
        'x' => 'fab fa-x-twitter',
    ];
    $whatsappNumber = $settings->whatsapp_number ? preg_replace('/[^0-9]/', '', $settings->whatsapp_number) : null;
@endphp
<style>
    .footer-social-links {
        display: flex;
        gap: 12px;
        margin-top: 18px;
    }

    .footer-social-links a {
        align-items: center;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 50%;
        color: inherit;
        display: inline-flex;
        height: 34px;
        justify-content: center;
        width: 34px;
    }

    .irhas-whatsapp-float {
        bottom: 24px;
        position: fixed;
        right: 24px;
        z-index: 999;
    }

    .irhas-whatsapp-float a {
        align-items: center;
        background: #25d366;
        border-radius: 50%;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.22);
        color: #fff;
        display: inline-flex;
        font-size: 28px;
        height: 58px;
        justify-content: center;
        width: 58px;
    }
</style>
<footer class="footer">
    <div class="footer-widgets-holder">
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
                        <div class="title">
                            <h4 class="widget-title">Our Service</h4>
                        </div>
                        <div class="sidebar-recent-post">
                            @if($footerServices->count())
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
                            @else
                                @foreach(['Referral Service Management', 'Personal Service Development', 'Strategy Business Management', 'Partnership Quality Member'] as $title)
                                    <div class="post-item">
                                        <div class="latest-post-content">
                                            <h4><a href="#"><i class="fa fa-chevron-right"></i><span>{{ $title }}</span></a></h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="footer-widget item col-span-3 sm:col-span-12 res:col-span-12">
                    <div class="widget-footer widget_irhas_newestpostthumb">
                        <div class="title">
                            <h4 class="widget-title">Newest Post</h4>
                        </div>
                        <div class="custom-post-widget clearfix">
                            <div class="custom-post-wrap">
                                @if($footerPosts->count())
                                    @foreach($footerPosts as $post)
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
                                                                    <a href="{{ $post->getUrl() }}">
                                                                        <span>{{ $postDate->format('F j, Y') }}</span>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach(collect(config('irhas_defaults.irhas-blog.items', []))->take(3) as $post)
                                        <div class="post-item clearfix">
                                            <div class="post-content clearfix">
                                                <div class="post-thumb-wrap">
                                                    <div class="post-thumb">
                                                        <a href="{{ $post['link'] ?? '#' }}">
                                                            <img src="{{ I::themeAsset($post['image'] ?? 'img/newest-post-footer-1.png') }}" alt="{{ $post['title'] ?? 'Blog post' }}">
                                                            <div class="irhas-overlay"></div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="post-inner-content has-thumb clearfix">
                                                    <h5><a href="{{ $post['link'] ?? '#' }}">{{ $post['title'] ?? '' }}</a></h5>
                                                    <div class="meta-latest-news">
                                                        <div class="meta-info">
                                                            <span class="date span-head">
                                                                <a href="{{ $post['link'] ?? '#' }}">
                                                                    <span>{{ $post['date'] ?? 'July 14, 2020' }}</span>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-widget item col-span-3 sm:col-span-12 res:col-span-12">
                    <div class="widget-footer widget_text">
                        <div class="title">
                            <h4 class="widget-title">Get In Touch</h4>
                        </div>
                        <div class="textwidget">
                            @if($phone)
                                <p><strong><a href="{{ $phoneHref }}">{{ $phone }}</a></strong></p>
                            @endif
                            @if($email)
                                <p><a href="mailto:{{ $email }}">{{ $email }}</a></p>
                            @endif
                            @if($address)
                                <p>{{ $address }}</p>
                            @endif
                            @if(!empty($socialLinks))
                                <div class="footer-social-links">
                                    @foreach($socialLinks as $key => $social)
                                        @php
                                            $platform = is_array($social) ? ($social['platform'] ?? $key) : $key;
                                            $url = is_array($social) ? ($social['url'] ?? null) : $social;
                                            $icon = $socialIcons[strtolower((string) $platform)] ?? 'fa fa-link';
                                        @endphp
                                        @if($url)
                                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($platform) }}">
                                                <i class="{{ $icon }}"></i>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-holder">
        <div class="thaw-container">
            <div class="footer-bottom grid grid-cols-12">
                <div class="footer-bottom-lisensi col-span-6 sm:col-span-12 self-center">
                    <p class="copyright-footer">© {{ date('Y') }} {{ $siteName }}</p>
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
    <div class="irhas-whatsapp-float">
        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
@endif
