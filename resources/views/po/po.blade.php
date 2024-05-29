<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PO</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/checklist.png') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        body {
            /* font-family: 'Kanit', sans-serif; */
            /* font-size: 1rem; */
            opacity: 1;
            overflow-y: scroll;
            margin: 0;
            font-family: "Kanit", sans-serif;
            font-size: 14px;
        }

        .kanit-thin {
            font-family: "Kanit", sans-serif;
            font-weight: 100;
            font-style: normal;
        }

        .kanit-extralight {
            font-family: "Kanit", sans-serif;
            font-weight: 200;
            font-style: normal;
        }

        .kanit-light {
            font-family: "Kanit", sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        .kanit-regular {
            font-family: "Kanit", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .kanit-medium {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        .kanit-semibold {
            font-family: "Kanit", sans-serif;
            font-weight: 600;
            font-style: normal;
        }

        .kanit-bold {
            font-family: "Kanit", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        .kanit-extrabold {
            font-family: "Kanit", sans-serif;
            font-weight: 800;
            font-style: normal;
        }

        .kanit-black {
            font-family: "Kanit", sans-serif;
            font-weight: 900;
            font-style: normal;
        }

        .kanit-thin-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 100;
            font-style: italic;
        }

        .kanit-extralight-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 200;
            font-style: italic;
        }

        .kanit-light-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 300;
            font-style: italic;
        }

        .kanit-regular-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 400;
            font-style: italic;
        }

        .kanit-medium-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: italic;
        }

        .kanit-semibold-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 600;
            font-style: italic;
        }

        .kanit-bold-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 700;
            font-style: italic;
        }

        .kanit-extrabold-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 800;
            font-style: italic;
        }

        .kanit-black-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 900;
            font-style: italic;
        }

        /* po */

        .stepper-wrapper {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;

            @media (max-width: 768px) {
                font-size: 12px;
            }
        }

        .stepper-item::before {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: -50%;
            z-index: 2;
        }

        .stepper-item::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 2;
        }

        .stepper-item .step-counter {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ccc;
            margin-bottom: 6px;
        }

        .stepper-item.active {
            font-weight: bold;
        }

        .stepper-item.completed .step-counter {
            background-color: #4bb543;
        }

        .stepper-item.completed::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #4bb543;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 3;
        }

        .stepper-item:first-child::before {
            content: none;
        }

        .stepper-item:last-child::after {
            content: none;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #005340;
            color: white;
            text-align: center;
            height: 40px;
            align-content: center;

        }

        .po-btn-accept {
            position: fixed;
            bottom: 60px;
            right: 22px;
            border-radius: 8px;
            color: #fff;
            width: 8rem;
            background-color: #2b9504;
        }

        .btn-item-ac {
            max-width: 120px;
        }

        .swal2-confirm {
            width: 6rem;
        }

        .swal2-cancel {
            width: 6rem;
        }

        button.swal2-cancel.swal2-styled.swal2-default-outline {
            color: #000;
        }
    </style>
</head>

