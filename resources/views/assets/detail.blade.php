@extends('app.app')
@section('title', 'สินทรัพย์')
@push('style')
    {{-- Tom Select --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <style>
        .content {
            background-image: linear-gradient(to right, #d4e5ed, #d5d7e48a)
                /* background-image: linear-gradient(to right, #d2e9ee, #d5d7e4); */
        }

        body {

            background: #d1d5db;
        }

        /*  */
        .search-bar {
            max-width: 600px;
        }

        .card {
            --bs-card-border-color: none;
            border-radius: 12px;
        }

        .card-asset-detail {
            box-shadow: 0 0.5rem 1rem #00000026, inset 0 -1px 0 #ffffff26;
            /* box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
        }

        .asset-box-img {
            width: 150px;
            height: 150px;
        }

        .asset-img {
            /* box-shadow: 0 0 .875rem 0 rgba(34, 46, 60, .05); */
            max-width: 150px;
            max-height: 150px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15), inset 0 -1px 0 rgba(255, 255, 255, 0.15);
        }

        /* manage dropdow */
        .dropdown-menu {
            transition: 0.25s, height 0.25s;
            border: 2px solid #eef1ff;
            background-color: #eef1ff;
            margin-bottom: .125rem !important;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .dropdown-item:focus,
        .dropdown-item:hover,
        .dropdown-item:active {
            background-color: #6857e8;
            color: #fff;
        }

        .dropup .dropdown-toggle::after {
            display: none;
        }

        .border-image-upload {
            border-radius: 12px;
            border: 1px solid #d7f5f6;
            background-color: #effcfc;
        }

        .btn-close {
            border-radius: .5rem;
            background-color: #80808042;
        }

        .image-upload {
            border-radius: 12px;
            max-height: 100px;
            width: 100px;
            max-width: 100px;
            max-height: 100px;
            /* max-width: 150px; */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15), inset 0 -1px 0 rgba(255, 255, 255, 0.15);
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
            border-radius: 12px;
        }

        .form-select {
            height: 40px;
            ;
        }

        /* /tom select */

        /* check input  */
        .invalid {
            /* background-color: ivory; */
            border: none;
            outline: 1px solid #ff5858;
        }

        .input-invalid {
            color: #ff0000;
        }
    </style>
@endpush
@section('content')
    <div class="mt-4 search-bar"> {{-- d-md-none --}}
        <div class="card card-asset-detail" style="padding: .75rem 0rem 1.5rem 0rem;">
            <div class="row d-flex justify-content-center align-items-center m-0 mb-3">
                <div class="col-12 mb-3 text-end">
                    <img class="" src="{{ asset('assets/unsuccess.png') }}" height="24px">
                    <span class="form-label" style="font-weight: 500;color:#262c40a8;">รอยืนยัน</span>
                </div>
                <div class="col-md-8">
                    <div class="align-items-center" style="text-align: -webkit-center;">
                        <div class="asset-box-img mb-3">
                            <img class="asset-img"
                                src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/{{ $idAsset }}_1.jpg"
                                style="width: 100%;border-radius:12px;">
                        </div>
                        <div class="text-center">
                            <h6 id="AssetName">เครื่องพ่นยา ฮอนด้า(HONDA) พร้อมเครื่องยนต์ 3 สูบพร้อมเครื่องยนต์</h6>
                        </div>
                    </div>
                </div>
                <div class="border-bottom mb-3" style="width: 95%;"></div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">สถานะสินทรัพย์</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="AssetStatus"><samp>ใช้งานอยู่</samp></label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">จำนวน</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="AssetAmount"></label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">Serial Number</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="SerialNumber">mz62347-er2</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">ประเภทสินทรัพย์</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="AssetType">อุปกรณ์อื่นๆ</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">วันที่ซื้อ</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="PurchaseDate">29/06/2567</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">สถานที่ใช้งาน</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="Location">บริษัท กรีนซีดส์ จำกัด</label>
                </div>

                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">ผู้รับผิดชอบ</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="ResponsiblePerson">เพชรินทร์ ชลูด</label>
                </div>

                <div class="border-bottom mb-3" style="width: 95%;"></div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">อายุการใช้งาน</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="AssetYear">5 ปี</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">มูลค่าต้นทุน</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="Cost">3,000 บาท</label>
                </div>
                <div class="col-12 row mb-3">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">มูลค่าคงเหลือ</label>
                    <label class="col-7 text-end" style="font-weight: 500;color:#f8493b;" id="Value">1 บาท</label>
                </div>
            </div>
            {{-- <div class="border-bottom mb-3 mx-2" style="width: 95%;"></div> --}}

            {{-- <div class="text-end p-3">
                <div class="btn-group dropup">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                        style="min-width: 160px;min-height: 44px;background-color:#6857E8;color:#fff;">
                        จัดการ <i class="fa-solid fa-pen ps-2"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li class="mb-1"><a class="dropdown-item" href="#">ผูกสินทรัพย์</a></li>
                        <li class="mb-1"><a class="dropdown-item" href="#">อัพเดตสินทรัพย์ </a></li>
                        <li class="mb-1"><a class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#add-new-asset">เพิ่มสินทรัพย์</a></li>
                    </ul>
                </div>
                <button class="btn btn-primary border-0" hidden
                    style="min-width: 160px;min-height: 44px;background-color:#6857E8;">จัดการ <i
                        class="fa-solid fa-pen ps-2"></i></button>
            </div> --}}
        </div>
    </div>

    <div class="modal fade" id="add-new-asset" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down"> {{-- modal-fullscreen-sm-down --}}
            <div class="modal-content border-0">
                <div class="modal-header border-0 p-4 justify-content-end">
                    <button type="button" class="btn p-0 border-0" data-bs-dismiss="modal" aria-label="Close">
                        <img class="btn-left-arrow" src="{{ asset('assets/close.png') }}" alt="">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="p-4 pt-0">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="border-image-upload">
                                <img id="imgFileUpload" class="image-upload" src="{{ asset('assets/image-upoad.png') }}"
                                    style="object-fit: cover;" />
                                <input type="file" accept="image/png, image/jpeg" name="img_asset"
                                    id="asset-image-upload" style="display: none">
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
                            <select class="form-select" id="inAssetComp">
                                @forelse ($comAsset as $items)
                                    <option value="{{ $items->idComp }}">{{ $items->CompName }}</option>
                                @empty
                                @endforelse

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

    @include('assets.active')

    <div class="fixed-bottom "> {{-- d-md-none --}}
        <div class="text-end p-3 mb-3">
            <div class="btn-group dropup">
                <button type="button" class="btn dropdown-toggle btn-manage-asset border-0" data-bs-toggle="dropdown"
                    aria-expanded="false" style="min-width: 160px;min-height: 44px;background-color:#6857E8;color:#fff;">
                    จัดการ <i class="fa-solid fa-pen ps-2"></i>
                </button>
                <ul class="dropdown-menu">
                    <li class="mb-1"><a class="dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#active-old-asset">Active</a></li>
                    <li class="mb-1"><a class="dropdown-item" href="#">ผูกสินทรัพย์</a></li>
                    <li class="mb-1"><a class="dropdown-item" href="#">อัพเดตสินทรัพย์ </a></li>
                    <li class="mb-1"><a class="dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#add-new-asset">เพิ่มสินทรัพย์</a></li>
                </ul>
            </div>
        </div>
    </div>




@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        window.onload = function() { // modal new asset
            var fileupload = document.getElementById("asset-image-upload");
            var image = document.getElementById("imgFileUpload");
            image.onclick = function() {
                fileupload.click();
            };
            fileupload.onchange = function() {
                var fileName = fileupload.value.split('\\')[fileupload.value.split('\\').length - 1];
            };
        };
        $(document).ready(function() {
            callAssetDetail({{ $idAsset }});
            apiCallCatagory_asset(); // modal new asset
            apiUserFullName(); // modal new asset

        });

        function callAssetDetail(id) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/asset/item/" + id,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(data) {
                    console.log(data);
                    setData(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function setData(data) {

            let price = parseFloat(data.Price);

            document.getElementById("AssetName").innerText = data.AssetName;
            document.getElementById("inAssetName_active").value = data.AssetName;

            document.getElementById("AssetAmount").innerText = (parseInt(data.AssAmount, 10));;
            document.getElementById("AssetType").innerText = (data.AssTypeName || 'ไม่ถูกระบุ');
            document.getElementById("PurchaseDate").innerText = data.AssDateT;
            document.getElementById("Location").innerText = data.CompName;
            document.getElementById("ResponsiblePerson").innerText = "รอการอัพเดต";
            document.getElementById("SerialNumber").innerText = "#AS000x";
            document.getElementById("Cost").innerText = new Intl.NumberFormat('th-TH', {
                style: 'currency',
                currency: 'THB'
            }).format(parseFloat(data.Price)) + " บาท";

            const lifespanDays = (parseInt(data.AssYearType) || 5) * 365;
            const currentDays = calDate(data.AssDateT);
            document.getElementById("AssetYear").innerText = (data.AssYearType || 'ไม่ถูกระบุ') + " ปี";
            document.getElementById("Value").innerText = new Intl.NumberFormat('th-TH', {
                style: 'currency',
                currency: 'THB'
            }).format(parseFloat(calculateAssetValue(price, lifespanDays, currentDays))) + " บาท";
        }

        function calculateAssetValue(price, lifespanDays, currentDays) {
            console.log(price, lifespanDays, currentDays);
            const depreciationRatePerDay = 0.20 / lifespanDays; // มูลค่าลดลงคิดเป็น 20% ต่อวัน

            if (currentDays >= lifespanDays) {
                return 1; // หากเกินอายุการใช้งาน มูลค่าจะเหลือ 1 บาท

            }

            // คำนวณมูลค่าลดลง
            const valueAfterDepreciation = price * Math.pow((1 - depreciationRatePerDay), currentDays);
            return valueAfterDepreciation;
        }

        function calDate(dateString) { //let date = calDate("13/05/2567");
            function convertBuddhistToGregorian(buddhistYear, month, day) {
                const gregorianYear = buddhistYear - 543;
                return new Date(gregorianYear, month - 1, day);
            }

            function daysBetweenDates(date1, date2) {
                const diffTime = Math.abs(date2 - date1);
                return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            }

            // แปลง string เป็นวันที่ในรูปแบบเกรกอเรียน
            const [day, month, buddhistYear] = dateString.split('/').map(Number);
            const dateBuddhist = convertBuddhistToGregorian(buddhistYear, month, day);
            const today = new Date();

            const daysDiff = daysBetweenDates(dateBuddhist, today);

            return daysDiff;
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
                    console.log(catagory);
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

        function apiUserFullName() { // modal new asset
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

        /* /addEven */


        /* resize image */
        var images;

        async function ManageImage() {
            const fileInput = document.getElementById('asset-image-upload');
            const files = fileInput.files;


            if (files.length > 0) {
                const resizedFile = await resizeImage(files[0]);
                if (resizedFile.size < 2 * 1024 * 1024) {
                    images = resizedFile;
                    console.log("ขนาดของภาพ : ", images.size);
                    return true;
                } else {
                    console.log(
                        `Resized file size exceeds 2MB limit: ${resizedFile.size} bytes`);
                    // return false;
                }
            } else {
                return false;
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

        /* /resize image */

        async function SaveNewAsset() {
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

                formData.append('assetFile', images);
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
                                text: "กรุณาตรวจสอบข้อมูลก่อนบันทึก!",
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

        function checkInputsActive() {

            if (document.getElementById('inAssetName_active').value === '') {
                document.getElementById('span-valid-asset-name-active').classList.remove('d-none');
            } else {
                document.getElementById('span-valid-asset-name-active').classList.add('d-none');
            }
        }
        // // modal new asset
    </script>
@endpush
