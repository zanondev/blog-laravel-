@php

$GLOBALS['url'] = '';
$GLOBALS['urlDashboard'] = '/admin';
$GLOBALS['full_url'] = explode('/', $_SERVER['REQUEST_URI']);
$GLOBALS['location'] = $_SERVER['REQUEST_URI'];

$has_login = hasAdmin() ? true : false;

use App\Models\Admin;

if ($has_login) {
    $admin_shared = Admin::find(getAdmin('id'));
}

$url = $GLOBALS['url'];
$location = $GLOBALS['location'];

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $link_server = "https://{$_SERVER['HTTP_HOST']}";
} else {
    $link_server = "http://{$_SERVER['HTTP_HOST']}";
}

$full_url = $GLOBALS['full_url'];

$urlDashboard = $GLOBALS['urlDashboard'];

@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config('app.name') }} | ADM">
    <meta name="author" content="Ueek Agência Digital">
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" href="{{ url('/img/favicon.svg') }}">

    <title>{{ config('app.name') }} | ADM</title>

    <link rel="preload" as="style" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    </noscript>

    <!-- Libs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css">

    <link rel="stylesheet" href="{{ url('/lib/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('/lib/simditor-2.3.28/styles/simditor.css') }}" />

    <link rel="preload" as="style"
        href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    </noscript>

    @vite(['resources/assets/less/admin/style.less'])

    <!-- Custom styles for this template-->

</head>

<body id="page-top">

    <main>
        <div class="small-notifications-area"></div>

        @if ($has_login)
            @include('admin.dashboard.components.sidebar')
        @endif

        @php
            
            $login_class = $has_login ? '' : 'login-page';
            
        @endphp

        <div class="custom-modal" id="logout-modal">
            <div class="background"></div>

            <div class="content default-space-between">

                <div class="custom-modal-body">
                    <h2 class="title">Fazer logout</h2>
                    <p>Deseja encerrar sua sessão nesse navegador?</p>

                    <div class="actions d-flex align-items-center mt-5">
                        <form style="width: 100%;" action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button style="max-width: 100%;" class="btn-geral btn-blue w-100">Sair</button>
                        </form>
                        <button style="max-width: 100%;" class="btn-geral w-100 btn-green ml-2"
                            onclick="closeModal('logout-modal')">Cancelar</button>
                    </div>
                </div>

            </div>

        </div>

        <div class="content-wrap {{ $login_class }} ">

            @if ($has_login)
                <nav class="header-nav first-top-padding">

                    <div class='user-actions'>

                        <a class='nav-mobile-logo' href="{{ route('dashboard') }}"
                            title="{{ config('app.name') }} Logo">
                            <img src="{{ url('/img/logo-white.svg') }}" alt="{{ config('app.name') }} | Admin">
                        </a>
                        <div class='user-actions'>
                            <div class='dropdown'>

                                <a class='geral-text bold' href='#' title=' ' type='button' id="dropdownAdminMenu"
                                    data-bs-toggle="dropdown" aria-expanded="false">{{ $admin_shared->name }} <span
                                        class="iconify" data-icon="feather:chevron-down"></span>
                                </a>

                                <div class='dropdown-menu' aria-labelledby='dropdownAdminMenu'>
                                    <ul>
                                        <li><a title='Dados pessoais' class='geral-text white-color'
                                                href='{{ route('admin.edit', ['id' => $admin_shared->id]) }}'> <span
                                                    class="iconify"
                                                    data-icon="carbon:user-avatar-filled"></span>Dados pessoais</a></li>
                                        {{-- <li><a title='Logs' class='geral-text white-color user-logout' href='{{$urlDashboard}}/lista-logs'><span class="iconify" data-icon="zmdi:shield-security"></span> Logs</a></li> --}}
                                        <li><a title='Logout' class='geral-text white-color user-logout'
                                                onclick='openModal("logout-modal")' href="#"><span
                                                    class="iconify" data-icon="feather:log-out"></span>
                                                Logout</a></li>
                                    </ul>
                                </div>

                            </div>

                            <div class="nav-toggle">
                                <button class="nav-button" aria-label="Abrir menu mobile">
                                    <span class="span-menu"></span>
                                    <span class="span-menu"></span>
                                    <span class="span-menu"></span>
                                </button>
                            </div>

                        </div>

                </nav>
            @endif

            <div class="content-file default-space-between {{ $login_class }}">
                @yield('content')
            </div>
        </div>

    </main>

    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <!-- Plugins -->
    <script src="{{ url('lib/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('lib/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

    <!-- Admins Scripts -->
    @vite(['resources/assets/js/admin/index.js'])
</body>

</html>
