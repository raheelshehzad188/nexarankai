@php
    $data = $section->data ?? [];
    $videoSource = $data['video_source'] ?? 'mp4';
    $youtubeLink = $data['youtube_link'] ?? '';
    $mp4Link = $data['mp4_link'] ?? '';
    $videoFile = $data['video_file'] ?? '';
    $heading = $data['heading'] ?? '';
    $shortDetail = $data['short_detail'] ?? '';
    $btnText = $data['btn_text'] ?? '';
    $btnLink = $data['btn_link'] ?? '';
    
    // Extract YouTube video ID from URL
    $videoId = '';
    if (!empty($youtubeLink) && $videoSource === 'youtube') {
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $youtubeLink, $matches)) {
            $videoId = $matches[1];
        } else {
            $videoId = $youtubeLink;
        }
    }
    
    $assets_url = asset('assets/dubai/www.proclean-ac.com');
@endphp

<div class="hero-section-3">
    @if($videoSource === 'youtube' && $videoId)
        <div data-poster-url="{{ $assets_url }}/../imgs/60d1a0d2a9fad2bc8bc60d22_ProCleanAC-HomepageVideo-transcode-poster-00001.jpg" 
             data-video-urls="https://www.youtube.com/embed/{{ $videoId }}" 
             data-autoplay="true" 
             data-loop="true" 
             data-wf-ignore="true" 
             data-beta-bgvideo-upgrade="false" 
             class="background-video w-background-video w-background-video-atom">
            <iframe 
                src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&mute=1&loop=1&playlist={{ $videoId }}&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1" 
                frameborder="0" 
                allow="autoplay; encrypted-media" 
                allowfullscreen
                style="position: absolute; top: 50%; left: 50%; width: 100vw; height: 100vh; transform: translate(-50%, -50%); min-width: 100%; min-height: 100%; object-fit: cover;"
            ></iframe>
        </div>
    @elseif($videoSource === 'mp4' && $mp4Link)
        <div data-poster-url="{{ $assets_url }}/../imgs/60d1a0d2a9fad2bc8bc60d22_ProCleanAC-HomepageVideo-transcode-poster-00001.jpg" 
             data-video-urls="{{ $mp4Link }},{{ str_replace('.mp4', '.webm', $mp4Link) }}" 
             data-autoplay="true" 
             data-loop="true" 
             data-wf-ignore="true" 
             data-beta-bgvideo-upgrade="false" 
             class="background-video w-background-video w-background-video-atom">
            <video id="hero-video-{{ $section->id }}" autoplay loop muted playsinline style="background-image:url({{ $assets_url }}/../imgs/60d1a0d2a9fad2bc8bc60d22_ProCleanAC-HomepageVideo-transcode-poster-00001.jpg)" data-wf-ignore="true" data-object-fit="cover">
                <source src="{{ $mp4Link }}" data-wf-ignore="true"/>
                <source src="{{ str_replace('.mp4', '.webm', $mp4Link) }}" data-wf-ignore="true"/>
            </video>
        </div>
    @elseif($videoSource === 'upload' && $videoFile)
        <div data-poster-url="{{ $assets_url }}/../imgs/60d1a0d2a9fad2bc8bc60d22_ProCleanAC-HomepageVideo-transcode-poster-00001.jpg" 
             data-video-urls="{{ asset('storage/' . $videoFile) }}" 
             data-autoplay="true" 
             data-loop="true" 
             data-wf-ignore="true" 
             data-beta-bgvideo-upgrade="false" 
             class="background-video w-background-video w-background-video-atom">
            <video id="hero-video-{{ $section->id }}" autoplay loop muted playsinline style="background-image:url({{ $assets_url }}/../imgs/60d1a0d2a9fad2bc8bc60d22_ProCleanAC-HomepageVideo-transcode-poster-00001.jpg)" data-wf-ignore="true" data-object-fit="cover">
                <source src="{{ asset('storage/' . $videoFile) }}" data-wf-ignore="true"/>
            </video>
        </div>
    @endif
    
    <div class="hero-section-3-container">
        <div class="main-container">
            <div class="container hero-section-3-content">
                @if($heading)
                    <h1 class="display-heading-1">{!! nl2br(e($heading)) !!}</h1>
                @endif
                @if($shortDetail)
                    <p class="text-large-4"><span class="text-span-18">{{ $shortDetail }}</span></p>
                @endif
                @if($btnText && $btnLink)
                    <a href="{{ $btnLink }}" class="button-mobile-hero w-inline-block">
                        <div class="text-block-17">{{ $btnText }}</div>
                    </a>
                    <a href="{{ $btnLink }}" class="button-2 logo-row-button no-margin-left w-inline-block">
                        <div>{{ $btnText }}</div>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
