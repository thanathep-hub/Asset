<style>
    /*  */
    .t-gray {
        color: #808080a1;
    }

    tr:last-child td {
        border: none;
    }

    tr {
        white-space: nowrap;
    }

    td {
        align-content: center;
    }

    .text-center {
        text-align: center;
    }

    /* append row table */
    .fade-in {
        opacity: 0;
        transition: opacity 1s ease-in-out;
        /* Adjust duration as needed */
    }

    .fade-in.visible {
        opacity: 1;
    }

    tr.goToEditAsset.visible {
        height: 46px;
    }

    td {
        max-width: 200px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }


    .goToEditAsset:hover {
        cursor: pointer;
        background-color: #fef9c3;
    }
</style>
<div class="asset-m"> {{-- แสดงรายากรที่เพิ่มเข้ามาใหม่กับรายการที่ยังไม่ยืนยัน --}}

    <div class="section-first mb-4">
        <h5 class="title">สินทรัพย์ที่ยืนยันล่าสุด <img class="ps-1" src="{{ asset('assets/validity.png') }}"
                height="28px"></h5>
        <div class="table-responsive">
            <table class="table" id="asset-approve">
                <thead>
                    <tr>
                        <th scope="col" class="t-gray">ชื่อ</th>
                        <th scope="col" class="t-gray">วันที่</th>
                        <th scope="col" class="t-gray text-center">สถานะ</th>
                        <th scope="col" class="t-gray">สถานที่ใช้งาน</th>
                        {{-- <th scope="col" class="t-gray text-center">จัดการ</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr class="goToEditAsset">
                        <td>
                            <img src="{{ asset('assets/box.png') }}" class="pe-2" height="24">
                            กำลังโหลด...
                        </td>
                        <td>
                            <i class="fa-solid fa-calendar-days pe-2"></i>กำลังโหลด...
                        </td>
                        <td class="text-center"><i class="fa-solid fa-circle pe-2"
                                style="color: #34d399;font-size:8px;"></i>กำลังโหลด...</td>
                        <td>กำลังโหลด...</td>
                        {{-- <td class="text-center">
                            <button class="btn btn-light">อัพเดท</button>
                        </td> --}}
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="section-second">
        <h5 class="title">สินทรัพย์ที่รอยืนยัน <img class="ps-1" src="{{ asset('assets/time.png') }}" height="28px">
        </h5>
        <div class="table-responsive">
            <table class="table" id="asset-wait-approve">
                <thead>
                    <tr>
                        <th scope="col" class="t-gray">ชื่อ</th>
                        <th scope="col" class="t-gray">วันที่</th>
                        <th scope="col" class="t-gray text-center">สถานะ</th>
                        <th scope="col" class="t-gray">สถานที่ใช้งาน</th>
                        {{-- <th scope="col" class="t-gray text-center">จัดการ</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="{{ asset('assets/box.png') }}" class="pe-2" height="24">
                            กำลังโหลด...
                        </td>
                        <td>
                            <i class="fa-solid fa-calendar-days pe-2"></i>กำลังโหลด...
                        </td>
                        <td class="text-center"><i class="fa-solid fa-circle pe-2"
                                style="color: orange;font-size:8px;"></i>
                            กำลังโหลด...
                        </td>
                        <td>กำลังโหลด...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    //

    window.onload = function() {
        fetch_wait_approve();
        fetch_approve();
    };

    function fetch_approve() {
        $.ajax({
            type: "GET",
            url: "/api/assets/fetch-approve",
            success: function(response) {
                if (response.status === "success") {
                    response.data.forEach(function(asset, index) {
                        let idAsset = asset.idAsset ? asset.idAsset : "รอการอัพเดท";
                        let assetName = asset.AssetName ? asset.AssetName : "รอการอัพเดท";
                        let assDate = asset.AssDate ? asset.AssDate : "รอการอัพเดท";
                        let location = asset.location ? asset.location : "รอการอัพเดท";
                        let acs_id = asset.acs_id ? asset.acs_id : "รอการอัพเดท";
                        let acs_name_th = asset.acs_name_th ? asset.acs_name_th : "รอการอัพเดท";

                        let row = `<tr class="goToEditAsset" onclick="goToEditAsset(${idAsset})">
                            <td>
                                <img src="{{ asset('assets/box.png') }}" class="pe-2" height="24">
                                ${assetName}
                            </td>
                            <td>
                                <i class="fa-solid fa-calendar-days pe-2"></i>${assDate}
                            </td>
                            <td class="text-center"><i class="fa-solid fa-circle pe-2"
                                    style="color: #34d399;font-size:8px;"></i>
                                ${acs_name_th}
                            </td>
                            <td>${location}</td>

                        </tr>`;
                        /* <td class="text-center">
                                <button class="btn btn-light" onclick="goToEditAsset(${idAsset})">อัพเดท</button>
                            </td> */
                        // Append rows with a delay
                        $("#asset-approve tbody").empty();
                        setTimeout(function() {
                            $("#asset-approve tbody").append(row);
                            // Add 'visible' class after appending to trigger the fade-in
                            $("#asset-approve tbody tr:last-child").addClass(
                                'visible');
                        }, index * 75);
                    });
                } else if (response.status === "error") {
                    console.log("Error:", response.message);
                } else {
                    // Handle unexpected response
                    console.log("Unexpected response:", response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX Error:", textStatus, errorThrown);
            }
        });

    }

    function fetch_wait_approve() {
        $.ajax({
            type: "GET",
            url: "/api/assets/wait-approve",
            success: function(response) {
                if (response.status === "success") {

                    response.data.forEach(function(asset, index) {
                        let idAsset = asset.idAsset ? asset.idAsset : "รอการอัพเดท";
                        let assetName = asset.AssetName ? asset.AssetName : "รอการอัพเดท";
                        let assDate = asset.AssDate ? asset.AssDate : "รอการอัพเดท";
                        let location = asset.location ? asset.location : "รอการอัพเดท";
                        let acs_id = asset.acs_id ? asset.acs_id : "รอการอัพเดท";
                        let acs_name_th = asset.acs_name_th ? asset.acs_name_th : "รอการอัพเดท";

                        let row = `<tr class="goToEditAsset" onclick="goToEditAsset(${idAsset})">
                            <td>
                                <img src="{{ asset('assets/box.png') }}" class="pe-2" height="24">
                                ${assetName}
                            </td>
                            <td>
                                <i class="fa-solid fa-calendar-days pe-2"></i>${assDate}
                            </td>
                            <td class="text-center"><i class="fa-solid fa-circle pe-2"
                                    style="color: orange;font-size:8px;"></i>
                                ${acs_name_th}
                            </td>
                            <td>${location}</td>

                        </tr>`;
                        /* <td class="text-center">
                                <button class="btn btn-light" onclick="goToEditAsset(${idAsset})">อัพเดท</button>
                            </td> */
                        // Append rows with a delay
                        $("#asset-wait-approve tbody").empty();
                        setTimeout(function() {
                            $("#asset-wait-approve tbody").append(row);
                            // Add 'visible' class after appending to trigger the fade-in
                            $("#asset-wait-approve tbody tr:last-child").addClass(
                                'visible');
                        }, index * 75);
                    });
                } else if (response.status === "error") {
                    console.log("Error:", response.message);
                } else {
                    // Handle unexpected response
                    console.log("Unexpected response:", response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX Error:", textStatus, errorThrown);
            }
        });

    }

    function goToEditAsset(idAsset) {
        window.location.href = '/assets/detail/' + idAsset;
    }
</script>
