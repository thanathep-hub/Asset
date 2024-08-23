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
            display: flex;
            justify-content: center;
            /* This ensures the content is centered vertically and horizontally */
        }

        .form-asset-qr {
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }


        .qr-code-m {
            width: fit-content;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 8px;
        }

        .btn-save-new-asset {
            background-color: #369689;
            color: #ffffff;
            /* height: 44px; */
        }
    </style>
@endpush
@section('content')
    <div class="d-block d-lg-none" style="padding-top:3rem;">
        <div class="section-one mb-3">
            <div class="qr-code-m">
                <div class="" id="generateQR"></div>
            </div>
        </div>
        <div class="section-two">
            <div class="form-asset-qr bg-white p-4" style="max-width: 600px;">
                <form class="">
                    <div class="mb-3">
                        <label for="name-asset" class="form-label">ชื่อสินทรัพย์ใหม่</label>
                        <input type="text" class="form-control" id="name-asset" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="new-asset-img" class="form-label">เลือกรูปภาพ</label>
                        <input class="form-control" type="file" id="new-asset-img" accept="image/*" multiple
                            name="assetImg[]" onchange="validateImageUpload()">
                        <p id="error-message" style="color: red;"></p>
                    </div>
                    <div class="mb-3">
                        <label for="name-asset-place" class="form-label">สถานที่</label>
                        <input type="text" class="form-control" id="name-asset-place"
                            placeholder="เช่น ห้องไอที, ห้องบัญชี">
                    </div>
                    <div class="border-bottom mb-3"></div>
                    <div class="">
                        <button type="button" class="btn w-100 btn-save-new-asset" style="background-color: #369689;"
                            onclick="saveNewAsset()">
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

        function saveNewAsset() {

            check_input();

            async function check_input() {
                const assetName = document.getElementById('name-asset').value.trim();
                const assetPlace = document.getElementById('name-asset-place').value.trim();
                const assetImages = document.getElementById('new-asset-img').files;
                let qrimage = [];
                // Check if the input fields or file inputs are empty
                if (!assetName) {
                    Swal.fire({
                        text: "กรุณากรอกชื่อสินทรัพย์",
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#dd3c4a'
                    });
                } else if (!assetPlace) {
                    Swal.fire({
                        text: "กรุณากรอกสถานที่",
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#dd3c4a'
                    });
                } else if (assetImages.length === 0) {
                    Swal.fire({
                        text: "กรุณาเพิ่มรูปสินทรัพย์",
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#dd3c4a'
                    });
                }

                // If all fields are filled, you can proceed with further logic
                if (assetName && assetPlace && assetImages.length > 0) {
                    // รออัพเดต resize รูปก่อนอัพโหลด

                    const files = $('#new-asset-img')[0].files;
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const resizedFile = await resizeImage(file);
                        qrimage.push(resizedFile);
                    }
                    console.log(qrimage);

                    let qrDataAsset = new FormData();
                    qrDataAsset.append('qrAssetId', {{ $id }});
                    qrDataAsset.append('qrAssetName', document.getElementById('name-asset').value);
                    qrDataAsset.append('qrAssetPlace', document.getElementById('name-asset-place').value);

                    qrimage.forEach((image, index) => {
                        qrDataAsset.append('qrAssetImg[]', image, image.name);
                    });

                    $.ajax({
                        type: "POST",
                        url: "/assets/qr-new-assets",
                        data: qrDataAsset,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                text: "บันทึกเรียบร้อยแล้ว", // "Saved successfully"
                                confirmButtonText: 'ตกลง', // "OK"
                                confirmButtonColor: '#369689'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to the asset detail page
                                    window.location.href = '/assets/detail/' + response.idAsset;
                                }
                            });
                        }
                    });
                    console.log('All fields are filled. Proceed with saving...');
                    // Additional logic to save the asset
                }
            }

        }

        function validateImageUpload() {
            const input = document.getElementById('new-asset-img');
            const errorMessage = document.getElementById('error-message');
            if (input.files.length > 5) {
                errorMessage.textContent = "สามารถอัพโหลดรูปภาพได้สูงสุด 5 ภาพ.";
                input.value = ""; // Clear input
            } else {
                errorMessage.textContent = "";
            }
        }

        function resizeImage(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = new Image();
                    img.onload = function() {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');

                        let width = img.width;
                        let height = img.height;

                        // Resize logic
                        const maxWidth = 800;
                        const maxHeight = 800;

                        if (width > height) {
                            if (width > maxWidth) {
                                height *= maxWidth / width;
                                width = maxWidth;
                            }
                        } else {
                            if (height > maxHeight) {
                                width *= maxHeight / height;
                                height = maxHeight;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;
                        ctx.drawImage(img, 0, 0, width, height);

                        canvas.toBlob((blob) => {
                            if (blob) {
                                const resizedFile = new File([blob], file.name, {
                                    type: file.type
                                });
                                resolve(resizedFile);
                            } else {
                                reject(new Error("Canvas is empty"));
                            }
                        }, file.type);
                    };
                    img.src = event.target.result;
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
@endpush
