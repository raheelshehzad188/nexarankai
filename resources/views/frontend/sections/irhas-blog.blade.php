@php
    use App\Models\BlogPost;
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas-blog');
    $limit = (int) I::get($data, 'posts_limit', 4);
    $posts = BlogPost::publishedList($limit > 0 ? $limit : 4);
@endphp
<div class="blog-block">
    <div class="thaw-container">
        <div class="blog-wrap grid grid-cols-12">
            <div class="title-blog-left col-span-12 sm:col-span-12 res:col-span-12">
                <div class="blog-title the-title">
                    @if(I::get($data, 'eyebrow'))<h5>{{ I::get($data, 'eyebrow') }}</h5>@endif
                    @if(I::get($data, 'title'))<h2>{{ I::get($data, 'title') }}</h2>@endif
                </div>
            </div>
        </div>
        @if($posts->count())
            <div class="blog-loop-wrap grid grid-cols-12 gap-12" data-aos="fade-zoom-in">
                @foreach($posts as $post)
                    @include('frontend.partials.irhas.blog-card', ['post' => $post])
                @endforeach
            </div>
            @if(I::get($data, 'view_all_url'))
                <div class="text-center mt-4">
                    <a href="{{ I::get($data, 'view_all_url') }}" class="button">{{ I::get($data, 'view_all_text', 'View All Posts') }}</a>
                </div>
            @endif
        @endif
    </div>
</div>
