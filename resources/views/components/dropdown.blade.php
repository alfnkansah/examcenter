@props(['id', 'label', 'icon', 'routes' => []])

@php
    $isActive = false;
    foreach ($routes as $route) {
        if (request()->routeIs($route)) {
            $isActive = true;
            break;
        }
    }
@endphp

<li class="nav-item {{ $isActive ? 'active' : '' }}">
    <a class="nav-link" data-toggle="collapse" href="#{{ $id }}" aria-expanded="false"
        aria-controls="{{ $id }}">
        <i class="{{ $icon }} menu-icon"></i>
        <span class="menu-title">{{ $label }}</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="{{ $id }}">
        <ul class="nav flex-column sub-menu">
            {{ $slot }}
        </ul>
    </div>
</li>
