<style>
    .content {
        margin-top: 60px;
        margin-bottom: 5rem;
        margin-left: 0.5rem;
        margin-right: 0.5rem;
    }

    .list-order-admin {
        margin-top: 0.25rem;
        margin-bottom: 0.25rem;
        margin-left: 1rem;
        padding-top: 0.25rem;
        color: black;
        font-size: 14px;
        font-weight: 900;
        width: 100%;
        text-align: start;
    }

    .bi-pencil-square {
        height: 24px;
        width: 24px;
        fill: #00643c;
    }

    .item-list {
        padding: 1rem;
    }

    .order-detail {
        padding: unset;
        padding-left: 0.5rem;
        margin: unset;
        font-family: math;
        font-size: smaller;
        font-weight: 700;
        color: #004f2fc9;
    }

    .list-order-menu-admin {
        box-shadow: 0 0.5rem 1rem #2125292b;
        border-radius: 14px;
        margin-top: 0.5rem;
        margin-left: 1rem;
        margin-right: 1rem;
        /* background-color: #00ff9854; */
        background-color: #19875426;

    }

    .order-index {
        font-family: math;
        font-size: smaller;
        font-weight: 700;
        color: #004f2f;
    }

    .list-group-item {
        border-left: unset;
        border-right: unset;
        border-radius: unset;
    }

    .list-group-item:first-child {
        border-top: unset;
    }

    .list-group-item:last-child {
        border-bottom: unset;
    }

    .menuLabel {
        margin-top: 0.25rem;
        padding-top: 0.25rem;
        color: black;
        margin-bottom: 0.25rem;
        font-size: smaller;
        font-weight: 700;
        width: 100%;
        text-align: start;
    }

    button.btn.btn-menu.me-2 {
        width: 80px;
    }
</style>

<div class="content" id="show_order">
    <label class="fw-900 list-order-admin">
        รายการออเดอร์
    </label>
    {{-- list order --}}
    @forelse ($dataOrder as $items)
        <div class="list-order-menu-admin">
            <div class="row align-items-center">
                <div class="col m-2 text-start pl-4 item-list">
                    <h6 class="order-index">เลขที่ออเดอร์ #{{ $items->OrderID }}</h6>
                    <p class="order-detail">ผู้สั่ง : {{ $items->CustomerName }}</p>
                    <p class="order-detail">จำนวน {{ $items->TotalQuantity }} รายการ</p>
                    <p class="order-detail">วันที่ {{ $items->OrderDate }} เวลา {{ $items->OrderTime }}น.</p>
                </div>
                <div class="col-auto">
                    <button class="btn" onclick="order_detail('{{ $items->OrderID }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @empty
        {{--  --}}
    @endforelse


    {{--  --}}


</div>

