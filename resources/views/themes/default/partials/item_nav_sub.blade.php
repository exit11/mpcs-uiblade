@if ($menu->status_is_visible)
    @if (isset($menu->allChildren) && $menu->allChildren->count() > 0)
        <li class="dropdown-submenu">
            <a class="dropdown-item dropdown-toggle" href="{{ $menu->url }}" target="{{ $menu->target }}">
                {{ $menu->name }}
            </a>
            <ul class="dropdown-menu">
                @foreach ($menu->allChildren as $menu)
                    @include(UiBlade::theme('partials.item_nav_sub'), ["menu" => $menu])
                @endforeach
            </ul>
        </li>
    @else
        <li>
            <a class="dropdown-item" href="{{ $menu->url }}" target="{{ $menu->target }}">
                {{ $menu->name }}
            </a>
        </li>
    @endif
@endif
