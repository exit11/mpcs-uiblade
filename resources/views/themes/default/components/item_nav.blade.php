@forelse($menus as $menu)
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">{{ trans($menu->title) }}</a>
        @if (isset($menu->children) && $menu->children->count() > 0)
            <ul class="pt-1 collapse nested-sortable" style="list-style: none" id="branch_{{ $menu->id }}">
                @foreach ($menu->children as $menus)
                    @component(UiBlade::theme('components.item_nav'), $menus)
                    @endcomponent
                @endforeach
            </ul>
        @endif
    </li>
@empty
@endforelse
