@php
    $settings = \App\Models\SiteSetting::getSettings();
    $siteName = $settings->site_name ?? 'Pro Clean AC';
    $data = $section->data ?? [];
    $shortHeading = $data['short_heading'] ?? 'Why ' . $siteName . '?';
    $mainHeading = $data['main_heading'] ?? 'What makes us different?';
    $defaultTabs = [
        [
            'tab_label' => 'Brand Values',
            'title' => 'Brand Values',
            'content' => 'We take a lot of pride in our name and level of service that we offer you and your family. It starts with a quick response back to all enquiries and upon booking an appointment, we arrive on time, as promised. Our team are also easily identifiable in our branded uniforms and vehicles. Cleanliness is our top priority when we enter your homes or place of business, as well as communication between the team and the customer.',
            'image' => 'https://cdn.prod.website-files.com/5f32dc8fbfcb095f82c1b9ec/65b34f216d5ad2b2bf833d4f_Square%20Photo%20-%20About%20Us%20(1).jpg',
            'image_alt' => 'Brand values image',
        ],
        [
            'tab_label' => 'Approach',
            'title' => 'Approach',
            'content' => $siteName . '\'s approach is very positive, friendly, and professional approach. We pride ourselves in achieving our 5* reviews on a daily basis. Check out <a href="https://www.google.com/search?rlz=1C5CHFA_enAE899AE899&sxsrf=ALeKk02mzxxJjJ81A_Lx0OVpcAH86gjLbg%3A1612282921190&ei=KXwZYM6UC-iP1fAPxN-LiAM&q=pro+clean+ac+google+reviews&oq=pro+clean+ac+google+reviews&gs_lcp=CgZwc3ktYWIQAzIFCCEQoAE6BwgjELADECc6BwgAEEcQsAM6BAgjECc6DQguEMcBEK8BEBQQhwI6AggAOgYIABAWEB46BwghEAoQoAFQ8DtY01BgkFFoA3ACeACAAfYBiAGyGZIBBjAuMTEuNZgBAKABAaoBB2d3cy13aXrIAQfAAQE&sclient=psy-ab&ved=0ahUKEwiOza32zcvuAhXoRxUIHcTvAjEQ4dUDCA0&uact=5#lrd=0x3e5f4338e6cb9bf3:0xe9d5cd9fef15ef8b,1,,," class="link-4">our reviews</a>.',
            'image' => 'https://cdn.prod.website-files.com/5f32dc8fbfcb095f82c1b9ec/60cb30d7fdf562c2b808f1f8_Pro%20Clean%20AC%20Background-min-min.jpg',
            'image_alt' => $siteName . ' background image',
        ],
    ];
    $tabs = $data['tabs'] ?? [];
    $tabs = is_array($tabs) && count($tabs) ? $tabs : $defaultTabs;
    $activeTabKey = 'tab-0';
    $normalizeImage = function ($path) {
        if (!$path) {
            return null;
        }
        return \Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '//'])
            ? $path
            : asset(ltrim($path, '/'));
    };
@endphp

<div class="section-33 bg-tabbed">
    <div class="main-container-2">
        <div class="container-large align-center section-title-small">
            @if($shortHeading)
                <h5 class="tabbed-text">{{ $shortHeading }}</h5>
            @endif
            @if($mainHeading)
                <h3 class="display-heading-3 section-heading-copy">{{ $mainHeading }}</h3>
            @endif
        </div>
        <div data-duration-in="300" data-duration-out="100" data-easing="ease" data-current="{{ $activeTabKey }}" class="tabs-centered w-tabs">
            <div class="tabs-menu-buttons padded bg-primary-2 w-tab-menu" role="tablist">
                @foreach($tabs as $index => $tab)
                    @php
                        $tabKey = 'tab-' . $index;
                        $isActive = $index === 0;
                        $label = $tab['tab_label'] ?? ($tab['title'] ?? 'Tab ' . ($index + 1));
                    @endphp
                    <a data-w-tab="{{ $tabKey }}"
                       class="tab-button-white-2 tab-button-large w-inline-block w-tab-link {{ $isActive ? 'w--current' : '' }}"
                       id="pro-clean-tab-{{ $index }}-link"
                       href="#pro-clean-pane-{{ $index }}"
                       role="tab"
                       aria-controls="pro-clean-pane-{{ $index }}"
                       aria-selected="{{ $isActive ? 'true' : 'false' }}"
                       {!! $isActive ? '' : 'tabindex="-1"' !!}>
                        <div>{{ $label }}</div>
                    </a>
                @endforeach
            </div>
            <div class="tabs-centered-content w-tab-content">
                @foreach($tabs as $index => $tab)
                    @php
                        $tabKey = 'tab-' . $index;
                        $isActive = $index === 0;
                        $tabTitle = $tab['title'] ?? ($tab['tab_label'] ?? 'Tab ' . ($index + 1));
                        $tabContent = $tab['content'] ?? '';
                        $contentHtml = $tabContent
                            ? (\Illuminate\Support\Str::contains($tabContent, '<') ? $tabContent : nl2br(e($tabContent)))
                            : '';
                        $imageUrl = $normalizeImage($tab['image'] ?? '');
                        $imageAlt = $tab['image_alt'] ?? $tabTitle;
                        $isReversed = $index % 2 === 1;
                    @endphp
                    <div data-w-tab="{{ $tabKey }}" class="w-tab-pane {{ $isActive ? 'w--tab-active' : '' }}" id="pro-clean-pane-{{ $index }}" role="tabpanel" aria-labelledby="pro-clean-tab-{{ $index }}-link">
                        <div class="w-layout-grid grid-halves {{ $isReversed ? 'reverse-direction' : '' }}">
                            <div class="container align-center">
                                @if($tabTitle)
                                    <h4 class="large-heading">{{ $tabTitle }}</h4>
                                @endif
                                @if($contentHtml)
                                    <div class="text-large-2">{!! $contentHtml !!}</div>
                                @endif
                            </div>
                            @if($imageUrl)
                                <img src="{{ $imageUrl }}" loading="lazy" alt="{{ $imageAlt }}" class="image-9">
                            @endif
                            <div class="container align-center"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


