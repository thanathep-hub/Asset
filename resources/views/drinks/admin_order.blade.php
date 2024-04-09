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
            margin: auto;
            max-width: 600px;
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
    </style>
</head>

<body>

    <div class="container-custom" style="margin-top: 2rem; height: 100vh;max-width: 600px;">
        <div style="text-align: center;">
            <img src="{{ asset('images/checked.png') }}" width="20%" height="20%">
        </div>
        <div style="text-align: center;margin:1rem;">
            <h6 class="fw-900">คำสั่งซื้อ</h6>
            <label style="width:100%;font-weight: bold;font-size: 12px;">
                #{{ $dataOrder['order']->OrderID }} วันที่
                {{ \Carbon\Carbon::parse($dataOrder['order']->OrderConfirmTime)->addYears(543)->format('d-m-Y') }}
                เวลา
                {{ $dataOrder['order']->OrderConfirmTime->format('H:i') }}น.
            </label>
            <label style="width:100%;text-align: start;font-weight: bold;font-family: math;font-size: smaller">
                ผู้ทำรายการ: {{ $dataOrder['order']->CustomerName }}
            </label>

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
                    @forelse ($dataOrder['orderDetails'] as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-start"
                            style="margin: unset;">
                            <div class="ms-2 me-auto" style="font-size: 13px;">
                                <div class="fw-bold" style="text-align: start;">{{ $item->DrinkItem }}</div>
                                <p style="font-family: math;font - size: smaller; font - weight: 700; color: darkgray;">
                                    {{ $item->Type }}, {{ $item->Sweetness }}%, {{ $item->CupSize }}, ราคา
                                    {{ $item->TotalPrice }}฿
                                <p>
                            </div>
                            <span class="badge rounded-pill"
                                style="background-color: #2d7df1;">{{ $item->Quantity }}</span>
                        </li>
                    @empty
                    @endforelse
                    {{-- <li class="list-group-item d-flex justify-content-between align-items-start" style="margin: unset;">
                        <div class="ms-2 me-auto" style="font-size: 13px;">
                            <div class="fw-bold" style="text-align: start;">คาปูชิโน่</div>
                            <p style="font-family: math;font - size: smaller; font - weight: 700; color: darkgray;">
                                เย็น, 50%, ปกติ, ราคา 25฿
                            <p>
                        </div>
                        <span class="badge rounded-pill" style="background-color: #2d7df1;">1</span>
                    </li> --}}
                </ol>
            </div>

            <label class="fw-900 totalAll_f" id="menuLabel" style="font-size: 14px;">*หมายเหตุ :
                {{ $dataOrder['order']->note }}
            </label>

            <label class="fw-900 totalAll" id="menuLabel">
                <label id="totalPrice">รวมราคา {{ $dataOrder['order']->TotalPrice }} บาท</label>
            </label>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('back_to_drink') }}" type="button" class="btn btn-success"
                style="color: #ffffff;">กลับสู่หน้าแรก</a>
        </div>

        @if ($dataOrder['sts'] === true)
            <div class="modal fade" id="sts" tabindex="-1" aria-labelledby="sts" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body" id="stsStatus">
                            <h5>ทำรายการซ้ำ</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sts').modal('show');
        });
    </script>
</body>

</html>
