@props(['resource'])

<div class="col-xl-4 col-lg-6">
    <div class="h3_category-item mb-30">
        <div class="h3_category_inner">
            <div class="h3_category-item-content">
                {{-- {{ asset('storage/' . $resource->file_path) }} --}}
                <h5><a href="{{ route('view-answer', $resource->id) }}" target="_blank">
                        {{ $resource->subject->name }} - {{ $resource->questionType->name }}
                        <span style="color: red;"> ({{ $resource->exam_year }})</span>
                    </a>

                </h5>
            </div>
            <div class="h3_category-btn">

            </div>
        </div>
    </div>
</div>
