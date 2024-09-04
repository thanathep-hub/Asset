{{-- ข้อมูลพื้นฐานของสินทรัพย์ --}}

<style>
</style>

<div class="modal fade" id="edit-basic-information" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id=""><img class="pe-2" src="{{ asset('assets/info.png') }}"
                        height="28px">ข้อมูลพื้นฐานของสินทรัพย์</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="javascript:edbi_save()">
                    <div class="mb-3">
                        <label for="asset-name" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" id="update-asset-name" style="border-radius: 8px;"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="update-asset-category" class="form-label">ประเภทสินทรัพย์</label>
                        <select class="form-select" id="update-asset-category">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="update-asset-amount" class="form-label">จำนวน</label>
                        <input type="number" class="form-control" id="update-asset-amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="update-asset-place" class="form-label">สถานที่ใช้งาน</label>
                        <input type="text" class="form-control" id="update-asset-place" placeholder="เช่น ห้อง IT"
                            required style="background-color: #f2f3f5;font-size: .875rem;">
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
    async function edit_basic_information() {
        edbi_fetch();
        await edbi_fetch_category();
        $('#edit-basic-information').modal('show');
    }

    function edbi_fetch() {
        document.getElementById("update-asset-name").value = asset.AssetName;
        document.getElementById("update-asset-amount").value = parseInt(asset.AssAmount);
    }

    function edbi_fetch_category() {
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

    function edbi_save() {
        const data = new FormData();
        data.append('uid', {{ $idAsset }});
        data.append('uname', document.getElementById('update-asset-name').value);
        data.append('ucategory', document.getElementById('update-asset-category').value);
        data.append('uamount', document.getElementById('update-asset-amount').value);
        data.append('uplace', document.getElementById('update-asset-place').value);

        $.ajax({
            type: "POST",
            url: "/assets/detail/edbi_save",
            data: data,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);

                if (response.status === 'success') {
                    $('#edit-basic-information').modal('hide');
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
