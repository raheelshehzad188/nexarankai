@php
    use App\Models\BlogPost;
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas2-blog');
    $limit = (int) I::get($data, 'posts_limit', 3);
    $posts = BlogPost::publishedList($limit > 0 ? $limit : 3);
    $defaultImage = I::themeAsset(I::get($data, 'default_image', 'img/img-latest-news-1-irhas-2.png'));
@endphp
<div class="blog-block-home2">
    <div class="thaw-container">
        <div class="blog-wrap grid grid-cols-12">
            <div class="title-blog-left col-span-12 sm:col-span-12 res:col-span-12">
                <div class="the-title text-center">
                    @if(I::get($data, 'eyebrow'))<h5>{{ I::get($data, 'eyebrow') }}</h5>@endif
                    @if(I::get($data, 'title'))<h2>{{ I::get($data, 'title') }}</h2>@endif
                </div>
            </div>
        </div>
        @if($posts->count())
            <div class="blog-loop-wrap grid grid-cols-12" data-aos="fade-zoom-in">
                @foreach($posts as $post)
                    @php
                        $image = $post->imageUrl('featured_image') ?: $defaultImage;
                        $date = $post->published_at ?? $post->created_at;
                    @endphp
                    <div class="blog-item-style-6 col-item-post col-span-4 sm:col-span-12">
                        <div class="post-content-wrap clearfix">
                            <div class="post-inner">
                                <div class="blog-image-container">
                                    <div class="side-meta">
                                        <div class="standard-post-date span-head">
                                            <a href="{{ $post->getUrl() }}">{{ $date ? $date->format('F j, Y') : '' }}</a>
                                        </div>
                                    </div>
                                    <div class="thaw-grid-image">
                                        <img src="{{ $image }}" alt="{{ $post->title }}">
                                        <div class="blog-grid-meta">
                                            <div class="meta-holder">
                                                <div class="read-more"><a href="{{ $post->getUrl() }}">Read More</a></div>
                                            </div>
                                        </div>
                                        <div class="irhas-overlay"></div>
                                    </div>
                                </div>
                                <div class="thaw-grid-content clearfix has-thumb">
                                    <div class="post-thumb-img">
                                        @if($post->categories->count())
                                            <div class="the-category">
                                                @foreach($post->categories as $index => $category)
                                                    @if($index > 0), @endif<a href="{{ $category->getUrl() }}" rel="category tag">{{ $category->name }}</a>
                                                @endforeach
                                            </div>
                                        @endif
                                        <h3><a href="{{ $post->getUrl() }}">{{ $post->title }}</a></h3>
                                        @if($post->excerpt)
                                            <div class="post-text excerpt"><p>{{ $post->excerpt }}</p></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
