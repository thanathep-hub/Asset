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
        }

        body {
            background-color: #ffffff;
            box-sizing: border-box;
        }

        .fw-900 {
            font-weight: 900;
        }

        .color-wsm {
            color: whitesmoke;
        }

        .color-green {
            color: #04764e;
        }

        .cartQuantity {
            position: fixed;
            bottom: 50px;
            right: 28px;
            color: white;
            background-color: tomato;
            border-radius: 14px;
        }

        .list-group-item {
            border-left: unset;
            border-right: unset;
            border-radius: unset;
            font-weight: 700;
        }

        .list-group-item:first-child {
            font-weight: 700;
            border-top: unset;
        }

        .list-group-item:last-child {
            font-weight: 700;
            border-bottom: unset;
        }

        .listCart {
            font-weight: 700;
        }

        .totalAll_f {
            margin-top: 0.25rem;
            padding-top: 0.25rem;
            color: #000000a8;
            margin-bottom: 0.25rem;
            font-size: 15px;
            width: 100%;
            text-align: start;
            font-weight: bolder;
        }

        .totalAll {
            margin-top: 0.25rem;
            padding-top: 0.25rem;
            border-top: 1px solid lightgray;
            color: #000000a8;
            margin-bottom: 0.25rem;
            font-size: 15px;
            width: 100%;
            text-align: start;
            font-weight: bolder;
        }
    </style>
</head>

<body>
    <div class="container-custom" style="margin-top: 2rem; height: 100vh;max-width: 600px;">
        @if (session('orderID'))
            <div style="text-align: center;">
                <img src="{{ asset('images/checked.png') }}" width="20%" height="20%">
            </div>
            <div style="text-align: center;margin:1rem;">
                <h6 class="fw-900">คำสั่งซื้อ</h6>
                <label style="width:100%;font-weight: bold;
    font-size: 12px;">#{{ session('orderID') }}</label>
                <label
                    style="width:100%;text-align: start;
    font-weight: bold;font-family: math;
    font-size: smaller">ผู้ทำรายการ
                    :
                    {{ session('customerSS') }}</label>

                <label class="fw-900" id="menuLabel"
                    style="
                       margin-top: 0.25rem;
                       padding-top: 0.25rem;
                       border-top: 1px solid lightgray;
                  color: black;
                  margin-bottom: 0.25rem;
                  font-size: small;
                  width: 100%;
                  text-align: start;
                ">รายการเครื่องดื่ม</label>
                {{-- {{ session('cartSS') }} --}}
                <div id="listCart">
                    <ol class="list-group list-group-numbered" id="listCartAndDetails">
                        @if (session()->has('cartSS'))
                            @foreach (session('cartSS') as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto" style="font-size: 13px;">
                                        <div class="fw-bold" style="text-align: start;">{{ $item['nameProduct'] }}
                                        </div>
                                        <p
                                            style="font-family: math;font - size: smaller; font - weight: 700; color: darkgray;">
                                            {{ $item['type'] }}, {{ $item['syrup'] }}%, {{ $item['size'] }}, ราคา
                                            {{ $item['price'] }}฿
                                        <p>
                                    </div>
                                    <span class="badge rounded-pill"
                                        style="background-color: #2d7df1;">{{ $item['quantity'] }}</span>
                                </li>
                            @endforeach
                        @else
                            {{-- Session 'cartSS' does not exist or is empty --}}
                            {{-- Handle the case when the session does not exist or is empty --}}
                        @endif

                    </ol>
                </div>

                <label class="fw-900 totalAll_f" id="menuLabel" style="font-size: 14px;">*หมายเหตุ :
                    @if (session()->has('note'))
                        <label>{{ session('note') }}</label>
                    @endif
                </label>

                <label class="fw-900 totalAll" id="menuLabel">รวมราคาสุทธิ
                    @if (session()->has('totalSS'))
                        <label>{{ session('totalSS') }}</label>
                    @endif
                    <label>บาท</label>
                </label>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('back_to_drink') }}" type="button" class="btn btn-success"
                    style="color: #ffffff;">กลับสู่หน้าหลัก</a>
            </div>

    </div>
    @endif
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script></script>
</body>

</html>
