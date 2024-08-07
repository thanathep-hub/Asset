<style>
    .modal-dialog-active {
        position: fixed;
        top: auto;
        right: auto;
        left: auto;
        bottom: 0;
    }

    .modal-content-active {
        border-radius: 32px !important;
    }
</style>

<div class="modal fade" id="active-old-asset" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="align-items: flex-end;"> {{-- modal-fullscreen-sm-down --}}
        <div class="modal-content modal-content-active border-0">
            {{-- <div class="modal-header border-0 p-4 pb-0 justify-content-end">
                <button type="button" class="btn p-0 border-0" data-bs-dismiss="modal" aria-label="Close">
                    <img class="btn-left-arrow" src="{{ asset('assets/close.png') }}" alt="">
                </button>
            </div> --}}
            <div class="modal-body">
                <form class="p-4 pt-0">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="border-image-upload">
                            <img id="imgFileUpload-active" class="image-upload"
                                src="{{ asset('assets/image-upoad.png') }}" style="object-fit: cover;" />
                            <input type="file" accept="image/png, image/jpeg" name="img_asset_active"
                                id="asset-image-upload-active" style="display: none;">
                        </div>
                        <div class="align-content-center">
                            <label class="ps-2 text-gray">คลิก <kbd>รูปภาพ</kbd> เพื่ออัพโหลด</label>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="inputAssetName" class="form-label">ชื่อสินทรัพย์</label>
                        <input type="text" class="form-control" id="inAssetName_active" oninput="checkInputsActive()"
                            placeholder="เช่น จอมอนิเตอร์ MSI MAG 275F"
                            style="background-color: #f2f3f5;font-size: .875rem;">
                        <span class="input-invalid" id="span-valid-asset-name-active">กรุณากรอกข้อมูลให้ครบ</span>
                    </div>
                    <div class="mb-3">
                        <label for="AssetTypeName" class="form-label">ประเภทสินทรัพย์</label>
                        <select class="form-select" id="showAssetCategory-active">
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
                        <label for="inAssetPlace" class="form-label">สถานที่ใช้งาน</label>
                        <input type="text" class="form-control" id="inAssetPlace" placeholder="เช่น ห้อง IT"
                            style="background-color: #f2f3f5;font-size: .875rem;" oninput="checkInputs()">
                        <span class="input-invalid" id="span-valid-asset-place">กรุณากรอกข้อมูลให้ครบ</span>
                    </div>

                    <div class="mb-3">
                        <label for="getResponsiblePerson" class="form-label">ผู้รับผิดชอบ</label>
                        <select class="form-select" id="getResponsiblePerson-active" placeholder="ค้นหารายชื่อ...">
                        </select>
                    </div>
                    <button type="button" class="btn w-full btn-save-asset mt-3"
                        style="height: 44px;color:#fff;background-color:#6857E8;">
                        <i class="fa-regular fa-circle-check pe-2"></i>บันทึก</button>

                </form>
            </div>
        </div>
    </div>
</div>
{{-- @push('script') --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Active component loaded');
        // Add more JavaScript here
        window.onload = function() {
            let fileuploadac = document.getElementById("asset-image-upload-active");
            let imageac = document.getElementById("imgFileUpload-active");
            imageac.onclick = function() {
                fileuploadac.click();
            };
            fileuploadac.onchange = function() {
                let fileNameac = fileuploadac.value.split('\\').pop();
            };
        };

        document.getElementById('asset-image-upload-active').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewImage = document.getElementById('imgFileUpload-active');
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block'; // Show the image
                };

                reader.readAsDataURL(file);
            } else {
                alert('Please select a valid image file.');
            }
        });

    });
</script>
{{-- @endpush --}}
