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

    .modal-content-active {
        /* border-radius: 32px !important; */
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
        border-radius: 0px;
    }

    .form-select {
        height: 40px;
    }

    /* tom select */

    .btn-close-new-asset {
        height: 28px;
        width: 28px;
        border: none;
        border-radius: 24px;
        /* background-color: #0e0027; */
        color: #808080;
    }

    /* ิะื แสนหำ ฟแะรอำ ทนกฟส */

    @media only screen and (max-width: 600px) {
        .modal-dialog-centered {
            align-items: flex-end;
        }
    }
</style>

<div class="modal fade" id="active-old-asset" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered"> {{-- modal-fullscreen-sm-down --}}
        <div class="modal-content modal-content-active border-0">
            <div class="modal-header border-0" style="background-color: #f3f1ff;">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight: 700;color: #58d090;"><img
                        class="pe-2" src="{{ asset('assets/stamp.png') }}" height="28px">ACTIVE</h1>
                <button type="button" class="btn-close-new-asset" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form class="p-4 pt-0">
                    <div class="mb-3">
                        <label for="inputAssetName" class="form-label">ชื่อสินทรัพย์</label>
                        <input type="text" class="form-control" id="inAssetName_active"
                            placeholder="เช่น จอมอนิเตอร์ MSI MAG 275F" readonly
                            style="background-color: #f2f3f5;font-size: .875rem;">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="AssetTypeName" class="form-label">ประเภทสินทรัพย์</label>
                        <select class="form-select" id="category-active">
                        </select>
                    </div> --}}
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
                        <input type="text" class="form-control" id="active_place"
                            placeholder="เช่น ห้องIT, ห้องวิจัย" style="background-color: #f2f3f5;font-size: .875rem;"
                            oninput="checkInputActive()">

                        <span class="input-invalid" id="place_active">กรุณากรอกข้อมูลให้ครบ</span>
                    </div>

                    <div class="mb-3">
                        <label for="ResponsiblePerson-active" class="form-label">ผู้รับผิดชอบ</label>
                        <select class="form-select" id="ResponsiblePerson-active" placeholder="ค้นหารายชื่อ...">
                        </select>
                    </div>
                    <button type="button" class="btn w-full btn-save-asset mt-3" onclick="activeAsset()"
                        style="height: 44px;color:#fff;background-color:#6857E8;">
                        <i class="fa-regular fa-circle-check pe-2"></i>บันทึก</button>

                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        function checkInput() {
            let check = false;
            if (document.getElementById('active_place').value === '') {
                Swal.fire({
                    title: "กรุณากรอกสถานที่ใช้งาน!",
                    confirmButtonText: "ตกลง",
                });
            } else {
                check = true;
            }
            return check;
        }

        function checkInputActive() {

            const activePlaceInput = document.getElementById('active_place');
            const placeActiveSpan = document.getElementById('place_active');

            if (activePlaceInput.value === '') {
                placeActiveSpan.classList.remove('d-none');
            } else {
                placeActiveSpan.classList.add('d-none');
            }
        }

        function fetchCategory() {
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
                        $('#category-active').append(`
                        <option value="${items.idAssType}" selected>${items.AssTypeName}</option>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchUser() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/user/fullname",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(user) {
                    $('#ResponsiblePerson-active').empty();

                    $.each(user, function(index, users) {
                        $('#ResponsiblePerson-active').append(`
                        <option value="${users.idPs}" ${users.idPs === asset.idPsRp ? 'selected' : ''}>${users.PsNameFS}</option>
                        `);
                    });
                    new TomSelect("#ResponsiblePerson-active", {
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

        /* save active asset */

        function active_asset_show() {
            fetchUser();
            $('#active-old-asset').modal('show');
        }

        function activeAsset() {
            // 1. to idPsRp on AssAssetD
            // 2. to Asset_Components | acs_name, asset_d , acs_id, location
            // 3. to Asset_Component_History | acs_id, acs_name, ac_id, location_history
            let data = checkInput();
            if (data === true) {
                let activeData = new FormData();
                activeData.append('idAsset', {{ $idAsset }});
                activeData.append('active_name', document.getElementById('inAssetName_active').value);
                activeData.append('active_place', document.getElementById('active_place').value);
                activeData.append('active_status', document.getElementById('inAssetStatus').value);
                activeData.append('active_rsp', document.getElementById('ResponsiblePerson-active').value);

                $.ajax({
                    type: "POST",
                    url: "/assets/detail/active",
                    data: activeData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response, textStatus, xhr) {
                        // console.log(response);
                        if (xhr.status === 201 && response.status === 'success') {
                            $('#active-old-asset').modal('hide');
                            Swal.fire({
                                icon: "success",
                                title: "ACtive สำเร็จ!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else if (xhr.status === 201 && response.status === 'wn') {
                            $('#active-old-asset').modal('hide');
                            Swal.fire({
                                icon: "warning",
                                title: "สินทรัพย์ถูกยืนยันแล้ว",
                                showConfirmButton: true,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
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
            }
        }
    </script>
@endpush
