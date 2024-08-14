@push('style')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
@endpush
<style>
    .modal-dialog-active {
        position: fixed;
        top: auto;
        right: auto;
        left: auto;
        bottom: 0;
    }

    @media only screen and (max-width: 600px) {
        .modal-dialog-centered {
            align-items: flex-end;
        }
    }
</style>

<div class="modal fade" id="qr-code-asset" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content modal-content-active border-0">
            <div class="modal-header border-0" style="background-color: #f3f1ff;">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight: 700;color: #58d090;">QR Code
                </h1>
                <button type="button" class="btn-close-new-asset" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="layout-qr-code" style="text-align: -webkit-center;">
                    <div class="mt-3 mb-3" id="qrcode"></div>
                </div>
                <button type="button" id="download" class="btn form-control"
                    style="height:40px;background-color: #369689;color:#fff;" onclick="downloadQRCode()">บันทึก</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        $(document).ready(function() {
            generateQRCode();
        });

        function generateQRCode() {
            // Clear any previous QR code
            document.getElementById('qrcode').innerHTML = "";

            // Generate the QR code
            const qrCode = new QRCode(document.getElementById("qrcode"), {
                text: 'https://assets.advanceseeds.com/assets/detail/' + {{ $idAsset }},
                width: 200,
                height: 200,
                margin: 5
            });

            // Show the download button
            document.getElementById('download').style.display = 'block';
        }

        function downloadQRCode() {
            const qrCodeCanvas = document.querySelector('#qrcode canvas');

            const dataURL = qrCodeCanvas.toDataURL('image/png');

            const downloadLink = document.createElement('a');
            downloadLink.href = dataURL;
            downloadLink.download = 'qrAS' + {{ $idAsset }} + '.png';
            downloadLink.click();
        }
    </script>
@endpush
