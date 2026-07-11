@php
    $data = $section->data ?? [];
    $heading = $data['heading'] ?? '';
    $leftContent = $data['left_content'] ?? '';
    $rightContent = $data['right_content'] ?? '';
@endphp

<div class="title bg-10">
    <div class="main-container">
        @if($heading)
            <div class="text-grid-title">
                <h3 class="display-heading-2 section-heading">
                    <span class="text-span-6">{!! nl2br(e($heading)) !!}</span>
                </h3>
            </div>
        @endif
        @if($leftContent || $rightContent)
            <div class="w-layout-grid text-grid-halves">
                @if($leftContent)
                    <div class="text-large-4">
                        <span class="text-span-5">{!! $leftContent !!}</span>
                    </div>
                @endif
                @if($rightContent)
                    <div class="text-large-4">
                        <span class="text-span-4">{!! $rightContent !!}</span>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

