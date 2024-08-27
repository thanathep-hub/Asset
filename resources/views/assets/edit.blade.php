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
<div class="modal fade" id="edit-asset" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> {{-- modal-fullscreen-sm-down --}}
        <div class="modal-content modal-content-active border-0">
            <div class="modal-header border-0" style="background-color: #f3f1ff;">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight: 700;color: #58d090;"><img
                        class="pe-2" src="{{ asset('assets/note.png') }}" height="28px">อัพเดท</h1>
                <button type="button" class="btn-close-new-asset" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body p-4">
                <form action="javascript:updateAsset()">
                    <div class="mb-3">
                        <label for="edit-name-asset" class="form-label">ชื่อสินทรัพย์</label>
                        <input type="text" class="form-control" id="edit-name-asset">
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="edit-price-asset" class="form-label">ราคา</label>
                            <input type="number" class="form-control" id="edit-price-asset">
                        </div>
                        <div class="col-6">
                            <label for="edit-amount-asset" class="form-label">จำนวน</label>
                            <input type="number" class="form-control" id="edit-amount-asset">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-category-asset" class="form-label">ประเภทสินทรัพย์</label>
                        <select class="form-select" id="edit-category-asset">
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6"><label for="inAssetStatus" class="form-label">สถานะ</label>
                            <select class="form-select" id="inAssetStatus">
                                <option value="1">ใช้งานอยู่</option>
                                <option value="2">เสียหาย</option>
                                <option value="3">เปลี่ยน</option>
                                <option value="4">ขายแล้ว</option>
                                <option value="5">ซ่อมบำรุง</option>
                                <option value="6">หมดอายุการใช้งาน</option>
                            </select>
                        </div>

                    </div>
                    <div class="mb-3 row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="edit-company-asset" class="form-label">บริษัท</label>
                            <select class="form-select" id="edit-company-asset" placeholder="ค้นหาบริษัท..." required>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="edit-psrp-asset" class="form-label">ผู้รับผิดชอบ</label>
                            <select class="form-select" id="edit-psrp-asset" placeholder="ค้นหารายชื่อ..." required>
                            </select>
                        </div>

                    </div>
                    <div class="mb-4">
                        <label for="edit-place-asset" class="form-label">สถานที่ใช้งาน</label>
                        <input type="text" class="form-control" id="edit-place-asset" placeholder="เช่น ห้อง IT"
                            required style="background-color: #f2f3f5;font-size: .875rem;">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="edit-psrp-asset" class="form-label">ผู้รับผิดชอบ</label>
                        <select class="form-select" id="edit-psrp-asset" placeholder="ค้นหารายชื่อ...">
                        </select>
                    </div> --}}
                    <div class="mb-3" style="text-align: end;">
                        <button type="submit" class="btn"
                            style="height: 44px;min-width:100px;color:#fff;background-color:#6857E8;"><i
                                class="fa-regular fa-floppy-disk pe-2"></i>อัพเดท</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        function fetchCategory() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/asset/catagory",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(catagory) {
                    if ($('#edit-category-asset').data('tomSelect')) {
                        $('#edit-category-asset')[0].tomselect.destroy();
                    }
                    $('#edit-category-asset').empty();
                    $.each(catagory, function(index, items) {
                        $('#edit-category-asset').append(`
                            <option value="${items.idAssType}" ${items.idAssType === asset.idAssType ? 'selected' : ''}>${items.AssTypeName}</option>
                        `);
                    });
                    new TomSelect("#edit-category-asset", {
                        sortField: {
                            field: "text",
                            direction: "asc",
                        },
                        render: {
                            no_results: function(data, escape) {
                                return '<div class="no-results">ไม่พบชื่อประเภท</div>';
                            }
                        }
                    });

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchPsrp() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/user/fullname",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(user) {
                    $('#edit-psrp-asset').empty();

                    $.each(user, function(index, users) {
                        $('#edit-psrp-asset').append(`
                            <option value="${users.idPs}" ${users.idPs === asset.idPsRp ? 'selected' : ''}>${users.PsNameFS}</option>
                        `);
                    });

                    new TomSelect("#edit-psrp-asset", {
                        sortField: {
                            field: "text",
                            direction: "asc",
                        },
                        render: {
                            no_results: function(data, escape) {
                                return '<div class="no-results">ไม่พบชื่อพนักงาน</div>';
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchCompany() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/company",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(data) {

                    if ($('#edit--asset').data('tomSelect')) {
                        $('#edit-company-asset')[0].tomselect.destroy();
                    }
                    $('#edit-company-asset').empty();

                    $.each(data, function(index, comp) {
                        $('#edit-company-asset').append(`
                            <option value="${comp.idComp}" ${comp.idComp === asset.idComp ? 'selected' : ''}>${comp.CompName}</option>
                        `);
                    });

                    new TomSelect("#edit-company-asset", {
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


        function editAssetM() {
            //
            fetchCategory();
            fetchCompany();
            fetchPsrp();

            document.getElementById("edit-name-asset").value = asset.AssetName;
            document.getElementById("edit-price-asset").value = parseFloat(asset.Price);
            document.getElementById("edit-amount-asset").value = parseInt(asset.AssAmount);
            $('#edit-asset').modal('show');
        }

        function updateAsset() {
            $('#edit-asset').modal('hide');
            location.reload();
        }
    </script>
@endpush
