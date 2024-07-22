<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/car2.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>

    <!-- Fonts Family Kanit -->
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    @stack('links')
    <style>
        body {
            box-sizing: border-box;
            font-family: "Kanit", sans-serif;
            font-size: 14px;
            background-color: #d3eaef;
            opacity: 1;
            overflow-y: scroll;
            margin: 0;
        }

        /* font  */

        .kanit-thin {
            font-family: "Kanit", sans-serif;
            font-weight: 100;
            font-style: normal;
        }

        .kanit-extralight {
            font-family: "Kanit", sans-serif;
            font-weight: 200;
            font-style: normal;
        }

        .kanit-light {
            font-family: "Kanit", sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        .kanit-regular {
            font-family: "Kanit", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .kanit-medium {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        .kanit-semibold {
            font-family: "Kanit", sans-serif;
            font-weight: 600;
            font-style: normal;
        }

        .kanit-bold {
            font-family: "Kanit", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        .kanit-extrabold {
            font-family: "Kanit", sans-serif;
            font-weight: 800;
            font-style: normal;
        }

        .kanit-black {
            font-family: "Kanit", sans-serif;
            font-weight: 900;
            font-style: normal;
        }

        .kanit-thin-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 100;
            font-style: italic;
        }

        .kanit-extralight-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 200;
            font-style: italic;
        }

        .kanit-light-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 300;
            font-style: italic;
        }

        .kanit-regular-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 400;
            font-style: italic;
        }

        .kanit-medium-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: italic;
        }

        .kanit-semibold-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 600;
            font-style: italic;
        }

        .kanit-bold-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 700;
            font-style: italic;
        }

        .kanit-extrabold-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 800;
            font-style: italic;
        }

        .kanit-black-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 900;
            font-style: italic;
        }

        li {
            list-style: none;
        }


        .form-control {
            font-size: 14px;
        }

        /* Layout for admin dashboard skeleton */

        .wrapper {
            align-items: stretch;
            display: flex;
            width: 100%;
        }

        #sidebar {
            max-width: 264px;
            min-width: 264px;
            background-color: #fff;
            transition: all 0.35s ease-in-out;
        }

        .main {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-width: 0;
            overflow: hidden;
            transition: all 0.35s ease-in-out;
            width: 100%;
            /* background: var(--bs-dark-bg-subtle); */
            background-color: #fff;
        }

        /* Sidebar Elements Style */

        .sidebar-logo {
            text-align: center;
            padding: 1.15rem 0;
        }

        .sidebar-logo a {
            color: #6d6d6d;
            font-size: 1.15rem;
            font-weight: 600;
        }

        .sidebar-nav {
            flex-grow: 1;
            list-style: none;
            margin-bottom: 0;
            padding-left: 0;
            margin-left: 0;
        }

        .sidebar-header {
            color: #6d6d6d;
            font-size: .75rem;
            /* font-size: 1rem; */
            padding: 1.5rem 1.5rem .375rem;
        }

        a.sidebar-link {
            padding: .625rem 1.625rem;
            color: #6d6d6d;
            position: relative;
            display: block;
            font-size: 0.875rem;
            /* font-size: 1rem; */
        }

        .sidebar-link[data-bs-toggle="collapse"]::after {
            border: solid;
            border-width: 0 .075rem .075rem 0;
            content: "";
            display: inline-block;
            padding: 2px;
            position: absolute;
            right: 1.5rem;
            top: 1.4rem;
            transform: rotate(-135deg);
            transition: all .2s ease-out;
        }

        .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
            transform: rotate(45deg);
            transition: all .2s ease-out;
        }

        .avatar {
            height: 32px;
            width: 32px;
        }

        .navbar-expand .navbar-nav {
            margin-left: auto;
        }

        .content {
            flex: 1;
            max-width: 100vw;
            width: 100vw;
        }

        @media (min-width:768px) {
            .content {
                max-width: auto;
                width: auto;
            }
        }

        .card {
            box-shadow: 0 0 .875rem 0 rgba(34, 46, 60, .05);
            margin-bottom: 24px;
        }

        /* Sidebar Toggle */

        #sidebar.collapsed {
            margin-left: -264px;
        }

        /* Footer and Nav */

        @media (max-width:767.98px) {

            .js-sidebar {
                margin-left: -264px;
            }

            #sidebar.collapsed {
                margin-left: 0;
            }

            .navbar,
            footer {
                width: 100vw;
            }
        }

        /*  */

        /* loading css */

        .loader {
            --s: 20px;

            --_d: calc(0.353*var(--s));
            width: calc(var(--s) + var(--_d));
            aspect-ratio: 1;
            display: grid;
        }

        .loader:before,
        .loader:after {
            content: "";
            grid-area: 1/1;
            clip-path: polygon(var(--_d) 0, 100% 0, 100% calc(100% - var(--_d)), calc(100% - var(--_d)) 100%, 0 100%, 0 var(--_d));
            background:
                conic-gradient(from -90deg at calc(100% - var(--_d)) var(--_d),
                    #ecfdf5 135deg, #047857 0 270deg, #6ee7b7 0);
            animation: l6 2s infinite;
        }

        .loader:after {
            animation-delay: -1s;
        }

        @keyframes l6 {
            0% {
                transform: translate(0, 0)
            }

            25% {
                transform: translate(30px, 0)
            }

            50% {
                transform: translate(30px, 30px)
            }

            75% {
                transform: translate(0, 30px)
            }

            100% {
                transform: translate(0, 0)
            }
        }

        /* loading css */
    </style>
    @stack('style')
</head>

<body>
    <div class="modal fade" id="show-modal-loading" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false" style="align-content: center;
    margin-top: -5rem;">
        <div class="modal-dialog" style="text-align: -webkit-center;">
            <div class="loader"></div>
        </div>
    </div>
    <div class="wrapper">
        @include('app.sidebar')
        <div class="main">
            @include('app.navbar')
            <main class="content" style="height: 100vh;background-color:#d6dce8;">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>

    <!-- Grid JS -->
    {{-- <script src="https://unpkg.com/jquery/dist/jquery.min.js"></script> --}}
    <script src="https://unpkg.com/gridjs-jquery/dist/gridjs.production.min.js"></script>
    @stack('scripts')
    <script>
        const sidebarToggle = document.querySelector("#sidebar-toggle");
        sidebarToggle.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });
    </script>
</body>

</html>
