@if ($resources->isEmpty())
    <div class="alert alert-warning" role="alert">
        There are currently no past <strong>{{ $category->examType->short_name }}
            {{ $category->name }}</strong> available. Please check back later.
    </div>
@else
    @foreach ($resources as $resource)
        <x-answer-view-card :resource="$resource" />
    @endforeach
@endif


<style>
    .h3_category-item {
        padding: 20px 10px 20px 15px;
    }

    .h3_category-item-content a {
        font-size: 20px;
    }
</style>
