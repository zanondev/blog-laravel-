@php

$location = $GLOBALS['location'];

$link_dashboard = '';
$link_admin = '';

switch (true) {
    case stripos($location, 'dashboard') !== false:
        $link_dashboard = 'active';
        break;

    case stripos($location, 'gestor') !== false:
        $link_admin = 'active';
        break;

    case stripos($location, 'banner') !== false:
        $link_banners = 'active';
        break;
}

@endphp

<aside class='general-dashboard-aside'>
    <div class="background"></div>
    <nav class='first-top-padding'>

        <div class="sidebar-head-items">
            <div class="sidebar-head">
                <a class='sidebar-link sidebar-logo' href="{{ route('dashboard') }}"
                    title="{{ config('app.name') }} | Admin">
                    <img src="{{ url('img/logo-white.svg') }}" alt="{{ config('app.name') }} | Admin">
                </a>

                <span class="version-ueek">
                    <b>adm</b> vs 2.0
                </span>
            </div>

            <div class="nav-toggle">
                <button class="nav-button" aria-label="Fechar menu mobile">
                    <span class="span-menu"></span>
                    <span class="span-menu"></span>
                    <span class="span-menu"></span>
                </button>
            </div>
        </div>

        <div class="sidebar-divider"></div>

        <div class="sidebar-links">

            <div class="group-links">

                <p class="label-links">Gestão de conteúdo</p>

                <a class="sidebar-link {{ $link_dashboard }}" href="{{ route('dashboard') }}">
                    <span class="iconify" data-icon="bx:bxs-dashboard"></span>
                    Dashboard
                </a>

                <a class="sidebar-link" href="{{ route('post_category.list') }}">
                    <span class="iconify" data-icon="fa6-solid:tag"></span>
                    Categorias Post
                </a>

                <a class="sidebar-link" href="{{ route('post.list') }}">
                    <span class="iconify" data-icon="jam:write"></span>
                    Posts
                </a>


                <div class="collapse-group">
                    <a class="sidebar-link " data-bs-toggle="collapse" href="#collapseproduct" role="button"
                        aria-expanded="false" aria-controls="collapseproduct">
                        <span class="iconify" data-icon="bx:bxs-package"></span>
                        Collapse
                        <span class="iconify" data-icon="feather:chevron-down"></span>
                    </a>
                    <div class="collapse multi-collapse" id="collapseproduct">
                        <a class="sidebar-link" href="/">
                            <span class="iconify" data-icon="bx:bxs-spreadsheet"></span>
                            Item
                        </a>
                        <a class="sidebar-link " href="/">
                            <span class="iconify" data-icon="bx:bxs-square-rounded"></span>
                            Item
                        </a>

                    </div>
                </div>

            </div>

            <div class="group-links">

                <p class="label-links">Configurações</p>

                <a class="sidebar-link {{ $link_admin }}" href="{{ route('admin.list') }}">
                    <span class="iconify" data-icon="gridicons:multiple-users"></span>
                    Usuários gestores
                </a>

            </div>

        </div>

    </nav>
</aside>
