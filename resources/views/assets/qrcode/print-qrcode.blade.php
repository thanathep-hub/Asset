<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>พิมพ์</title>
    <style>
        .container {
            display: flex;
            align-items: center;
            /* justify-content: center; */
            margin-top: 50px;
        }

        .qrcode {
            width: 100px;
            height: 100px;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container p-4">
        <div id="qrcode" class="qrcode"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generate the QR code
            const qrCode = new QRCode(document.getElementById("qrcode"), {
                text: 'https://assets.advanceseeds.com/assets/link/id-component/' + {{ $id }},
                width: 100,
                height: 100,
                margin: 5
            });
        });

        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
