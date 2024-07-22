<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('project/clipboard-project.png') }}">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon  -->
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>

    <!-- Fonts Family Kanit -->
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Grid JS -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" />
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">

    @stack('links')
    <style>
        body {
            font-family: "Kanit", sans-serif;
            font-size: 14px;
            background-color: #efefef7a;
        }

        /* @media only screen and (max-width: 600px) {}

        @media only screen and (min-width: 600px) {} */
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
    <div class="container-lg">
        <div class="main">
            <main class="content">
                @yield('content')
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

    @stack('script')
</body>

</html>
