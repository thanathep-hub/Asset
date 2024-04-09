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
            max-width: 600px;
            /* background-color: aquamarine; */
            margin-left: auto;
            margin-right: auto;
        }

        .container-custom {
            margin-top: 2rem;
            max-width: 600px;
        }

        .content-app {
            background-color: #fff;
            margin-top: 8rem;
        }

        .row {
            --bs-gutter-x: unset;
        }

        .logo-tawanyim {
            box-shadow: 0px 3px 3px 0px #01653c29;
            border-radius: 100%;
        }

        .btn-user,
        .btn-admin {
            color: #fff;
            background-color: #00643c;
            font-size: 18px;
            font-weight: 700;
            padding: 10px 20px;
            border-radius: 24px;
        }

        a {
            color: unset;
            background-color: unset;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
        }

        .btn-user:hover,
        .btn-admin:hover,
        .btn-user:active,
        .btn-admin:active,
        a:hover,
        a:active {
            color: #fff;
            background-color: #4c8b66;
        }
    </style>
</head>

<body style="margin: revert;">
    <div class="container-custom">
        <div class="content-app">
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <img src="images/logoyim.png" class="img-fluid logo-tawanyim mb-4 shadow" alt="โลโก้">
                    <a href="/drink" class="btn me-2 col-12 m-2 btn-user">สั่งเครื่องดื่ม</a>
                    <a href="/drink/admin" class="btn col-12 m-2 btn-admin" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">แอดมิน</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('connect_admin') }}" method="get">
                        @csrf
                        @method('get')
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label"
                                style="font-size:small;font-weight:700;">Code :</label>
                            <input type="text" class="form-control" id="code" name="code">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="width: 207px;">ยืนยัน</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script></script>
</body>

</html>
