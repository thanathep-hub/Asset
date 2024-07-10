<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('imges/linux.png') }}">

    {{-- <title> </title> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- IonIcons -->
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    <!-- DataTables -->
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>

    <style>
        @media only screen and (max-width: 576px) {
            .navbar-light .navbar-nav .nav-link {
                color: white;
            }

            .navbar-white {
                background-color: #343b41;
            }

            .menu-bar {
                transition-duration: .2s;
                border: none;
                color: rgb(241, 241, 241);
                cursor: pointer;
                font-weight: 600;
                /* box-shadow: 0 4px 6px -1px #977ef300, 0 2px 4px -1px #977ef396; */
                transition: all .6s ease;
            }
        }
    </style>
    @stack('css')
</head>
<!--
`body` tag options:

Apply one or more of the following classes to to the body tag
to get the desired effect

* sidebar-collapse
* sidebar-mini
-->

<body class="hold-transition sidebar-mini"
    style="font-size: 15px;

        /* background: radial-gradient(rgb(210,241,223),rgb(211,215,250),rgb(186,216,244)) 0% 0%/400% 400%; */
        ">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper"> {{-- style="background-color: #dbdbd9a3;" --}}

            <!-- Main content -->
            @yield('content')

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        {{-- @include('layouts.footer') --}}
    </div>
    <!-- ./wrapper -->

    @include('sweetalert::alert')

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    <script>
        $('.logout-swal').on('click', function() {
            Swal.fire({
                title: "คุณต้องการออกจากระบบหรือไม่?",
                // text: "You won't be able to revert this!",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#016b4e",
                cancelButtonColor: "#6e7980",
                // confirmButtonText: "ออกจากระบบ",

                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ออกจากระบบ"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "กำลังออกจากระบบ",
                        // text: "Your file has been deleted.",
                        icon: "success"
                    });
                    Swal.showLoading()
                    return new Promise((resolve) => {
                        setTimeout(() => {
                            resolve(true)
                        }, 2000)
                    }).then(() => {
                        document.location.href = '/logout';
                    })

                }
            });
        })
    </script>

    @stack('scripts')

</body>

{{-- @stack('scripts') --}}

</html>
