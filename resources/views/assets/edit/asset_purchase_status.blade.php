{{-- การจัดซื้อและสถานะ --}}

<style>
</style>

<div class="modal fade" id="edit-purchase-status" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id=""><img class="pe-2"
                        src="{{ asset('assets/shopping-bag.png') }}" height="28px">การจัดซื้อและสถานะ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="javascript:edps_save()">
                    <div class="mb-3">
                        <label for="update-asset-comp" class="form-label">บริษัท</label>
                        <select class="form-select" id="update-asset-comp">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="update-asset-psrp" class="form-label">ผู้จัดซื้อ</label>
                        <select class="form-select" id="update-asset-psrp">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="update-asset-status" class="form-label">สถานะ</label>
                        <select class="form-select" id="update-asset-status">
                            <option value="1">ใช้งานอยู่</option>
                            <option value="2">เสียหาย</option>
                            <option value="3">เปลี่ยน</option>
                            <option value="4">ขายแล้ว</option>
                            <option value="5">ซ่อมบำรุง</option>
                            <option value="6">หมดอายุการใช้งาน</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="update-asset-asdate" class="form-label">วันที่ซื้อ หรือ วันที่เริ่มใช้</label>
                        <input type="date" class="form-control" id="update-asset-asdate" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn"
                            style="min-width: 160px;min-height: 44px;background-color: #262f40;color:#fff;"><i
                                class="fa-solid fa-floppy-disk pe-2"></i>อัพเดท</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    async function edit_purchase_status() {
        edps_fetch();
        await edps_fetch_comp();
        await edps_fetch_psrp();
        $('#edit-purchase-status').modal('show');
    }

    function edps_fetch() {
        if (asset.AssDate != null) {
            var rawValue = asset.AssDate; //"25670713";
            var year = rawValue.substring(0, 4) - 543;
            var month = rawValue.substring(4, 6);
            var day = rawValue.substring(6, 8);
            document.getElementById("update-asset-asdate").value = year + '-' + month + '-' + day;
        }
    }

    function edps_fetch_category() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/api/asset/catagory",
            type: 'GET',
            headers: {
                'X-CSRF-Token': csrfToken
            },
            success: function(catagory) {
                if ($('#update-asset-category').data('tomSelect')) {
                    $('#update-asset-category')[0].tomselect.destroy();
                }
                $('#update-asset-category').empty();
                $.each(catagory, function(index, items) {
                    $('#update-asset-category').append(`
                            <option value="${items.idAssType}" ${items.idAssType === asset.idAssType ? 'selected' : ''}>${items.AssTypeName}</option>
                        `);
                });
                new TomSelect("#update-asset-category", {
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

    function edps_fetch_comp() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/api/company",
            type: 'GET',
            headers: {
                'X-CSRF-Token': csrfToken
            },
            success: function(data) {
                $('#update-asset-comp').empty();
                $.each(data, function(index, items) {
                    $('#update-asset-comp').append(`
                        <option value="${items.idComp}" ${items.idComp === asset.idComp ? 'selected' : ''}>${items.CompName}</option>
                        `);
                });
                new TomSelect("#update-asset-comp", {
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

    function edps_fetch_psrp() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/api/user/fullname",
            type: 'GET',
            headers: {
                'X-CSRF-Token': csrfToken
            },
            success: function(data) {
                $('#update-asset-psrp').empty();
                $.each(data, function(index, items) {
                    $('#update-asset-psrp').append(`
                        <option value="${items.idPs}" ${items.idPs === asset.idPsRp ? 'selected' : ''}>${items.PsNameFS}</option>
                        `);
                });
                new TomSelect("#update-asset-psrp", {
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

    function convertToBE(dateStr) {
        // แยกปี, เดือน, วัน
        const [year, month, day] = dateStr.split('-');

        // แปลงปีจาก ค.ศ. เป็น พ.ศ.
        const beYear = parseInt(year) + 543;

        // รวมปี, เดือน, วันในรูปแบบที่ต้องการ
        return `${beYear}${month}${day}`;
    }



    function edps_save() {
        const data = new FormData();
        data.append('uid', {{ $idAsset }});
        data.append('upsrp', document.getElementById('update-asset-psrp').value);
        data.append('ustatus', document.getElementById('update-asset-status').value);
        data.append('udate', convertToBE(document.getElementById('update-asset-asdate').value));


        $.ajax({
            type: "POST",
            url: "/assets/detail/edps_save",
            data: data,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);

                if (response.status === 'success') {
                    $('#edit-purchase-status').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: response.msg,
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (response.status === 'error') {
                    Swal.fire({
                        icon: "warning",
                        title: response.msg,
                        showConfirmButton: true,
                        confirmButtonText: 'ตกลง',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log("Error: ", xhr.responseText);
                console.log("Status: ", xhr.status);
            }
        });

    }
</script>
