<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- <link rel="shortcut icon" href="{{ asset('image/iconWeb.ico') }}"> --}}
    <title>LOGIN</title>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 20px;
            padding-bottom: 40px;
        }

        .form-signin {
            width: 100%;
            max-width: 424px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            /* margin-bottom: -1px; */
        }

        .form-signin input[type="password"] {
            /* margin-bottom: 10px; */
        }
    </style>

</head>

{{-- <body style="background: radial-gradient(rgb(210,241,223),rgb(211,215,250),rgb(186,216,244)) 0% 0%/400% 400%;"> --}}

<body
    style="background-image: url('https://cdn.pixabay.com/photo/2023/03/26/11/40/woman-7878192_1280.jpg');background-size: cover;
    background-position: center;backdrop-filter: blur(5px);">
    <div class="form-signin">
        <div class="card">
            <div class="card-body">
                <form method="get" action="/checkLogin">
                    @csrf
                    <div class="mb-3" style="text-align: center;">
                        <img src="{{ asset('imges/logo-login.png') }}" style="width: 160px;height:80px;">
                        {{-- <h4 class="fw-bold mb-3 pt-3 text-start" style="color: #446f9f;font-size:1.25rem;">
                            เข้าสู่ระบบด้วยรหัส
                            ERP</h4> --}}
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">รหัสผู้ใช้</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                    <path
                                        d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12z" />
                                </svg>
                            </span>
                            <input type="text" class="form-control" id="user" name="user" placeholder=""
                                autofocus="autofocus" required>
                        </div>

                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">รหัสผ่าน</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5" />
                                </svg>
                            </span>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="********" required>
                        </div>

                    </div>

                    <button type="submit" class="fw-bold w-100 btn btn-md"
                        style="background-color: #198754;color:white;">เข้าสู่ระบบ
                    </button>
                </form>
            </div>
        </div>

    </div>
    @include('sweetalert::alert')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
