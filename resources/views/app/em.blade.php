<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="csrf-token" content="{{ csrf_token }}"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('imges/logo-login.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="true"></script> --}}
    <script src="https://kit.fontawesome.com/ce56e0f8fa.js" crossorigin="anonymous"></script>

    <!-- Fonts Family Kanit -->
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    {{-- grid js --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" />

    @stack('links')
    <style>
        body {
            box-sizing: border-box;
            font-family: "Kanit", sans-serif;
            font-size: 14px;
            /* background-color: #d3eaef; */
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


        /* loading css */

        .alert {
            --bs-alert-padding-y: 0.5rem;
        }

        .feedback {
            color: #2f6db2;
            text-align: end;
        }

        .d-flex {
            display: flex !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .h-100 {
            height: 100vh !important;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .bg-blue {
            background-color: #1D4ED8;
            /* Equivalent to Tailwind's bg-blue-700 */
        }

        .rounded-full {
            border-radius: 50%;
        }

        .bounce {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-30px);
            }

            60% {
                transform: translateY(-15px);
            }
        }

        .delay-1 {
            animation-delay: -0.3s;
        }

        .delay-2 {
            animation-delay: -0.5s;
        }

        .w-4.h-4.bg-blue.rounded-full.bounce {
            width: 16px;
            /* Updated to 16px */
            height: 16px;
            /* Updated to 16px */
        }

        .absolute {
            position: absolute;
        }

        .bg-white {
            background-color: white;
        }

        .bg-opacity-60 {
            opacity: 0.6;
        }

        .z-10 {
            z-index: 10;
        }

        .h-full {
            height: 100%;
        }

        .w-full {
            width: 100%;
        }


        /* loading css */
    </style>
    @stack('style')
</head>

<body>
    <div class="absolute bg-white bg-opacity-60 z-10 h-full w-full justify-content-center align-items-center d-none"
        id="loadingWait">
        <div class="d-flex flex-row gap-2">
            <div class="w-4 h-4 bg-blue rounded-full bounce"></div>
            <div class="w-4 h-4 bg-blue rounded-full bounce delay-1"></div>
            <div class="w-4 h-4 bg-blue rounded-full bounce delay-2"></div>
        </div>
    </div>
    <div class="wrapper">
        <div class="main">
            <main class="content" style="height: 100vh;">
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
    @stack('script')
</body>

</html>
