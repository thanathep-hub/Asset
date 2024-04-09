<style>
    .cartQuantity {
        position: fixed;
        bottom: 50px;
        right: 28px;
        color: white;
        background-color: tomato;
        border-radius: 14px;
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

    .listCart {
        font-weight: 700;
    }

    .mlmr {
        margin-left: unset;
        margin-right: unset;
    }

    .menuLabel {
        margin-top: 0.25rem;
        padding-top: 0.25rem;
        border-top: 1px solid lightgray;
        color: black;
        margin-bottom: 0.25rem;
        font-size: small;
        width: 100%;
        text-align: start;
    }

    /* CSS animation */
    @keyframes blink {
        0% {
            border-color: #57fdc4;
        }

        50% {
            border-color: #04764e;
        }

        100% {
            border-color: #0a311f;
        }
    }

    input.blink-border {
        animation: blink 1s infinite;
        border-width: 2px;
        /* กำหนดความหนาของเส้นขอบ */
        border-style: solid;
        /* กำหนดรูปแบบของเส้นขอบ */
        border-color: #0a311f;
        /* กำหนดสีเส้นขอบ */
    }

    svg.bi.bi-arrow-left-square-fill {
        border-radius: 24px;
        outline: unset;
    }

    .yellow-background {
        /* background-color: yellow; */
        border-color: #dc3545;
        color: #dc3545;
    }
</style>


<div id="buttonCart" class="cart" style="display: none;">
    <a onclick="showDetailsCart()" type="button" class="btn fw-bold button1" data-toggle="modal" data-target="#modal-lg"
        style="background-color: #fe9900; border-radius: 30px; padding: 12px;box-shadow: 0px 3px 3px 0px #fe99003b;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffffff" class="bi bi-cart2"
            viewBox="0 0 16 16">
            <path
                d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
        </svg>

    </a>
</div>
<span id="cartQuantity" class="cartQuantity badge fw-900" style="display: none;color: white;"></span>

{{-- modal cart --}}

<div class="modal fade cartModal" id="cart-detail" tabindex="-1" aria-labelledby="CartDetails" aria-hidden="false">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content animate-bottom" style="background-color: #fff">
            <div class="modal-header mlmr">

                <button type="button" class="btn fw-900" data-bs-dismiss="modal" style="padding: unset;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="#04764e"
                        class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1" />
                    </svg>
                </button>

                <h1 class="modal-title fs-3 fw-900" id="menuLabel" style="color:black;padding-right: 1rem;">
                    ตะกร้าสินค้า
                </h1>
                <button type="button" class="btn fw-900" onclick="deleteCart()"
                    style="
                    background-color:#ff8631;
                  color: white;
                ">
                    ลบคำสั่งซื้อ
                </button>
            </div>
            <div class="modal-body mlmr">
                <label class="fw-900" id="menuLabel"
                    style="
    margin-top: 0.25rem;
    padding-top: 0.25rem;
                  color: black;
                  margin-bottom: 0.25rem;
                  font-size: small;
                  width: 100%;
                  text-align: start;
                ">ชำระเงินผ่านพร้อมเพย์</label>
                <div id="imagePP" style="text-align: center;margin-bottom:0.5rem;border:1px solid #8080803b;">
                    <img src="{{ asset('images/pp.png') }}"
                        style="margin-top: 0.5rem;
    margin-bottom: 0.5rem;
    height: 200px;border:#05764f;">
                    <h5 class="fw-900">ยอดชำระ <span class="fw-900" id="TotalPriceOrder"></span> บาท</h5>
                    <label style="font-size: 14px;">หลังการจากโอนเงินเรียบร้อย</label></br>
                    <label style="font-size: 14px;">กรุณากดปุ่ม "ยืนยันการชำระเงิน"</label>
                </div>

                {{-- <div class="mb-3">
                    <label for="name" class="form-label fw-900">ชื่อผู้ทำรายการ</label>
                    <input type="text" class="form-control fw-900" id="nameCustomer"
                        style="font-size: 12px;" placeholder="โปรดระบุ..." autofocus>
                    <label for="name" class="form-label fw-900">ชื่อผู้ทำรายการ</label>
                    <input type="text" class="form-control fw-900" id="nameCustomer"
                        style="font-size: 12px;" placeholder="โปรดระบุ..." autofocus>
                </div> --}}

                <label class="fw-900 menuLabel" id="menuLabel">รายการเครื่องดื่ม</label>
                <div id="listCart">
                    <ol class="list-group list-group-numbered" id="listCartAndDetails">

                    </ol>
                </div>

                <div class="mb-3" style="border-top: 1px solid #8080803b">
                    <label for="name" class="form-label fw-900" style="font-size: 14px;">ชื่อผู้ทำรายการ</label>
                    <input type="text" class="form-control fw-900" id="nameCustomer" style="font-size: 12px;"
                        placeholder="โปรดระบุ..." autofocus>
                    <label for="name" class="form-label fw-900" style="font-size: 12px;">*หมายเหตุ(ถ้ามี)</label>
                    <textarea rows="2" class="form-control fw-900" id="note" style="font-size: 12px;" placeholder="โปรดระบุ..."></textarea>
                </div>

            </div>

            <div class="modal-footer"
                style="
                border-top: 1px solid #8080801f;
                width: 100%;
                justify-content: space-between;
              ">
                <button onclick="submitCart()" type="button" class="btn" id="ccOrder"
                    style="
                  background-color: #04764e;
                  color: white;
                  font-weight: 700;
                  text-wrap: nowrap;
                  width: 100%;
                ">
                    <label for="" class="ml-4" style="float: inline-start">ยืนยันการชำระเงิน</label>
                    <label style="float: inline-end">฿<span id="TotalPriceOrderBTN"></span></label>
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    let nameCustomer;

    function handleButtonState() {
        nameCustomer = $("#nameCustomer").val();
        if (nameCustomer === "") {
            $("#ccOrder").prop("disabled", true); // Disabling the button
        } else {
            $("#ccOrder").prop("disabled", false); // Enabling the button
        }
    }

    // handleButtonState();
    $("#nameCustomer").on("input", handleButtonState);

    function deleteCart() {
        cart = [];
        showCart();
        $("#listCartAndDetails").empty();
        $('#cart-detail').modal('hide');
    }

    function submitCart() {
        checkAndFocusInput();
        // call insert data order
        // insertCart();
        // //
        // cart = [];
        // showCart();
        // $("#listCartAndDetails").empty();
        // $('#cart-detail').modal('hide');
    }

    function checkAndFocusInput() {
        var inputElement = document.getElementById('nameCustomer');
        if (inputElement.value.trim() === '') {
            inputElement.focus();
        } else {
            insertCart();
            cart = [];
            showCart();
            $("#listCartAndDetails").empty();
        }
    }



    function showCart() {
        if (cart && cart.length > 0) {
            console.log("cart: ", cart);

            $("#cartQuantity").text(cart.length);

            document.getElementById('cartQuantity').style.display = 'flex';
            document.getElementById('buttonCart').style.display = 'flex';
        } else {
            document.getElementById('cartQuantity').style.display = 'none';
            document.getElementById('buttonCart').style.display = 'none';
        }
    }

    function showDetailsCart() {
        $("#listCartAndDetails").empty();
        var total = 0;
        $.each(cart, function(index, item) {
            // สร้าง HTML element ใหม่สำหรับแต่ละสินค้า
            var newItem = $(
                '<li class=" mlmr list-group-item d-flex justify-content-between align-items-start">' +
                '<div class="ms-2 me-auto" style="font-size: 13px;">' +
                '<div class="fw-bold">' + item.nameProduct +
                '</div><p style="font-family: math;font - size: smaller; font - weight: 700; color: darkgray;">' +
                item.type + ', ' + item.syrup + '%, ' + item.size + ', ราคา ' + item.totalPrice + '฿' +
                '<p></div>' +
                '<span class="badge bg-primary rounded-pill">' + item.quantity + '</span>' +
                '</li>');

            // เพิ่มรายการใหม่ลงในลิสต์
            $("#listCartAndDetails").append(newItem);

            // เพิ่ม totalPrice ของแต่ละสินค้าเข้าไปในผลรวม
            total += parseFloat(item.totalPrice);

        });

        $("#TotalPriceOrder").text(total.toFixed(2));
        $("#TotalPriceOrderBTN").text(total.toFixed(2));
        $('#cart-detail').modal('show');
        document.getElementById("nameCustomer").focus();


    }

    function insertCart() {

        var textarea = document.getElementById("note");
        var note = textarea.value;

        // Get the CSRF token value from the meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/insertCart",
            type: "POST",
            data: {
                cart: cart,
                nameCustomer: nameCustomer,
                note: note,
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            // dataType: "dataType",
            success: function(response) {
                console.log("from controller : ", response);
                window.location.href = '/drinks_success';
            },
            error: function(xhr, status, error) {
                // กรณีเกิดข้อผิดพลาด
                console.error(xhr.responseText);
            }
        });
    }

    /*   ---------------------------------------------------------------------------------------  */
</script>
