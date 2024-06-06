<div class="card mb-4">
    <div class="card-body p-0">
        <h5 class="card-title m-0 p-3">
            {!! $chart1->renderHtml() !!}
        </h5>
        {!! $chart1->renderChartJsLibrary() !!}
        {!! $chart1->renderJs() !!}
    </div>
</div>
