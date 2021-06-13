
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ProHRM</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false" id="main-menu">

                    <?php
                    $menu = config('menu');
                    ?>

                    @foreach($menu as $key => $item)
                        <li class="nav-item">
                            <a href="{{ !empty($item['url']) ? route($item['url']) : '' }}" class="nav-link">
                                <i class="nav-icon {{ $item['icon'] }}"></i>
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
            </nav>

    </div>
</aside>
