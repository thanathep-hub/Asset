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
</style>
<div class="asset-m"> {{-- แสดงรายากรที่เพิ่มเข้ามาใหม่กับรายการที่ยังไม่ยืนยัน --}}

    <div class="section-first mb-4">
        <h5 class="title">สินทรัพย์ที่ยืนยันล่าสุด <img class="ps-1" src="{{ asset('assets/validity.png') }}"
                height="28px"></h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="t-gray">ชื่อ</th>
                        <th scope="col" class="t-gray">วันที่</th>
                        <th scope="col" class="t-gray text-center">สถานะ</th>
                        <th scope="col" class="t-gray">สถานที่ใช้งาน</th>
                        <th scope="col" class="t-gray text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="{{ asset('assets/box.png') }}" class="pe-2" height="24">
                            พัดลมบ้าน 16 นิ้ว ฮาตาริ
                        </td>
                        <td>
                            <i class="fa-solid fa-calendar-days pe-2"></i>09-07-2567
                        </td>
                        <td class="text-center"><i class="fa-solid fa-circle pe-2"
                                style="color: orange;font-size:8px;"></i>รอการอัพเดท</td>
                        <td>รอการอัพเดท</td>
                        <td class="text-center">
                            <button class="btn btn-light">อัพเดท</button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="{{ asset('assets/box.png') }}" class="pe-2" height="24">
                            พัดลมบ้าน 16 นิ้ว ฮาตาริ
                        </td>
                        <td>
                            <i class="fa-solid fa-calendar-days pe-2"></i>09-07-2567
                        </td>
                        <td class="text-center"><i class="fa-solid fa-circle pe-2"
                                style="color: orange;font-size:8px;"></i>รอการอัพเดท</td>
                        <td>รอการอัพเดท</td>
                        <td class="text-center">
                            <button class="btn btn-light">อัพเดท</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="section-second">
        <h5 class="title">สินทรัพย์ที่รอยืนยัน <img class="ps-1" src="{{ asset('assets/time.png') }}" height="28px">
        </h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="t-gray">ชื่อ</th>
                        <th scope="col" class="t-gray">วันที่</th>
                        <th scope="col" class="t-gray text-center">สถานะ</th>
                        <th scope="col" class="t-gray">สถานที่ใช้งาน</th>
                        <th scope="col" class="t-gray text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="{{ asset('assets/box.png') }}" class="pe-2" height="24">
                            พัดลมบ้าน 16 นิ้ว ฮาตาริ
                        </td>
                        <td>
                            <i class="fa-solid fa-calendar-days pe-2"></i>09-07-2567
                        </td>
                        <td class="text-center"><i class="fa-solid fa-circle pe-2"
                                style="color: orange;font-size:8px;"></i>รอการอัพเดท</td>
                        <td>รอการอัพเดท</td>
                        <td class="text-center">
                            <button class="btn btn-light">อัพเดท</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('assets/box.png') }}" class="pe-2" height="24">
                            พัดลมบ้าน 16 นิ้ว ฮาตาริ
                        </td>
                        <td>
                            <i class="fa-solid fa-calendar-days pe-2"></i>09-07-2567
                        </td>
                        <td class="text-center"><i class="fa-solid fa-circle pe-2"
                                style="color: orange;font-size:8px;"></i>รอการอัพเดท</td>
                        <td>รอการอัพเดท</td>
                        <td class="text-center">
                            <button class="btn btn-light">อัพเดท</button>
                        </td>
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
    };

    function fetch_wait_approve() {

        $.ajax({
            type: "GET",
            url: "/api/assets/wait-approve", // No dynamic ID
            success: function(response) {
                console.log(response);
                if (response.status === "success") {
                    // Handle success
                    console.log("Success:", response.message);
                    console.log("Asset Data:", response.data);
                } else if (response.status === "error") {
                    // Handle error
                    console.log("Error:", response.message);
                } else {
                    // Handle unexpected response
                    console.log("Unexpected response:", response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle AJAX error
                console.log("AJAX Error:", textStatus, errorThrown);
            }
        });


    }
</script>
