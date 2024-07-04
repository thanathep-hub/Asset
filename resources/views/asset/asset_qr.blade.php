<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR-Code</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        #qr-code {
            font-size: 14px;
        }

        @page {
            size: 60mm 40mm;
            /* This sets the paper size to 60mm by 40mm */
            margin: 0;
            padding: 0;
            /* Adjust margins as needed */
        }

        @media print {

            /* Additional print-specific styles */
            body {
                font-size: 12pt
                    /* Adjust the font size for printing */
            }

            /* Optionally, ensure the content fits within the custom size */
            .print-content {
                width: 100%;
                height: 100%;
                overflow: hidden;
                /* Hide overflow to prevent clipping issues */
                /* border: 1px solid red; */
            }

            .page-set {
                /* display: flex; */
            }

            .qr-code {
                margin-top: 2.75rem;
                margin-left: 0;
                padding-left: 0px;
            }

            .w-set {
                margin-top: 2.25rem;
                flex: 0 0 25%;
                max-width: 25%;
            }

        }
    </style>
</head>

<body>

    <div class="col-12 m-2 page-set" style="">
        <div class="print-content row page-set p-0">
            <div class="col-auto p-0 w-auto m-0">
                <div class="qr-code" style="width: 100%;padding:0px;">

                    {{-- {!! QrCode::size(100)->generate('http://assets.advanceseeds.com/asset/' . $id) !!} --}}
                    <div id="qrcode"></div>
                </div>

            </div>
            <div class="col-auto w-set">
                <b>รหัสสินทรัพย์ : </b> {{ $qrAsset->AssetCode ?? '-' }}<br>
                 <label id="asset-name"><strong>ชื่อ :</strong> {{ $qrAsset->AssetName ?? '-' }}</label>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        // let assetNameElement = document.getElementById('asset-name');
        // assetNameElement.textContent = assetNameElement.textContent.substring(0, 10);

        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "https://assets.advanceseeds.com/asset/" + {{ $id }},
            width: 100,
            height: 100,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
        window.onload = function() {
            let assetNameElement = document.getElementById('asset-name');
            assetNameElement.textContent = assetNameElement.textContent.substring(0, 100);

            window.print();
        };
    </script>
</body>

</html>


