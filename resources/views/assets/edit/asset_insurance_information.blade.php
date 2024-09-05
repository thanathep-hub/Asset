{{-- ข้อมูลประกัน --}}

<style>
</style>

<div class="modal fade" id="edit-insurance-information" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id=""><img class="pe-2" src="{{ asset('assets/maintenance.png') }}"
                        height="28px">ข้อมูลประกัน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="javascript:edii_save()">
                    <div class="mb-3">
                        <label for="update-asset-insurancestatus" class="form-label">สถานะ</label>
                        <select class="form-select" id="update-asset-insurancestatus">
                            <option value="0">ไม่มีประกัน</option>
                            <option value="1">มีประกัน</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="update-asset-insurancestart" class="form-label">วันที่เริ่มประกัน</label>
                        <input type="date" class="form-control" id="update-asset-insurancestart" required>
                    </div>
                    <div class="mb-3">
                        <label for="update-asset-insuranceend" class="form-label">วันที่หมดประกัน</label>
                        <input type="date" class="form-control" id="update-asset-insuranceend" required>
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
    async function edit_insurance_information() {
        edii_fetch();
        $('#edit-insurance-information').modal('show');
    }

    function edii_fetch() {
        document.getElementById("update-asset-insurancestatus").value = asset.stIns ? asset.stIns : "0";
        if (asset.DateInsur1 != null) {
            var rawValue = asset.DateInsur1; //"25670713";
            var year = rawValue.substring(0, 4) - 543;
            var month = rawValue.substring(4, 6);
            var day = rawValue.substring(6, 8);
            document.getElementById("update-asset-insurancestart").value = year + '-' + month + '-' + day;
        }
        if (asset.DateInsur2 != null) {
            var rawValue = asset.DateInsur2; //"25670713";
            var year = rawValue.substring(0, 4) - 543;
            var month = rawValue.substring(4, 6);
            var day = rawValue.substring(6, 8);
            document.getElementById("update-asset-insuranceend").value = year + '-' + month + '-' + day;
        }
    }

    function convertToBE(dateStr) {
        const [year, month, day] = dateStr.split('-');
        const beYear = parseInt(year) + 543;
        return `${beYear}${month}${day}`;
    }

    function edii_save() {
        const data = new FormData();
        data.append('uid', {{ $idAsset }});
        data.append('uinsur', document.getElementById('update-asset-insurancestatus').value);
        data.append('uins', convertToBE(document.getElementById('update-asset-insurancestart').value));
        data.append('uine', convertToBE(document.getElementById('update-asset-insuranceend').value));
        console.log(document.getElementById('update-asset-insurancestatus').value, convertToBE(document.getElementById(
            'update-asset-insurancestart').value), convertToBE(document.getElementById(
            'update-asset-insuranceend').value));


        $.ajax({
            type: "POST",
            url: "/assets/detail/edii_save",
            data: data,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);

                if (response.status === 'success') {
                    $('#edit-insurance-information').modal('hide');
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
