@if ($menu->status_is_visible)
    @if (isset($menu->allChildren) && $menu->allChildren->count() > 0)
        <li class="border rounded mb-1">
            <div class="btn-group d-flex">
                <a class="btn w-100 text-start" href="{{ $menu->url }}" target="{{ $menu->target }}">
                    {{ $menu->name }}
                </a>
                <button class="btn border-start btn-children collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#offcanvasNas_{{ $menu->id }}" aria-expanded="false"
                    aria-controls="collapseExample">
                    <i class="mdi mdi-chevron-down"></i>
                </button>
            </div>
            <ul class="collapse border-top p-1" id="offcanvasNas_{{ $menu->id }}">
                @foreach ($menu->allChildren as $menu)
                    @include(UiBlade::theme('partials.item_offcanvas'), ["menu" => $menu])
                @endforeach
            </ul>
        </li>
    @else
        <li class="border rounded mb-1">
            <a class="btn w-100 text-start" href="{{ $menu->url }}" target="{{ $menu->target }}">
                {{ $menu->name }}
            </a>
        </li>
    @endif
@endif
