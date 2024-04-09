<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ตะวันยิ้ม</title>
    <link rel="icon" href="{{ asset('images/logoyim.png') }}" type="image/icon type">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        * {
            box-sizing: border-box;
            /* max-width: 600px; */
            /* background-color: aquamarine; */
            /* margin-left: auto;
            margin-right: auto; */
        }

        .container-custom {
            max-width: 600px;
            /* background-color: aquamarine; */
            margin-left: auto;
            margin-right: auto;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-style: unset;
        }

        .topic {
            color: #ffffff;
            cursor: pointer;
        }

        /* .active {
            border-bottom: 3px solid #68dec6eb;
        } */

        .menu-list {
            padding-top: 14px;
            padding-bottom: 14px;
        }

        .menu-list:first-child {
            border-top: 1px solid #D2C6B9;
        }

        .topic:hover {
            border-bottom: 3px solid #68dec6eb;
            /* color: #44dbbd; */
            color: #68dec6eb;
            transition: 0.1ms;
        }

        .fw-900 {
            font-weight: 900;
        }

        .container-content {
            /* max-width: 600px; */
            margin-left: auto;
            margin-right: auto;
            box-sizing: border-box;
        }

        .container-fluid {
            margin-top: 1rem;
        }

        .header {
            width: -webkit-fill-available;
            text-align: center;
        }

        .cart {
            position: fixed;
            bottom: 14px;
            right: 14px;
            color: white;
            padding: 5px;
        }

        .animate-bottom {
            position: relative;
            animation: animatebottom 0.4s;
        }

        @keyframes animatebottom {
            from {
                bottom: -300px;
                opacity: 0;
            }

            to {
                bottom: 0;
                opacity: 1;
            }
        }

        .color-green {
            color: #04764e;
        }

        .form-check-input:checked {
            background-color: #04764e;
            border-color: #04764e;
        }
    </style>
</head>

<body>
    <div class="container-custom">
        @include('drinks.nav')

        @include('drinks.menu')

        @include('drinks.cart')
        {{-- @include('drinks.success') --}}


    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script></script>
</body>

</html>
