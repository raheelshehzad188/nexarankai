@php
    use App\Support\IrhasSectionData as I;
    $data = I::withDefaults($section->data ?? [], 'irhas-blog-list');
    $posts = \App\Models\BlogPost::publishedList();
@endphp

<div class="blog-block">
    <div class="thaw-container">
        @if($posts->count())
            <div class="blog-loop-wrap grid grid-cols-12 gap-12" data-aos="fade-zoom-in">
                @foreach($posts as $post)
                    @include('frontend.partials.irhas.blog-card', ['post' => $post, 'colClass' => 'col-span-4 res:col-span-6 sm:col-span-12'])
                @endforeach
            </div>
        @else
            <p class="py-5 text-center">No blog posts published yet. Add posts from Admin → Blog Posts.</p>
        @endif
    </div>
</div>
