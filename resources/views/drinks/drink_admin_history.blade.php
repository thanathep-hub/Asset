<style>
    .his-list-item {
        font-family: math;
        font-size: smaller;
        font-weight: 700;
        color: #004f2f;
    }
</style>

<div id="show_history" style="margin-top: 4rem;">
    <div class="row">
        <div class="col-12">
            <div class="nav-list d-flex align-items-center" style="place-content: end;">
                <button class="btn fw-900" type="button" onclick="sumOrderDaily()"
                    style="background:#00653d;color:white;float: inline-end;text-wrap:nowrap;margin-right:1rem;margin-top:0.5rem;border-radius:14px;">สรุปยอด</button>
            </div>
        </div>
    </div>
    <ol class="list-group mt-2" id="history-item"> {{-- list-group-numbered --}}

    </ol>

    <div class="modal fade" id="sumOrder" tabindex="-1" aria-labelledby="sumOrder" aria-hidden="false"
        style="font-family: math;">
        <div class="modal-dialog modal-fullscreen-sm-down">
            <div class="modal-content animate-bottom" style="background-color: #fff">
                <div class="modal-header justify-content-center">
                    <label style="font-size: medium;font-weight: bold;">สรุปยอดขายวันที่
                        {{ \Carbon\Carbon::parse(now())->addYears(543)->format('d-m-Y') }} </label>
                </div>
                <div class="modal-body">

                    {{-- <div class="row justify-content-between"
                        style="font-weight: bold;border-bottom: 1px solid #80808063;padding-bottom: 1rem;font-size: smaller;">
                        <div class="col-auto">
                            <label id="Totalquantity">จำนวนยอดขาย </label>
                        </div>
                        <div class="col-auto">
                            <label id="totalPrice">รวมเป็นเงิน บาท</label>
                        </div>
                    </div> --}}

                    <table class="table" id="menuOrderSale" style="font-size: smaller;">
                        <thead>
                            <tr class="text-end" style="background-color: beige;">
                                <th scope="col">เมนู</th>
                                <th scope="col">จำนวนขาย</th>
                                <th scope="col">ยอดขาย</th>
                            </tr>
                        </thead>
                        <tbody id="detailsDaily">
                            {{--  --}}
                        </tbody>
                        {{-- <tbody>
                            <tr class="text-end" style="font-weight: bold;">
                                <td>รวม</td>
                                <td >2</td>
                                <td>50</td>
                            </tr>
                        </tbody> --}}
                    </table>

                    <div class="row justify-content-between"
                        style="font-weight: bold;border-bottom: 1px solid #80808063;padding-bottom: 0.5rem;padding-top: 0.5rem;font-size: smaller;margin-left: 1px;margin-right: 1px;background-color: #90ee9099;">
                        <div class="col-auto">
                            <label id="Totalquantity">จำนวนยอดขาย </label>
                        </div>
                        <div class="col-auto">
                            <label id="totalPrice">รวมเป็นเงิน บาท</label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer"
                    style="1px solid #80808094;width: 100%;justify-content: space-between;justify-content: center;">
                    <div class="row justify-content-center" style="max-width: 100%">
                        <div class="col-auto">
                            <button type="button" class="btn" data-bs-dismiss="modal"
                                style="background-color: #04764e; color: white; font-weight: 700; text-wrap: nowrap;width: 5rem;">
                                <label for="" class="ml-4">ปิด</label>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        getHistory();
    });

    function getHistory() {
        $.ajax({
            url: '{{ route('admin_get_history') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                addItemHistory(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function addItemHistory(data) {
        $("#history-item").empty(); // เคลียร์รายการประวัติทั้งหมดที่มีอยู่

        // วนลูปผ่านข้อมูลแต่ละรายการและสร้างรายการใหม่
        $.each(data, function(index, item) {
            var newItem = $(
                '<li class="list-group-item d-flex justify-content-between align-items-start" id="' + item
                .OrderID + '">' +
                '<div class="ms-2 me-auto">' +
                '<div class="fw-bold his-list-item">#' + item.OrderID + '</div>' +
                '<p class="his-list-item" style="margin: 0px;padding-left: 0.5rem;">ผู้สั่ง ' + item
                .CustomerName +
                '<p class="his-list-item" style="margin: 0px;padding-left: 0.5rem;">วันที่ ' + item
                .OrderDate + ' เวลา ' + item
                .OrderTime + 'น.</p>' +
                '<p class="his-list-item" style="margin: 0px;padding-left: 0.5rem;">จำนวน ' + item
                .TotalQuantity + ' รายการ รวมสุทธิ ' + item
                .TotalPrice + ' บาท</p>' +
                '</div>' +
                '<span class="badge bg-success rounded-pill">สำเร็จ</span>' +
                '</li>');

            $("#history-item").append(newItem); // เพิ่มรายการใหม่ลงในรายการประวัติ
        });
    }

    function sumOrderDaily() {

        $.ajax({
            type: "get",
            url: "{{ route('SumOrderDaily') }}",
            success: function(response) {
                console.log(response);
                addHeadDaily(response.OrderDaily);
                addItemDaily(response.Detaildaily);
            }
        });

        $('#sumOrder').modal('show');
    }

    function addHeadDaily(data) {
        document.getElementById('Totalquantity').textContent = 'จำนวนยอดขาย ' + data.TotalQuantity;
        document.getElementById('totalPrice').textContent = 'รวมเป็นเงิน ' + data.TotalPrice + ' บาท';
    }


    function addItemDaily(data) {
        $("#detailsDaily").empty();
        $.each(data, function(index, item) {
            var newItem = $(
                `<tr>
                <td class="text-end">${item.DrinkItem}</td>
                <td class="text-end">${item.TotalQuantity}</td>
                <td class="text-end">${item.TotalPrice}</td>
            </tr>`
            );

            $("#detailsDaily").append(newItem);
        });
    }
</script>
