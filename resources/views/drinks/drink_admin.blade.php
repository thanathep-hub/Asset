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
            /* margin-left: auto; */
            /* margin-right: auto; */
        }
        body{
            padding-right: 8px;
        }
        /* ----------------------------------------------------------------------- */
        .container-customize {
            box-sizing: border-box;
            max-width: 600px;
            /* background-color: aquamarine; */
            margin-left: auto;
            margin-right: auto;
        }


        /* --------------------------------------------------------------------------- */
        /* -------------------------------------------------------------------- */
        .nav-admin {
            position: fixed;
            top: 0px;
            width: 100%;
            border-bottom: 1px solid #21252914;
            /* border-bottom: 1px solid #D2C6B9; */
            height: 60px;
        }

        .bg-nav {
            /* background-color: #fbf1dc; */
            box-shadow: 0 0.5rem 1rem #21252914;
        }

        .btn {
            --bs-btn-border-width: unset;
        }

        .btn-nav:focus,
        .btn-nav:active,
        .btn-nav:hover {
            background-color: #00d78057;
            /*  */
        }

        .btn-nav-svg {
            height: 24px;
            fill: #00643c;
        }

        /* -------------------------------------------------------------------- */
        .menu-admin {
            position: fixed;
            text-align: -webkit-center;
            bottom: 5px;
            padding: 4px 5px;
            width: 100%;
        }

        .btn-menu {
            border-radius: 24px;
            font-weight: 700;
            /* box-shadow: 0 2px 5px 1px #403c4329; */
            color: #000;
            /* background-color: #00643c */
        }

        .btn-menu:hover,
        .btn-menu:focus,
        .btn-menu:active {
            outline: none !important;
            box-shadow: none;
            border: unset;
            /*  */
            background-color: #00d78057;
        }

        .btn-menu-active {
            background-color: #00d78057;
        }

        .text-menu-buttom {
            margin: unset;
        }

        .card-menu {
            border-radius: 22px;
            width: max-content;
            background-color: #fff;
            box-shadow: 0 0.5rem 1rem #21252987;
        }

        .svg-admin {
            fill: #00643c;
            height: 24px;
            width: 24px;
        }
    </style>
</head>

<body>
    <div class="nav-admin position-fixed bg-white" style="z-index: 999;">
                    <div class="d-flex align-items-center justify-content-between" style="padding: 0rem 1rem;height: -webkit-fill-available;">
                        <button class="btn btn-nav" onclick="back()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-left btn-nav-svg"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                            </svg>
                        </button>
                        <div class="tree-dots">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-three-dots-vertical btn-nav-svg"
                                viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>
                        </div>
                    </div>
            </div>

    {{-- <div class="body"> --}}
        <div class="body">
        <div class="container-customize">

            {{-- <div class="nav-admin position-fixed bg-white">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between" style="padding: 0rem 1rem;">
                        <button class="btn btn-nav" onclick="back()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-left btn-nav-svg"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                            </svg>
                        </button>
                        <div class="tree-dots">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-three-dots-vertical btn-nav-svg"
                                viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- ------------------------------------------------------------- --}}

            @include('drinks.drink_admin_content')
            @include('drinks.drink_admin_content_product')
            @include('drinks.drink_admin_history')

            {{-- ------------------------------------------------------------- --}}
            <div class="menu-admin position-fixed bottom-0 start-50 translate-middle-x">
                <div class="row justify-content-center card-menu" style="padding: 3px 0px;">
                    <div class="bottom-menu">
                        <button class="btn btn-menu me-2 btn-menu-active" onclick="showMenu('show_order')">
                            <svg class="svg-admin" xmlns="http://www.w3.org/2000/svg" class="bi bi-cup-hot"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M.5 6a.5.5 0 0 0-.488.608l1.652 7.434A2.5 2.5 0 0 0 4.104 16h5.792a2.5 2.5 0 0 0 2.44-1.958l.131-.59a3 3 0 0 0 1.3-5.854l.221-.99A.5.5 0 0 0 13.5 6zM13 12.5a2 2 0 0 1-.316-.025l.867-3.898A2.001 2.001 0 0 1 13 12.5M2.64 13.825 1.123 7h11.754l-1.517 6.825A1.5 1.5 0 0 1 9.896 15H4.104a1.5 1.5 0 0 1-1.464-1.175" />
                                <path
                                    d="m4.4.8-.003.004-.014.019a4 4 0 0 0-.204.31 2 2 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.6.6 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3 3 0 0 1-.202.388 5 5 0 0 1-.253.382l-.018.025-.005.008-.002.002A.5.5 0 0 1 3.6 4.2l.003-.004.014-.019a4 4 0 0 0 .204-.31 2 2 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.6.6 0 0 0-.09-.252A4 4 0 0 0 3.6 2.8l-.01-.012a5 5 0 0 1-.37-.543A1.53 1.53 0 0 1 3 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a6 6 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 4.4.8m3 0-.003.004-.014.019a4 4 0 0 0-.204.31 2 2 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.6.6 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3 3 0 0 1-.202.388 5 5 0 0 1-.253.382l-.018.025-.005.008-.002.002A.5.5 0 0 1 6.6 4.2l.003-.004.014-.019a4 4 0 0 0 .204-.31 2 2 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.6.6 0 0 0-.09-.252A4 4 0 0 0 6.6 2.8l-.01-.012a5 5 0 0 1-.37-.543A1.53 1.53 0 0 1 6 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a6 6 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 7.4.8m3 0-.003.004-.014.019a4 4 0 0 0-.204.31 2 2 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.6.6 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3 3 0 0 1-.202.388 5 5 0 0 1-.252.382l-.019.025-.005.008-.002.002A.5.5 0 0 1 9.6 4.2l.003-.004.014-.019a4 4 0 0 0 .204-.31 2 2 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.6.6 0 0 0-.09-.252A4 4 0 0 0 9.6 2.8l-.01-.012a5 5 0 0 1-.37-.543A1.53 1.53 0 0 1 9 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a6 6 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 10.4.8" />
                            </svg>
                            <p class="text-menu-buttom">ออเดอร์</p>
                        </button>
                        <button class="btn btn-menu me-2" onclick="showMenu('show_menu_product')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-card-list svg-admin"
                                viewBox="0 0 16 16">
                                <path
                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                <path
                                    d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                            </svg>
                            <p class="text-menu-buttom">เมนู</p>
                        </button>
                        <button class="btn btn-menu me-2" onclick="showMenu('show_history')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-clipboard-data svg-admin"
                                viewBox="0 0 16 16">
                                <path
                                    d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z" />
                                <path
                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                <path
                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                            </svg>
                            <p class="text-menu-buttom">ประวัติ</p>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            hideAllMenu();
            document.getElementById('show_order').style.display = 'block';
        });

        function back() {
            window.location.href = '/drink_home';
        }

        const buttons = document.querySelectorAll('.btn-menu');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                buttons.forEach(btn => {
                    btn.classList.remove('btn-menu-active'); // ลบ class 'active' ที่ปุ่มอื่น ๆ
                });
                this.classList.add('btn-menu-active'); // เพิ่ม class 'active' ที่ปุ่มที่ถูกคลิก
            });
        });

        async function showMenu(val) {
            await hideAllMenu();
            document.getElementById(val).style.display = 'block';
        }

        async function hideAllMenu() {
            console.log("hide all");
            document.getElementById('show_order').style.display = 'none';
            document.getElementById('show_menu_product').style.display = 'none';
            document.getElementById('show_history').style.display = 'none';
        }
    </script>
</body>

</html>
