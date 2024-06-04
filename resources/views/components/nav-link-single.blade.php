@props(['route', 'label', 'icon'])

<li class="nav-item {{ Route::is($route . '*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route($route) }}">

        <i class="{{ $icon }} menu-icon"></i>

        <span class="menu-title">{{ $label }}</span>

    </a>
</li>
