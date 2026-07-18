@extends(
    $page->use_irhas2_layout ? 'frontend.layout-irhas2' :
    ($page->use_irhas_layout ? 'frontend.layout-irhas' :
    ($page->use_new_layout ? 'frontend.layout-new' : 'frontend.layout'))
)

@section('title', $page->meta_title ?? $page->title)

@section('content')
@if($page->sections->count() > 0)
    @foreach($page->sections as $section)
        @if($section->status)
            @php
                $sectionView = 'frontend.sections.' . $section->type;
            @endphp
            @if(view()->exists($sectionView))
                @include($sectionView, ['section' => $section])
            @else
                <div class="container my-3">
                    <div class="alert alert-warning">
                        Section view not found: {{ $section->type }}
                    </div>
                </div>
            @endif
        @endif
    @endforeach
@else
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1>{{ $page->title }}</h1>
                <p class="lead">No sections available for this page. Please add sections from the admin panel.</p>
            </div>
        </div>
    </div>
@endif
@endsection

