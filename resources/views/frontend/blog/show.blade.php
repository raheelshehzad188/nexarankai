@php
    $theme = \App\Support\IrhasSectionData::THEME_BASE;
    $publishedDate = $blogPost->published_at ? $blogPost->published_at->format('F j, Y') : $blogPost->created_at->format('F j, Y');
    $featured = $blogPost->imageUrl('featured_image') ?: asset($theme . '/img/tumbnail-single-blog.png');
    $authorImage = $blogPost->imageUrl('author_image') ?: asset($theme . '/img/profile-author.png');
@endphp
@extends('frontend.layout-irhas')

@section('content')
<div class="single-post-wrap">
    <div class="thaw-container">
        <div class="grid grid-cols-12 gap-24">
            <div class="col-span-9 sm:col-span-12 items-start">
                <div class="blog-single content-section">
                    <div class="post-single">
                        <div class="single-content">
                            <div class="single-head">
                                <div class="title-content">
                                    <h1>{{ $blogPost->title }}</h1>
                                </div>
                                <div class="single-post-meta">
                                    <div class="standard-post-date span-head">{{ $publishedDate }}</div>
                                    @if($blogPost->categories->count())
                                        <div class="the-category span-head">
                                            @foreach($blogPost->categories as $index => $category)
                                                @if($index > 0), @endif<a href="{{ $category->getUrl() }}">{{ $category->name }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="post-thumb">
                                <img src="{{ $featured }}" alt="{{ $blogPost->title }}">
                            </div>

                            <div class="single-content-details">
                                @if(count($blogPost->tags_list))
                                    <div class="meta-bottom">
                                        <div class="tag-wrapper">
                                            <p>Tags : </p>
                                            @foreach($blogPost->tags_list as $index => $tag)
                                                @if($index > 0), @endif<span>{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="the-content">
                                    @if($blogPost->excerpt)
                                        <p><strong>{{ $blogPost->excerpt }}</strong></p>
                                    @endif
                                    {!! $blogPost->content !!}
                                </div>
                            </div>
                        </div>

                        @if($blogPost->author_name)
                            <div class="post-author clearfix">
                                <div class="author-wrap clearfix">
                                    <figure class="author-ava">
                                        <img alt="avatar-image" src="{{ $authorImage }}">
                                    </figure>
                                    <div class="author-desc">
                                        <div class="author-name"><span>{{ $blogPost->author_name }}</span></div>
                                        @if($blogPost->author_bio)
                                            <p class="author-description">{{ $blogPost->author_bio }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if($relatedPosts->count())
                    <div class="related-wrap-out clearfix">
                        <div class="related-content clearfix">
                            <h3 class="clearfix">Related Posts</h3>
                            <div class="grid grid-cols-12 gap-12">
                                @foreach($relatedPosts as $related)
                                    @php $relImage = $related->imageUrl('featured_image') ?: asset($theme . '/img/img-related-post-1.png'); @endphp
                                    <div class="col-span-6 sm:col-span-6 content-related-post clearfix">
                                        <div class="post-content-wrap clearfix">
                                            <div class="post-inner grid grid-cols-12 box-shadow-content">
                                                <div class="col-span-6 sm:col-span-6 post-thumb">
                                                    <a href="{{ $related->getUrl() }}">
                                                        <img src="{{ $relImage }}" alt="{{ $related->title }}">
                                                        <div class="irhas-overlay"></div>
                                                    </a>
                                                </div>
                                                <div class="image-description-content items-center self-center col-span-6 sm:col-span-6 has-thumb">
                                                    <h2 class="title-content"><a href="{{ $related->getUrl() }}">{{ $related->title }}</a></h2>
                                                    <div class="standard-post-date span-head">
                                                        {{ $related->published_at?->format('F j, Y') ?? $related->created_at->format('F j, Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="blog-widgets-wrap col-span-3 res:col-span-12 sm:col-span-12">
                <div class="blog-sidebar">
                    <div class="widget widget_irhas_newestpostthumb">
                        <h4 class="widget-title"><span>Newest Post</span></h4>
                        <div class="custom-post-widget clearfix">
                            <div class="custom-post-wrap">
                                @foreach($recentPosts as $recent)
                                    @php $sideImg = $recent->imageUrl('featured_image') ?: asset($theme . '/img/sidebar-newest-post-1.png'); @endphp
                                    <div class="post-item clearfix">
                                        <div class="post-content clearfix">
                                            <div class="post-thumb-wrap">
                                                <div class="post-thumb">
                                                    <a href="{{ $recent->getUrl() }}">
                                                        <img src="{{ $sideImg }}" alt="latestwid-img">
                                                        <div class="irhas-overlay"></div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-inner-content has-thumb clearfix">
                                                <h5><a href="{{ $recent->getUrl() }}">{{ $recent->title }}</a></h5>
                                                <div class="meta-latest-news">
                                                    <div class="meta-info">
                                                        <span class="date span-head">
                                                            <span>{{ $recent->published_at?->format('F j, Y') ?? $recent->created_at->format('F j, Y') }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
