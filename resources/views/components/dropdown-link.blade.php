@props(['route', 'label'])

<li class="nav-item {{ request()->routeIs($route) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route($route) }}">{{ $label }}</a>
</li>
