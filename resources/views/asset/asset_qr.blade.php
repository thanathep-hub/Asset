<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>QR-Code</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
            integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
            <style>
                #qr-code{
                    font-size: 14px;
                    padding: unset;
                }
            </style>
    </head>

    <body>

        <div class="col-12 invoice-col m-1" style="padding-top: 4px;">
            <div class="row">
                <div class="col-auto  py-2 text-right">
                    {{-- {!! QrCode::size(100)->generate($url) !!} --}}
                    {!! QrCode::size(100)->generate('http://assets.advanceseeds.com/asset/' . $id) !!}
                </div>
                <div class="col-8 align-self-center" id="qr-code">
                    <b>รหัสสินทรัพย์ : </b> {{ $qrAsset->AssetCode ?? '-' }}<br>
                    <b>ชื่อ : </b> {{ $qrAsset->AssetName ?? '-' }}<br>
                    <b>ใช้งานที่: </b>{{ $qrAsset->CompName ?? '-' }}
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
            window.onload = function() {
                window.print();
            };
        </script>
    </body>

</html>
