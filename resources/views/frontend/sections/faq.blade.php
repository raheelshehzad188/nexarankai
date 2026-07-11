@php
    $data = $section->data ?? [];
    $faqs = $data['faqs'] ?? [];
@endphp

<section class="my-5 py-4">
    <div class="container">
        <h2 class="text-center mb-5">Frequently Asked Questions</h2>
        @if(count($faqs) > 0)
            <div class="accordion" id="faqAccordion{{ $section->id }}">
                @foreach($faqs as $index => $faq)
                    @if(!empty($faq['question']) && !empty($faq['answer']))
                        <div class="accordion-item mb-2">
                            <h4 class="accordion-header">
                                {{ $faq['question'] }}
                            </h4>
                            <div id="faq{{ $section->id }}_{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion{{ $section->id }}">
                                <div class="accordion-body">
                                    {!! $faq['answer'] !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">No FAQ items available. Add FAQ items from admin panel.</div>
        @endif
    </div>
</section>