<body>

    <div class="container-custom container" style="margin-bottom:7rem;">
        <div class="text-center mt-3 mb-3">
            <h6>Purchase Order : #{{ $po_mt->DocCode ?? '' }}</h6>
        </div>
        <div class="stepper-wrapper mt-3">
            <div class="stepper-item {{ $po_mt->idPsCheck ? 'completed' : '' }}">
                <div class="step-counter"><i class="fa-solid fa-check fa-xl" style="color: #fff;"></i></div>
                <div class="step-name">ตรวจสอบ</div>
            </div>
            <div class="stepper-item {{ $po_mt->idPsAccept ? 'completed' : '' }}
            ">
                <div class="step-counter"><i class="fa-solid fa-check fa-xl" style="color: #fff;"></i></div>
                <div class="step-name">รับทราบ</div>
            </div>
            <div class="stepper-item {{ $po_mt->idPsConfirm ? 'completed' : '' }}">
                <div class="step-counter"><i class="fa-solid fa-check fa-xl" style="color: #fff;"></i></div>
                <div class="step-name">อนุมัติ 1</div>
            </div>
            <div class="stepper-item {{ $po_mt->idPsConfirm2 ? 'completed' : '' }}">
                <div class="step-counter"><i class="fa-solid fa-check fa-xl" style="color: #fff;"></i></div>
                <div class="step-name">อนุมัติ 2</div>
            </div>
        </div>
        <div class="border-bottom mb-3"></div>
        <div class="d-flex justify-content-between">
            <div class="logo-comp ">
                <img src="http://203.151.27.229/spm/Center/Logo/{{ $po_mt->idComp }}.jpg" alt=""
                    style="width:60px;">
                <label for="">{{ $po_mt->CompName }}</label>
            </div>
            <div class="time ">
                <div id="date" class="text-end"></div>
                <div id="time" class="text-end"></div>
            </div>
        </div>

        <div class="text-center mt-3 mb-3">
            <h6>ใบสั่งซื้อ</h6>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <table class="table table-bordered tTableText">
                    <thead>
                        <tr>
                            {{-- <th style="font-size: 12px; text-align: center;width:50px;">ลำดับ</th> --}}
                            <th style="font-size: 12px; text-align: center;">จ่ายให้ Supplier</th>
                            <th style="font-size: 12px; text-align: center; width: 70px;">ภาษี ณ<br>ที่จ่าย</th>
                            <th style="font-size: 12px; text-align: center; width: 70px;">จำนวนเงิน<br>สุทธิ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height: auto;">
                            {{-- <td class="text-center">1</td> --}}
                            <td style="text-align: center;font-size: 12px;">{{ $po_mt->SupName }}</td>
                            <td style="text-align: right; font-size: 12px;"></td>
                            <td style="text-align: right; font-size: 12px;">
                                {{ number_format($po_mt->TotalNet, 2) ?? 0.0 }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right; font-size: 12px; font-weight: bold;" colspan="2">
                                รวมเป็นเงิน</td>
                            <td style="text-align: right; font-size: 12px; width: 70px; font-weight: bold;">
                                {{ number_format($po_mt->TotalNet, 2) ?? 0.0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @php
                $date = DateTime::createFromFormat('Ymd', $po_mt->DateBuy);
                $formattedDate = $date ? $date->format('d-m-Y') : 'Invalid date';
            @endphp

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <table class="table table-bordered tTableText">
                    <tbody>
                        <tr>
                            <td style="height: 30px; font-size: 12px;">
                                <p style="font-size: 12px;">PO No : {{ $po_mt->DocCode }}</p>
                                <p style="margin-top: -5px; font-size: 12px;">วันที่ใบสังซื้อ : {{ $formattedDate }}
                                </p>
                                <p style="margin-top: -5px; margin-bottom: -1px; font-size: 12px;">
                                    เลขที่ใบเสนอราคา : {{ $po_mt->QtCode }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table class="table table-bordered tTableText">
                    <thead>
                        <tr>
                            <th style="font-size: 12px; text-align: center;">#</th>
                            <th style="font-size: 12px; text-align: center;">รายการ</th>
                            <th style="width: 100px; font-size: 12px; text-align: center;">ราคาต้องการซื้อ</th>
                            <th style="width: 100px; font-size: 12px; text-align: center; width: 100px;">จำนวน
                            </th>
                            <th style="width: 100px; font-size: 12px; text-align: center; width: 100px;">รวมเป็นเงิน
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($po_dt as $index => $item)
                            <tr style="height: auto;">
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-start">{{ $item->InvName_ }}</td>
                                <td class="text-end">{{ number_format($item->InvPrice, 2) ?? 0 }}</td>
                                <td class="text-end">{{ number_format($item->AmountSub) ?? 0 }}</td>
                                <td class="text-end">{{ number_format($item->TotalPrice, 2) ?? 0.0 }}
                                </td>
                            </tr>
                        @empty
                        @endforelse


                        <tr>
                            <td class="text-center">*</td>
                            <td>
                                <strong>หมายเหตุ(Note) : </strong>{{ $po_mt->Note ?? '' }}
                            </td>
                            <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="2">
                                รวมเป็นเงิน :
                            </td>
                            <td style="text-align: right; font-size: 12px;">
                                <strong>{{ number_format($po_mt->TotalNet, 2) ?? 0.0 }}</strong>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <table class="table table-bordered" style="margin-top: -21px; background-color: #EEEEEE;">
                    <tbody>
                        <tr>
                            <td style="text-align: center; font-size: 12px; font-weight: bold;" id="bahtText">
                            </td>
                            <td style="text-align: right; font-size: 12px; width: 100px; font-weight: bold;">
                                {{ number_format($po_mt->TotalNet, 2) ?? 0.0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" style="margin-bottom: -10px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table class="table table-bordered tTableText">
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 100px;">
                                <img class="img_cusMax"
                                    src="http://203.151.27.229/spm/images/eSign/{{ $po_mt->idPsCheck }}.png"
                                    onerror="this.src = '{{ asset('signature/signature_empty.png') }}';"
                                    style="height: 40px;">
                            </th>
                            <th style="text-align: center; width: 100px;">
                                <img class="img_cusMax"
                                    src="http://203.151.27.229/spm/images/eSign/{{ $po_mt->idPsAccept }}.png"
                                    onerror="this.src = '{{ asset('signature/signature_empty.png') }}';"
                                    style="height: 40px;">
                            </th>
                            <th style="text-align: center; width: 100px;">
                                <img class="img_cusMax"
                                    src="http://203.151.27.229/spm/images/eSign/{{ $po_mt->idPsConfirm }}.png"
                                    onerror="this.src = '{{ asset('signature/signature_empty.png') }}';"
                                    style="height: 40px;">
                            </th>
                            <th style="text-align: center; width: 100px;">
                                <img class="img_cusMax"
                                    src="http://203.151.27.229/spm/images/eSign/{{ $po_mt->idPsConfirm2 }}.png"
                                    onerror="this.src = '{{ asset('signature/signature_empty.png') }}';"
                                    style="height: 40px;">
                            </th>
                            <!-- <th class="tTb">วิธีการโอนเงิน &nbsp; - ผ่านทางธนาคาร<br>INST.DATE </th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tTextL text-center" style="font-size: 12px;">
                                {{ $po_mt->PsCheck ?? '-' }}<br>
                                ผู้ตรวจสอบ
                            <td class="tTextL text-center" style="font-size: 12px;">{{ $po_mt->PsAccept ?? '-' }}
                                <br>
                                รับทราบ
                            </td>
                            </td>
                            <td class="tTextL text-center" style="font-size: 12px;">
                                {{ $po_mt->PsConfirmName_ ?? '-' }}<br>
                                ผู้อนุมัติ1
                            </td>
                            <td class="tTextL text-center" style="font-size: 12px;">
                                {{ $po_mt->PsConfirmName2_ ?? '-' }}<br>
                                ผู้อนุมัติ2</td>
                            <!-- <td class="tTb">ผู้รับเงิน</td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border-bottom mb-3"></div>

    </div>


    @if (isset($permission))
        @if ($po_mt->idPsConfirm2 == null && $permission->po_confirm2 == 1)
            <div class="po-btn-accept">
                <button type="button" class="btn btn text-center" style="width: 100%; color: #fff;"
                    onclick="showAlert('confirm2')">
                    <i class="fa-solid fa-check"></i>
                    อนุมัติ 2
                </button>
            </div>
        @elseif ($po_mt->idPsConfirm == null && $permission->po_confirm1 == 1)
            <div class="po-btn-accept">
                <button type="button" class="btn btn text-center" style="width: 100%; color: #fff;"
                    onclick="showAlert('confirm1')">
                    <i class="fa-solid fa-check"></i>
                    อนุมัติ 1
                </button>
            </div>
        @elseif ($po_mt->idPsAccept == null && $permission->po_accept == 1)
            <div class="po-btn-accept">
                <button type="button" class="btn btn text-center" style="width: 100%; color: #fff;"
                    onclick="showAlert('accept')">
                    <i class="fa-solid fa-check"></i>
                    รับทราบ
                </button>
            </div>
        @elseif ($po_mt->idPsCheck == null && $permission->po_check == 1)
            <div class="po-btn-accept">
                <button type="button" class="btn btn text-center" style="width: 100%; color: #fff;"
                    onclick="showAlert('check')">
                    <i class="fa-solid fa-check"></i>
                    ตรวจสอบ
                </button>
            </div>
        @endif
    @endif


    <div class="footer">
        <div class="row">
            <div class="text-d">
                <i class="fa-regular fa-circle-user"></i>
                <strong>{{ session('username') }}</strong>
                <i class="mr-3 fa-regular fa-building"></i>
                <strong>{{ session('user')->CompName }}</strong>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="PO_Update" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: none;">
                <div class="modal-body">
                    <div class="row p-4 border-bottom" style="text-align: center;">
                        <label for="" class="col-6" style="align-content: center;">สิทธิ์</label>
                    </div>
                    <div class="row p-4 border-bottom" style="text-align: center;">
                        <label for="" class="col-6" style="align-content: center;"><i
                                class="fa-solid fa-user-check fa-2xl" style="color: #B197FC;"></i> : -</label>
                        <button class="btn col-6 btn-item-ac" style="background-color: #015dee;color:#fff;"><i
                                class="fa-solid fa-check"></i> ตรวจสอบ</button>
                    </div>
                    <div class="row p-4 border-bottom" style="text-align: center;">
                        <label for="" class="col-6" style="align-content: center;">รับทราบ</label>
                        <button class="btn col-6 btn-item-ac" style="background-color: #015dee;color:#fff;"><i
                                class="fa-solid fa-check"></i> รับทราบ</button>
                    </div>
                    <div class="row p-4 border-bottom" style="text-align: center;">
                        <label for="" class="col-6" style="align-content: center;">อนุมัติ 1</label>
                        <button class="btn col-6 btn-item-ac" style="background-color: #015dee;color:#fff;"> <i
                                class="fa-solid fa-check"></i> อนุมัติ 1</button>
                    </div>
                    <div class="row p-4" style="text-align: center;">
                        <label for="" class="col-6" style="align-content: center;">อนุมัติ 2</label>
                        <button class="btn col-6 btn-item-ac" style="background-color: #015dee;color:#fff;"><i
                                class="fa-solid fa-check"></i> อนุมัติ 2</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            bahtText();

            function updateTime() {
                var now = new Date();

                var thailandTime = new Date(now.toLocaleString("en-US", {
                    timeZone: "Asia/Bangkok"
                }));
                var day = thailandTime.getDate();
                var month = thailandTime.getMonth() + 1;
                var year = thailandTime.getFullYear();

                var hours = thailandTime.getHours();
                var minutes = thailandTime.getMinutes();
                var seconds = thailandTime.getSeconds();
                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                var dateString = `${day}/${month}/${year+543}`;
                var timeString = `${hours}:${minutes}:${seconds}`;

                $('#date').text(dateString);
                $('#time').text(timeString);
            }

            setInterval(updateTime, 1000);
            updateTime();

        });


        function showAlert(status) {
            Swal.fire({
                title: `ยืนยันการทำรายการ ?`,
                // text: "You won't be able to revert this!",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#f8f9fa",
                confirmButtonText: "ตกลง",
                cancelButtonText: "ปิด"
            }).then((result) => {
                if (result.isConfirmed) {
                    // เรียก API ของ Laravel
                    fetch(`/po/confirm`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: status,
                                idPoBuy: {{ $po_mt->idPoBuy }}
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            Swal.fire({
                                title: "สำเร็จ!",
                                text: "คุณได้ทำรายการสำเร็จ.",
                                icon: "success"
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000);

                        })
                        .catch(error => {
                            Swal.fire({
                                title: "เกิดข้อผิดพลาด!",
                                text: "ไม่สามารถทำรายการได้",
                                icon: "error"
                            });
                        });
                }
            });
        }

        function bahtText() {
            $.ajax({
                url: '/BahtText/' + {{ $po_mt->TotalNet }} + '',
                type: 'GET',
                success: function(bahtText) {
                    document.getElementById('bahtText').textContent = bahtText;
                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });
        }
    </script>

</body>

</html>
