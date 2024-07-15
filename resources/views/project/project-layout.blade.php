<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="">

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

    @stack('links')
    <style>
        body {
            font-family: "Kanit", sans-serif;
            font-size: 14px;
            background-color: #efefef7a;
        }

        /* @media only screen and (max-width: 600px) {}

        @media only screen and (min-width: 600px) {} */
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

    <!-- Grid JS -->
    {{-- <script src="https://unpkg.com/jquery/dist/jquery.min.js"></script> --}}
    <script src="https://unpkg.com/gridjs-jquery/dist/gridjs.production.min.js"></script>

    @stack('script')
</body>

</html>
