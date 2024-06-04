@props(['subject'])


<div class="col-xl-3 col-lg-3 col-sm-6">
    <div class="h4_category-item">
        {{-- <div class="h4_category-item-icon">
            <i class="fa-light fa-square-pen"></i>
        </div> --}}
        <div class="h4_category-item-content">
            <h5><a href="{{ route('view-answer-all', ['id' => $subject->id]) }}">{{ $subject->examType->short_name }}
                    {{ $subject->name }}</a>
            </h5>
            {{-- @if ($subject->examType)
                <span style="color: red;">({{ $subject->examType->short_name }})</span>
            @endif
            <p>{{ $subject->resource->count() }} Question</p> --}}
        </div>
    </div>
</div>


<style>
    .h4_category-item {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 5px;
        padding: 20px 10px 20px 10px;
        /* Adjust the values for the desired shadow effect */
    }
</style>
