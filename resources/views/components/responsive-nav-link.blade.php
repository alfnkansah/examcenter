@props(['icon'])

<a {{ $attributes->merge(['class' => 'dropdown-item']) }}>
    <i class="{{ $icon }} text-primary"></i>

    {{ $slot }}
</a>
