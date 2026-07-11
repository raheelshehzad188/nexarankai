@php
    $theme = \App\Support\IrhasSectionData::THEME_BASE;
    $image = $post->imageUrl('featured_image') ?: asset($theme . '/img/latest-news-1-irhas3.png');
    $authorImage = $post->imageUrl('author_image') ?: asset($theme . '/img/post-author-blog-page.png');
    $colClass = $colClass ?? 'col-span-3 res:col-span-6 sm:col-span-12';
@endphp
<div class="blog-item-style-1 col-item-post {{ $colClass }}">
    <div class="post-content-wrap clearfix">
        <div class="post-inner box-shadow-content">
            <div class="blog-image-container">
                <div class="thaw-grid-image">
                    <a href="{{ $post->getUrl() }}">
                        <img src="{{ $image }}" alt="{{ $post->title }}">
                        <div class="irhas-overlay"></div>
                    </a>
                </div>
            </div>
            <div class="thaw-grid-content clearfix has-thumb">
                <div class="post-thumb-img">
                    <div class="author span-head">
                        <span class="author-img"><img alt="author" src="{{ $authorImage }}"></span>
                        @if($post->author_name)
                            <span class="vcard">{{ $post->author_name }}</span>
                        @endif
                        @if($post->author_role)
                            <p class="author-role">{{ $post->author_role }}</p>
                        @endif
                    </div>
                    <h3><a href="{{ $post->getUrl() }}">{{ $post->title }}</a></h3>
                    @if($post->categories->count())
                        <div class="the-category">
                            @foreach($post->categories as $index => $category)
                                @if($index > 0),@endif<a href="{{ $category->getUrl() }}" rel="category tag">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
