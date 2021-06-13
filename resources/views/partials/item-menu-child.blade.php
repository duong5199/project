
@if(!empty($menu))

    <ul class="nav nav-treeview">
        @foreach($menu as $item)
            <li class="nav-item">
                <a href="{{ !empty($item['url']) ? route($item['url']) : '' }}" class="nav-link">
                    <i class="nav-icon {{ $item['icon'] ?? 'far fa-circle' }}  nav-icon"></i>
                    <p>
                        {{ $item['name'] }}

                        @if(!empty($item['child']))
                            <i class="fas fa-angle-left right"></i>
                        @endif
                    </p>
                </a>

                @include('partials.item-menu-child', ['menu' => $item['child'] ?? []])

            </li>
        @endforeach
    </ul>

@endif
