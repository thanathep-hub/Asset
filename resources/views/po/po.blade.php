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
    </style>
</head>

<body>

    <div class="container-custom container">
        <div class="text-center mt-3 mb-3">
            <h6>เลขที่ใบสั่งซื้อ PO99987</h6>
        </div>
        <div class="stepper-wrapper mt-3">
            <div class="stepper-item completed">
                <div class="step-counter"><i class="fa-solid fa-check fa-xl" style="color: #fff;"></i></div>
                <div class="step-name">ตรวจสอบ</div>
            </div>
            <div class="stepper-item completed">
                <div class="step-counter"><i class="fa-solid fa-check fa-xl" style="color: #fff;"></i></div>
                <div class="step-name">รับทราบ</div>
            </div>
            <div class="stepper-item active">
                <div class="step-counter"><i class="fa-solid fa-check fa-xl" style="color: #fff;"></i></div>
                <div class="step-name">อนุมัติ 1</div>
            </div>
            <div class="stepper-item">
                <div class="step-counter"><i class="fa-solid fa-check fa-xl" style="color: #fff;"></i></div>
                <div class="step-name">อนุมัติ 2</div>
            </div>
        </div>

        <div class="datail-po">
            <div class="in-detail-first border p-3 mb-2">
                <div class="item">
                    <label class="kanit-semibold">บริษัท : </label>
                    <label for="">บริษัท กรีนซีดส์ จำกัด</label>
                </div>
                <div class="item">
                    <label class="kanit-semibold">Supplier : </label>
                    <label for=""></label>
                </div>
                <div class="item">
                    <label class="kanit-semibold">ผู้สั่งซื้อ : </label>
                    <label for=""></label>
                </div>
                <div class="item">
                    <label class="kanit-semibold">เบอร์ติดต่อ : </label>
                    <label for=""></label>
                </div>
                <div class="item">
                    <label class="kanit-semibold">ผู้ออกคำสั่ง : </label>
                    <label for=""></label>
                </div>
                <div class="item">
                    <label class="kanit-semibold">โครงการ : </label>
                    <label for=""></label>
                </div>
            </div>
            <div class="in-detail-second border p-3">
                <div class="item">
                    <label class="kanit-semibold">วันที่ซื้อสินค้า : </label>
                    <label for="">27-05-2567</label>
                </div>
                <div class="item">
                    <label class="kanit-semibold">ผู้ทำรายการ : </label>
                    <label for="">เอก ธุมากร</label>
                </div>
                <div class="item">
                    <label class="kanit-semibold">วันที่ทำรายการ : </label>
                    <label for="">05-05-2567</label>
                </div>
                <div class="item">
                    <label class="kanit-semibold">สถานที่ส่งของ : </label>
                    <label for="">บริษัท กรีนซีดส์ จำกัด
                        421 หมู่ 11 ต.พังขว้าง อ.เมือง 47000
                        โทร.042-970217</label>
                </div>
                <div class="item">
                    <label class="kanit-semibold">หมายเหตุ : </label>
                    <label for="">โครงการซ่อมโรงเรือนตาข่ายเคลื่อนที่ไร่สุขสม</label>
                </div>
            </div>

            <div class="in-detail-second border p-3">
                <h6>รายการ</h6>
                <div class="table-responsive">
                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Column 1</th>
                                <th scope="col">Column 2</th>
                                <th scope="col">Column 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td scope="row">R1C1</td>
                                <td>R1C2</td>
                                <td>R1C3</td>
                            </tr>
                            <tr class="">
                                <td scope="row">Item</td>
                                <td>Item</td>
                                <td>Item</td>
                            </tr>
                        </tbody>
                    </table> --}}
                </div>

            </div>

        </div>

    </div>
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            // $('#myButton').click(function(){
            //     alert('Button clicked!');
            // });
        });
    </script>

</body>

</html>