<div class="modal fade" id="order-detail" tabindex="-1" aria-labelledby="OderDetails" aria-hidden="false">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content animate-bottom" style="background-color: #fff">
            <div class="modal-header">

                <button type="button" class="btn fw-900" data-bs-dismiss="modal" style="padding: unset;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="#04764e"
                        class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1" />
                    </svg>
                </button>

                <a class="modal-title fw-900" id="menuLabel"
                    style="color:black;padding-right: 1rem;font-weight:bold;font-size: 18px;text-decoration-line: none;">
                    รายละเอียดคำสั่งซื้อ
                </a>
            </div>
            <div class="modal-body">
                {{-- <label class="fw-900 menuLabel" id="menuLabel" style="">รายการเครื่องดื่ม</label> --}}
                <div id="head-order-detail" style="text-align: center;">
                    {{--  --}}
                </div>

                <label class="fw-900 menuLabel" id="menuLabel" style="">รายการเครื่องดื่ม</label>
                <div id="listOrderDetail">
                    <ol class="list-group list-group-numbered" id="listOrderDetails">

                    </ol>
                </div>

                <div class="row justify-content-start">
                    <label class="fw-900 menuLabel" id="menuLabel" style="">
                        ราคาสุทธิ : <span id="totalPriceOrderDetail" class="fw-900 menuLabel">90</span> บาท
                    </label>
                </div>


            </div>

            <div class="modal-footer"
                style="
                1px solid #80808094;
                width: 100%;
                justify-content: space-between;
                justify-content: center;
              ">
                <div class="row justify-content-center" style="max-width: 100%">
                    <div class="col-auto">
                        <button onclick="submitOrder()" type="button" class="btn" id="ccOrder1"
                            style="background-color: #04764e; color: white; font-weight: 700; text-wrap: nowrap;">
                            <label for="" class="ml-4">ยืนยันคำสั่งซื้อ</label>
                        </button>
                    </div>
                    <div class="col-auto">
                        <button onclick="cancelOrder()" type="button" class="btn" id="ccOrder2"
                            style="background-color: #dc3545; color: white; font-weight: 700; text-wrap: nowrap;">
                            <label for="" class="ml-4">ยกเลิกคำสั่งซื้อ</label>
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        console.log("หน้าเว็บโหลดเสร็จแล้ว");
    });

    function order_detail(id) {
        getOrderDetail(id);
        $('#order-detail').modal('show');
    }
    let OrderIdCancel;
    let cancelOrderId;

    function getOrderDetail(orderId) {
        var orderId = orderId.toString();
        OrderIdCancel = orderId;
        OrderIdSubmit = orderId;

        $.ajax({
            url: "{{ route('adminGetOderdetail') }}",
            method: "GET",
            data: {
                orderId: orderId,
            },
            success: function(data) {
                console.log(data);
                setOrderDetail(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

    }

    function setOrderDetail(data) {
        $("#head-order-detail").empty();
        $("#listOrderDetails").empty();
        var total = 0;
        var head =
            `<p class="order-index" style="margin-bottom: auto;color:#000;">เลขที่ออเดอร์ ${data.order.OrderID}</p>
            <p class="order-detail" style="color: gray;">ผู้สั่ง : ${data.order.CustomerName}</p>
            <p class="order-detail" style="color: gray;">วันที่ ${data.order.OrderDate} เวลา ${data.order.OrderTime}น.</p>`;

        $("#head-order-detail").append(head);
        $.each(data.details, function(index, item) {
            // สร้าง HTML element ใหม่สำหรับแต่ละสินค้า
            var newItem = $('<li class="list-group-item d-flex justify-content-between align-items-start">' +
                '<div class="ms-2 me-auto" style="font-size: 13px;">' +
                '<div class="fw-bold text-start">' + item.DrinkItem +
                '</div><p style="font-family: math;font - size: smaller; font - weight: 700; color: darkgray;">' +
                item.Type + ', ' + item.Sweetness + '%, ' + item.CupSize + ', ราคารวม ' + item.TotalPrice +
                '฿' +
                '<p></div>' +
                '<span class="badge bg-primary rounded-pill">' + item.Quantity + '</span>' +
                '</li>');

            // เพิ่มรายการใหม่ลงในลิสต์
            $("#listOrderDetails").append(newItem);

            // เพิ่ม totalPrice ของแต่ละสินค้าเข้าไปในผลรวม
            total += parseFloat(item.TotalPrice);

        });
        $("#totalPriceOrderDetail").text(total.toFixed(2));

    }

    function cancelOrder() {
        // Get the CSRF token value from the meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('OrderIdCancel') }}", // เปลี่ยนเส้นทาง URL ตามที่คุณต้องการ
            method: "POST",
            data: {
                OrderIdCancel: OrderIdCancel
            }, // ส่งค่า ID ไป
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            success: function(response) {
                console.log(response);
                if (response['status'] === "success") {
                    console.log("Data deleted successfully.");
                    $('#order-detail').modal('hide');
                    OrderIdCancel = 0;
                    OrderIdSubmit = 0;
                    location.reload();
                } else {
                    console.log("Data deleted error.");
                }

            },
            error: function(xhr, status, error) {
                // การประมวลผลเมื่อเกิดข้อผิดพลาดในการลบข้อมูล
                console.error(xhr.responseText);
            }
        });
    }

    function submitOrder() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('OrderSubmit') }}",
            method: "post",
            data: {
                OrderIdSubmit: OrderIdSubmit
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log(response);
                if (response['status'] === "success") {
                    console.log("Data updated successfully.");
                    $('#order-detail').modal('hide');
                    OrderIdSubmit = 0;
                    OrderIdCancel = 0;
                    location.reload();
                } else {
                    console.log("Data updated error.");
                }

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                console.log(status);
                console.error(error);
            }
        });
    }
</script>
