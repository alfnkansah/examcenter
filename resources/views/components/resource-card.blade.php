@props(['resource'])

<div class="col-xl-4 col-lg-6">
    <div class="h3_category-item mb-30">
        <div class="h3_category_inner">
            <div class="h3_category-item-content">
                <h5><a href="{{ route('submit.phone', $resource->id) }}">
                        {{ $resource->subject->name }} -
                        {{ $resource->questionType->name }}
                        <span style="color: red;"> ({{ $resource->exam_year }})</span>
                    </a>
                </h5>
            </div>
            <div class="h3_category-btn">
                <a href="{{ route('submit.phone', $resource->id) }}"><i class="fa-light fa-download"></i></a>
            </div>
        </div>
    </div>
</div>
