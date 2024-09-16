<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Asset</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            font-family: "Kanit", sans-serif;
            box-sizing: border-box;
            margin: 0;
            background-color: #f9fafb;
        }

        .container {
            height: 100dvh;
            align-content: center;
        }

        .row {
            justify-content: center;
        }

        .card {
            width: 400px;
        }

        @media (max-width: 600px) {
            .card {
                width: 90%;
            }
        }

        .btn-login {
            background-color: #4F46E5;
            border: #4F46E5;
        }

        .feedback {
            color: #003fb1 !important;
            font-weight: 500;
        }

        /* loading css */
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

        /* /loading css */
    </style>
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
    <div class="container">
        <div class="row">
            <div class="card p-4 shadow-lg border-0">
                <div class="image-logo text-center mb-3">
                    <img src="{{ asset('imges/asset-logo.png') }}" alt="" height="100px">
                </div>
                <form method="get" action="/checkLogin">
                    @csrf
                    <div class="title mb-3 border-bottom">
                        <h5 style="color:#003fb1;font-weight: bold;">เข้าสู่ระบบด้วย ERP</h5>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="user" name="user"
                            placeholder="รหัสผู้ใช้">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="รหัสผ่าน">
                    </div>
                    <div class="feedback mb-3 text-end">
                        <a href="#" class="feedback" style="font-size: 14px;">หากพบปัญหาติดต่อฝ่ายไอที</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 btn-login"
                        style="font-weight: bold;">เข้าสู่ระบบ</button>
                </form>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function actionLoading() {
            document.getElementById('loadingWait')?.classList.remove('d-none');
            document.getElementById('loadingWait')?.classList.add('d-flex');
        }
    </script>
</body>

</html>
