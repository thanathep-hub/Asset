<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ตะวันยิ้ม</title>
    <link rel="icon" href="{{asset('images/logoyim.png')}}" type="image/icon type">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #fff;
            box-sizing: border-box;
        }

        .fw-900 {
            font-weight: 900;
        }

        .container-content {
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            box-sizing: border-box;
            margin-top: 7rem;height: 100vh
        }

        .container-fluid {
            margin-top: 1rem;
        }

        .header {
            width: -webkit-fill-available;
            text-align: center;
            color: gainsboro;
            border-bottom: 5px solid rgb(49, 49, 49);
        }
    </style>
</head>

<body>
<div class="container-content">

    <div class="modal-header">
                <h1 class="modal-title fs-5 fw-900" id="menuLabel" style="color: whitesmoke">
                    {{--                    --}}
                </h1>
                <button type="button" class="btn fw-900" data-bs-dismiss="modal"
                    style="
                  background-color: white;
                  color: black;
                  border-radius: 24px;
                ">
                    ✕
                </button>
            </div>


</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script></script>
</body>

</html>
