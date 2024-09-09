@push('style')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
@endpush
<style>
    .btn-new-asset {
        min-width: 160px;
        min-height: 44px;
        /* background-color: #6857E8; */
        background-color: #369689;
        color: #fff;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .border-image-upload {
        border-radius: 12px;
        border: 1px solid #d7f5f6;
        background-color: #effcfc;
    }

    .image-upload {
        border-radius: 12px;
        max-height: 60px;
        width: 60px;
        max-width: 60px;
        max-height: 60px;
        /* max-width: 150px; */
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15), inset 0 -1px 0 rgba(255, 255, 255, 0.15);
    }

    .invalid {
        /* background-color: ivory; */
        border: none;
        outline: 1px solid #ff5858;
    }

    .input-invalid {
        color: #ff0000;
    }

    .form-label {
        font-size: 16px;
        color: #09090bc4;
        font-weight: 500;
        /* margin-bottom: unset; */
    }

    .form-control {
        height: 40px;
    }

    input.form-control {
        border-radius: 12px;
        border: 1px solid #dee2e6;
    }

    .btn-left-arrow {
        height: 40px;
        width: 40px;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 50%;
    }

    .btn-save-asset {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .btn-manage-asset {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .dropdown {
        width: 100%;
    }

    .asset-catagory {
        height: 44px;
        border: 1px solid #dee2e6;
    }

    .dropdown-menu-cat {
        border: 1px solid #edf2ff;
    }

    .form-select {
        border-radius: 12px;
    }

    option:first-child {
        border: 1px solid #dee2e6;
        border-radius: 12px 12px 0px 0px;
    }

    samp {
        border-radius: 4px;
        padding: 4px;
        background-color: #1acd81;
        border: 1px solid #1acd81;
        color: #fff;
    }

    kbd {
        border: 2px solid #000000;
        box-shadow: 2px 2px #000000;
        padding: 2px 4px;
        margin-right: 4px;
        white-space: nowrap;
        background-color: #fff;
        color: #000000;
    }

    ::placeholder {
        color: #f6f6f6;
        opacity: 1;
    }

    /* tom select */
    .ts-control {
        font-size: unset;
        line-height: unset;
        border: unset;
        padding: unset;
    }

    .ts-dropdown {
        font-size: unset;
        border: 1px solid #dee2e6;
        border-radius: 12px;
    }

    .ts-dropdown [data-selectable].option {
        padding: .75rem;
        /* border-radius: 12px; */
    }

    .form-select {
        height: 40px;
    }

    .btn-close-new-asset {
        height: 28px;
        width: 28px;
        border: none;
        border-radius: 24px;
        /* background-color: #0e0027; */
        color: #000000;
    }
</style>

{{-- <div class="fixed-bottom">
    <div class="text-end p-3 mb-3">
        <div class="btn-group dropup">
            <button type="button" class="btn btn-new-asset border-0" data-bs-toggle="modal"
                data-bs-target="#add-new-asset">
                <i class="fa-solid fa-plus pe-2"></i>สินทรัพย์ใหม่
            </button>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="add-new-asset" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"> {{-- modal-fullscreen-sm-down --}}
        <div class="modal-content border-0">
            <div class="modal-header border-0" style="background-color: #f3f1ff;">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #172554;"><img class="pe-2"
                        src="{{ asset('assets/write.png') }}" height="28px">เพิ่มสินทรัพย์ใหม่
                </h1>
                <button type="button" class="btn-close-new-asset" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form class="p-4 pt-0">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="border-image-upload">
                            <img id="imgFileUpload" class="image-upload" src="{{ asset('assets/image-upoad.png') }}"
                                style="object-fit: cover;" />
                            <input type="file" accept="image/png, image/jpeg" name="img_asset"
                                id="asset-image-upload" style="display: none" multiple>
                        </div>
                        <div class="align-content-center">
                            <label class="ps-2 text-gray">คลิก <kbd>รูปภาพ</kbd> เพื่ออัพโหลด</label>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="inputAssetName" class="form-label">ชื่อสินทรัพย์</label>
                        <input type="text" class="form-control" id="inAssetName" oninput="checkInputs()"
                            placeholder="เช่น จอมอนิเตอร์ MSI MAG 275F"
                            style="background-color: #f2f3f5;font-size: .875rem;">
                        <span class="input-invalid" id="span-valid-asset-name">กรุณากรอกข้อมูลให้ครบ</span>
                    </div>
                    <div class="mb-3">
                        <label for="inAssetPrice" class="form-label">ราคา</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="inAssetPrice" oninput="checkInputs()">
                            <span class="input-group-text" style="color:#808080">฿</span>
                        </div>
                        <span class="input-invalid" id="span-valid-asset-price">กรุณากรอกข้อมูลให้ครบ</span>
                    </div>
                    <div class="mb-3">
                        <label for="inAssetAmount" class="form-label">จำนวน</label>
                        <input type="number" class="form-control" id="inAssetAmount" oninput="checkInputs()">
                        <span class="input-invalid" id="span-valid-asset-amount">กรุณากรอกข้อมูลให้ครบ</span>
                    </div>
                    <div class="mb-3">
                        <label for="AssetTypeName" class="form-label">ประเภทสินทรัพย์</label>
                        <select class="form-select" id="showAssetCategory">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inAssetStatus" class="form-label">สถานะ</label>
                        <select class="form-select" id="inAssetStatus">
                            <option value="1">ใช้งานอยู่</option>
                            <option value="2">เสียหาย</option>
                            <option value="3">เปลี่ยน</option>
                            <option value="4">ขายแล้ว</option>
                            <option value="5">ซ่อมบำรุง</option>
                            <option value="6">หมดอายุการใช้งาน</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="inAssetStatus" class="form-label">บริษัท</label>
                        <select class="form-select" id="inAssetComp" placeholder="ค้นหาบริษัท...">
                            {{-- @forelse ($comAsset as $items)
                                <option value="{{ $items->idComp }}">{{ $items->CompName }}</option>
                            @empty
                            @endforelse --}}

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="inAssetPlace" class="form-label">สถานที่ใช้งาน</label>
                        <input type="text" class="form-control" id="inAssetPlace" placeholder="เช่น ห้อง IT"
                            style="background-color: #f2f3f5;font-size: .875rem;" oninput="checkInputs()">
                        <span class="input-invalid" id="span-valid-asset-place">กรุณากรอกข้อมูลให้ครบ</span>
                    </div>

                    <div class="mb-3">
                        <label for="getResponsiblePerson" class="form-label">ผู้รับผิดชอบ</label>
                        <select class="form-select" id="getResponsiblePerson" placeholder="ค้นหารายชื่อ...">
                        </select>
                    </div>
                    <button type="button" class="btn w-full btn-save-asset mt-3"
                        style="height: 44px;color:#fff;background-color:#6857E8;" onclick="SaveNewAsset()">
                        <i class="fa-regular fa-floppy-disk pe-2"></i>บันทึก</button>

                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        let images = [];
        document.addEventListener('DOMContentLoaded', function() {
            var fileupload = document.getElementById("asset-image-upload");
            var image = document.getElementById("imgFileUpload");
            image.onclick = function() {
                fileupload.click();
            };
            fileupload.onchange = function() {
                var fileName = fileupload.value.split('\\')[fileupload.value.split('\\').length - 1];
            };
        });
        $(document).ready(function() {
            apiCallCatagory_asset();
            apiUserFullName();
            apiCompany();
        });
        async function SaveNewAsset() {

            if (checkInput() === true) {
                let waitResize = await ManageImage();


                if (waitResize === true) {
                    checkInputs();
                    let formData = new FormData();
                    formData.append('inAssetName', document.getElementById('inAssetName').value);
                    formData.append('inAssetPrice', document.getElementById('inAssetPrice').value);
                    formData.append('inAssetAmount', document.getElementById('inAssetAmount').value);
                    formData.append('inAssetCategory', document.getElementById('showAssetCategory').value);
                    formData.append('inAssetStatus', document.getElementById('inAssetStatus').value);
                    formData.append('inAssetComp', document.getElementById('inAssetComp').value);
                    formData.append('inAssetPlace', document.getElementById('inAssetPlace').value);
                    formData.append('inAssetRSP', document.getElementById('getResponsiblePerson').value);

                    images.forEach((image, index) => {
                        formData.append('assetFile[]', image, image.name);
                    });
                    $.ajax({
                        type: "POST",
                        url: "/assets/new-asset",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response, textStatus, xhr) {

                            if (xhr.status === 201) {
                                $('#add-new-asset').modal('hide');
                                Swal.fire({
                                    icon: "success",
                                    title: "บันทีกรายการสำเร็จ!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "เกิดข้อผิดพลาด...",
                                    text: "กรุณาตรวจสอบข้อมูลก่อนบันทึก!" + xhr,
                                });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log("Error: ", xhr.responseText);
                            console.log("Status: ", xhr.status);
                        }
                    });
                } else {
                    $('#add-new-asset').modal('hide');
                    Swal.fire({
                        title: "กรุณากดเพิ่มรูปภาพ!",
                        icon: "warning"
                    });
                }

            } else {
                console.log('ไม่มีข้อมูล');
            }

        }

        async function ManageImage() {
            const files = $('#asset-image-upload')[0].files;
            let formData = new FormData();

            if (files.length < 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'ใบเสร็จ ?',
                    text: 'กรุณาเพิ่มรายการอย่างน้อย 1 รายการ!',
                    confirmButtonText: 'ตกลง',
                    confirmButtonColor: '#009688'
                });
                return false;
            } else {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    try {
                        const resizedFile = await resizeImage(file);

                        // Check if resized file is less than 2MB
                        if (resizedFile.size < 2 * 1024 * 1024) {
                            // console.log(`Resized file size: ${resizedFile.size} bytes`);
                            images.push(resizedFile);
                        } else {
                            console.log(
                                `Resized file size exceeds 2MB limit: ${resizedFile.size} bytes`);
                        }
                    } catch (error) {
                        console.error(`Error resizing file ${file.name}:`, error);
                    }
                }
                return true;
            }

            // const fileInput = document.getElementById('asset-image-upload');
            // const files = fileInput.files;


            // if (files.length > 0) {
            //     const resizedFile = await resizeImage(files[0]);
            //     if (resizedFile.size < 2 * 1024 * 1024) {
            //         images = resizedFile;
            //         console.log("ขนาดของภาพ : ", images.size);
            //         return true;
            //     } else {
            //         console.log(
            //             `Resized file size exceeds 2MB limit: ${resizedFile.size} bytes`);
            //         // return false;
            //     }
            // } else {
            //     return false;
            // }
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

        /* Api */ // modal new asset
        function apiCallCatagory_asset() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/asset/catagory",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(catagory) {
                    $.each(catagory, function(index, items) {
                        $('#showAssetCategory').append(`
                        <option value="${items.idAssType}" selected>${items.AssTypeName}</option>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function apiUserFullName() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/user/fullname",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(user) {
                    $('#getResponsiblePerson').empty();

                    $.each(user, function(index, users) {
                        $('#getResponsiblePerson').append(`
                        <option value="${users.idPs}">${users.PsNameFS}</option>
                        `);
                    });
                    new TomSelect("#getResponsiblePerson", {
                        sortField: {
                            field: "text",
                            direction: "asc",
                        },
                        render: {
                            no_results: function(data, escape) {
                                return '<option class="no-results">ไม่พบชื่อพนักงาน</option>';
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function apiCompany() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/company",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(data) {

                    $('#inAssetComp').empty();

                    $.each(data, function(index, comp) {
                        $('#inAssetComp').append(`
                        <option value="${comp.idComp}">${comp.CompName}</option>
                        `);
                    });
                    new TomSelect("#inAssetComp", {
                        sortField: {
                            field: "text",
                            direction: "asc",
                        },
                        render: {
                            no_results: function(data, escape) {
                                return '<option class="no-results">ไม่พบข้อมูล</option>';
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
        /* /Api */

        /* addEven */
        document.getElementById('asset-image-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewImage = document.getElementById('imgFileUpload');
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block'; // Show the image
                };

                reader.readAsDataURL(file);
            } else {
                alert('Please select a valid image file.');
            }
        });

        document.querySelectorAll('input').forEach(inputElement => {
            inputElement.addEventListener('input', function() {
                if (inputElement.value === '') {
                    inputElement.style.backgroundColor = '#ffffff';
                } else {
                    inputElement.style.backgroundColor = '#f2f3f5';
                }
            });
        });

        function checkInput() {
            let check = false;
            if (document.getElementById('inAssetName').value === '') {
                Swal.fire("กรุณากรอกชื่อสินทรัพย์!");
            } else if (document.getElementById('inAssetPrice').value === '') {
                Swal.fire("กรุณากรอกราคาสินทรัพย์!");

            } else if (document.getElementById('inAssetAmount').value === '') {
                Swal.fire("กรุณากรอกจำนวนสินทรัพย์!");

            } else if (document.getElementById('inAssetPlace').value === '') {
                Swal.fire("กรุณากรอกสถานที่ใช้งานสินทรัพย์!");

            } else {
                check = true;
            }
            return check;
        }

        function checkInputs() {

            if (document.getElementById('inAssetName').value === '') {
                document.getElementById('span-valid-asset-name').classList.remove('d-none');
            } else {
                document.getElementById('span-valid-asset-name').classList.add('d-none');
            }

            if (document.getElementById('inAssetPrice').value === '') {
                document.getElementById('span-valid-asset-price').classList.remove('d-none');
            } else {
                document.getElementById('span-valid-asset-price').classList.add('d-none');
            }

            if (document.getElementById('inAssetAmount').value === '') {
                document.getElementById('span-valid-asset-amount').classList.remove('d-none');
            } else {
                document.getElementById('span-valid-asset-amount').classList.add('d-none');
            }

            if (document.getElementById('inAssetPlace').value === '') {
                document.getElementById('span-valid-asset-place').classList.remove('d-none');
            } else {
                document.getElementById('span-valid-asset-place').classList.add('d-none');
            }
        }
    </script>
@endpush
