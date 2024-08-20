@extends('app.em')
@section('title', 'สินทรัพย์ใหม่')
@push('style')
    <style>
        body {
            background: #d1d5db;
        }

        .content {
            /* background-image: linear-gradient(to right, #d4e5ed, #d5d7e48a); */
            background-color: #efefef;
        }

        .height {
            height: 100vh;
        }

        /* list  asset items */
        /* qr code show  */
        .section-one {
            text-align: -webkit-center;
        }

        .section-two {
            border-radius: 8px;
            width: 100%;
            max-width: 600px;
            text-align: -webkit-center;
        }

        .qr-code-m {
            width: fit-content;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 8px;
        }
    </style>
@endpush
@section('content')
    <div class="d-block d-lg-none" style="padding-top:3rem;text-align: -webkit-center;">
        <div class="section-one mb-3">
            <div class="qr-code-m">
                <div class="" id="generateQR"></div>
            </div>

        </div>
        <div class="section-two p-4 bg-white">
            <div class="form-asset-qr">
                <form class="">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name-asset" placeholder="ชื่อสินทรัพย์ใหม่"
                            maxlength="100">
                        <label for="name-asset">ชื่อสินทรัพย์ใหม่</label>
                    </div>
                    <div class="">
                        <button type="button" class="btn">
                            <i class="fa-solid fa-floppy-disk pe-2"></i>
                            บันทึก
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script src="{{ asset('js/assets/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        $(document).ready(function() {
            generateQRCode();
        });

        function generateQRCode() {
            // Clear any previous QR code
            const currentURL = window.location.href;
            document.getElementById('generateQR').innerHTML = "";

            // Generate the QR code
            const qrCode = new QRCode(document.getElementById("generateQR"), {
                text: currentURL,
                width: 200,
                height: 200,
                margin: 5
            });
        }
    </script>
@endpush
