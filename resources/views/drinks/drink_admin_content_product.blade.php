<style>
    .list-product-admin {
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

    .list-product-menu-admin {
        box-shadow: 0 0.5rem 1rem #2125292b;
        border-radius: 14px;
        margin-top: 0.5rem;
        margin-left: 1rem;
        margin-right: 1rem;
        /* background-color: #00ff9854; */
        background-color: #19875426;
    }

    .product-index {
        font-family: math;
        font-size: smaller;
        font-weight: 700;
        color: #004f2f;
        padding-left: 0.5rem;
    }

    .product-detail {
        padding: unset;
        padding-left: 0.5rem;
        margin: unset;
        font-family: math;
        font-size: smaller;
        font-weight: 700;
        color: #004f2fc9;
    }

    .fw-900 {
        font-weight: 900;
    }

    .form-product {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--bs-body-color);
        background-color: var(--bs-form-control-bg);
        background-clip: padding-box;
        border: 1px solid #00653d;
        font-weight: 900;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: .375rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;

    }
</style>
<div class="content" id="show_menu_product" style="display: none;">
    <div class="row">
        <div class="col-12">
            <div class="nav-list d-flex align-items-center justify-content-between">
                <label class="fw-900 list-product-admin mb-0">
                    รายการเมนู
                </label>
                <button class="btn fw-900" type="button" onclick="formProduct()"
                    style="background:#00653d;color:white;float: inline-end;text-wrap:nowrap;margin-right:1rem;margin-top:0.5rem;border-radius:14px;">เพิ่มเมนู</button>
            </div>
        </div>
    </div>


    {{-- list order --}}
    <div id="menu_list">
        {{-- for product list show --}}
    </div>

    {{--  --}}
    <div class="modal fade" id="product-list-detail" tabindex="-1" aria-labelledby="product-list-detail"
        aria-hidden="false">
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
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <select id="menu_select" class="form-select fw-900" aria-label="Default select example">
                            {{-- <option selected>ประเภท</option> --}}
                            {{-- <option value="1">เมนูแนะนำ</option> --}}
                            <option value="2">หมวดกาแฟ</option>
                            <option value="3">หมวดชา</option>
                            <option value="4">นม/โกโก้</option>
                            <option value="5">สมูทตี้</option>
                            <option value="6">ผลไม้ปั่น</option>
                            <option value="8">อิตาเลี่ยนโซดา</option>
                        </select>
                    </div>
                    <input type="text" id="pd_id" name="pd_id" hidden>
                    <div class="mb-3">
                        <label for="pd_name" class="form-label fw-900" style="float: inline-start;">ชื่อเมนู</label>
                        <input type="text" class="form-product" id="pd_name" name="pd_name">
                    </div>
                    <div class="mb-3">
                        <label for="pd_number" class="form-label fw-900" style="float: inline-start;">ราคา</label>
                        <input type="number" class="form-product" id="pd_price" name="pd_price">
                    </div>

                </div>

                <div class="modal-footer"
                    style="1px solid #80808094;width: 100%;justify-content: space-between;justify-content: center;">
                    <div class="row justify-content-center" style="max-width: 100%">
                        <div class="col-auto">
                            <button type="button" class="btn" id="ccOrder1" onclick="updateProduct()"
                                style="background-color: #04764e; color: white; font-weight: 700; text-wrap: nowrap;width: 5rem;">
                                <label for="" class="ml-4">บันทึก</label>
                            </button>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn" id="ccOrder2" onclick="deleteProduct()"
                                style="background-color: #dc3545; color: white; font-weight: 700; text-wrap: nowrap;width: 5rem;">
                                <label for="" class="ml-4">ลบ</label>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="product-add-menu" tabindex="-1" aria-labelledby="product-add-menu" aria-hidden="false">
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
                </div>
                <div class="modal-body">
                    {{-- <option selected>ประเภท</option> --}}
                    {{-- <option value="0">เมนูแนะนำ</option> --}}
                    <div class="mb-3">
                        <select id="add_pd_cat_select" class="form-select fw-900"
                            aria-label="Default select example">
                            <option value="2">หมวดกาแฟ</option>
                            <option value="3">หมวดชา</option>
                            <option value="4">นม/โกโก้</option>
                            <option value="5">สมูทตี้</option>
                            <option value="6">ผลไม้ปั่น</option>
                            <option value="8">อิตาเลี่ยนโซดา</option>
                        </select>
                    </div>
                    {{-- <input type="text" id="add_pd_name" name="add_pd_name" hidden> --}}
                    <div class="mb-3">
                        <label for="add_pd_name" class="form-label fw-900" style="float: inline-start;">ชื่อ</label>
                        <input type="text" class="form-product" id="add_pd_name" name="add_pd_name">
                    </div>
                    <div class="mb-3">
                        <label for="add_pd_price" class="form-label fw-900" style="float: inline-start;">ราคา</label>
                        <input type="number" class="form-product" id="add_pd_price" name="add_pd_price">
                    </div>

                </div>

                <div class="modal-footer"
                    style="1px solid #80808094;width: 100%;justify-content: space-between;justify-content: center;">
                    <div class="row justify-content-center" style="max-width: 100%">
                        <div class="col-auto">
                            <button type="button" class="btn" id="ccOrder1" onclick="addProduct()"
                                style="background-color: #04764e; color: white; font-weight: 700; text-wrap: nowrap;width: 5rem;">
                                <label for="" class="ml-4">เพิ่ม</label>
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
        getMenu();
    });

    function getMenu() {
        $.ajax({
            url: "{{ route('AdminGetMenu') }}",
            type: "GET",
            dataType: "json", // ระบุประเภทข้อมูลที่ต้องการรับกลับมา
            success: function(response) {
                // การประมวลผลข้อมูลที่ได้รับกลับมา
                console.log(response);
                addMenuList(response)
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function addMenuList(data) {
        $("#menu_list").empty();
        $.each(data, function(index, item) {
            var text = `<div class="list-product-menu-admin">
                        <div class="row align-items-center">
                        <div class="col text-start pl-4 item-list">
                        <h6 class="product-index">${item.name_product_drink}</h6>
                        <p class="product-detail">ราคา ${item.price_product_drink} บาท </p>
                        </div>
                        <div class="col-auto">
                        <button class="btn" onclick="show_product_detail('${item.id_product_drink}')">
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
                        `;
            $("#menu_list").append(text);
        });

    }

    function show_product_detail(val) {
        getdatapdDetail(val);
        $('#product-list-detail').modal('show');
    }

    function getdatapdDetail(id) {
        console.log(id);
        $.ajax({
            url: "/drink/admin/getMenubyID/" + id,
            type: "GET",
            success: function(response) {
                console.log(response);
                document.getElementById("menu_select").querySelector("option[value='" + response
                    .cat_product_drink + "']").selected = true;
                $("#pd_id").val(response.id_product_drink);
                $("#pd_name").val(response.name_product_drink);
                $("#pd_price").val(response.price_product_drink);
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }

    function updateProduct() {

        var menu_select = null; // สร้างตัวแปรเพื่อเก็บค่าของ option ที่เลือกไว้
        $('#menu_select').each(function() {
            menu_select = $(this).val(); // เก็บค่าของ option ที่เลือกไว้
            return false; // หยุดการวนลูปเมื่อเจอ option ที่เลือกไว้แล้ว
        });

        var pd_id = $("#pd_id").val();
        var pd_name = $("#pd_name").val();
        var pd_price = $("#pd_price").val();

        var data = {
            pd_id: pd_id,
            menu_select: menu_select,
            pd_name: pd_name,
            pd_price: pd_price
        };

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/drink/admin/updateMenu",
            type: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log(response);
                $('#product-list-detail').modal('hide');
                getMenu();
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }

    function deleteProduct() {
        var pd_id = $("#pd_id").val();
        var data = {
            pd_id: pd_id,
        };

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/drink/admin/deleteMenu",
            type: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log(response);
                $('#product-list-detail').modal('hide');
                getMenu();
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }

    function formProduct() {
        $('#product-add-menu').modal('show');
    }

    function addProduct() {
        var add_pd_cat_select = null; // สร้างตัวแปรเพื่อเก็บค่าของ option ที่เลือกไว้
        $('#add_pd_cat_select').each(function() {
            add_pd_cat_select = $(this).val(); // เก็บค่าของ option ที่เลือกไว้
            return false; // หยุดการวนลูปเมื่อเจอ option ที่เลือกไว้แล้ว
        });

        var add_pd_name = $("#add_pd_name").val();
        var add_pd_price = $('#add_pd_price').val();
        var data = {
            add_pd_cat_select: add_pd_cat_select, // นำค่าของ option ที่เลือกไว้มาใช้
            add_pd_name: add_pd_name,
            add_pd_price: add_pd_price,
        };

        console.log(data);
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/drink/admin/addMenu",
            type: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log(response);
                if (response.status === 'noadd') {
                    $('#product-add-menu').modal('hide');
                    // alert('ไม่สามารถเพิ่มข้อมูลได้');
                } else {
                    $('#product-add-menu').modal('hide');
                    getMenu();
                }

            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }
</script>
