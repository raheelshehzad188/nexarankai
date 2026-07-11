@extends('frontend.layout-irhas')

@section('content')
<div class="banner-header-style2">
    <div class="banner-header-style2-overlay"></div>
    <div class="thaw-container">
        <div class="title-banner-style2-wrap grid grid-cols-12">
            <div class="title-banner-style2 the-title col-span-12" data-aos="fade-up">
                <h5>Category</h5>
                <h2>{{ $blogCategory->name }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="blog-block">
    <div class="thaw-container">
        @if($posts->count())
            <div class="blog-loop-wrap grid grid-cols-12 gap-12" data-aos="fade-zoom-in">
                @foreach($posts as $post)
                    @include('frontend.partials.irhas.blog-card', ['post' => $post, 'colClass' => 'col-span-4 res:col-span-6 sm:col-span-12'])
                @endforeach
            </div>
        @else
            <p class="py-5 text-center">No posts in this category yet.</p>
        @endif
    </div>
</div>
@endsection
