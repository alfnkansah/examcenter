@props(['data', 'label'])

<div class="col-md-3 mb-4 stretch-card transparent">
    <div class="card card-dark-blue">
        <div class="card-body">
            <p class="mb-4">{{ $label }}</p>
            <p class="fs-30 mb-2">{{ $data }}</p>
        </div>
    </div>
</div>
