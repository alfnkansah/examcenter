@props(['route', 'label'])

<li class="nav-item">
    <a class="nav-link" href="{{ route($route) }}">{{ $label }}</a>
</li>
