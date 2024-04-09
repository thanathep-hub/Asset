@extends('layouts.master')
@section('title', 'การแจ้งเตือน')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <style>
        body {
            background-color: #f4f6f9;
        }

        table#listAll_table {
            font-size: 13px;
        }

        .table {
            margin-bottom: unset;
        }


        .text {
            max-width: 160px;
            /* กำหนดความยาวสูงสุดที่ text จะถูกแสดง */
            overflow: hidden;
            /* ซ่อนเนื้อหาที่เกินขอบตัวอักษร */
            text-overflow: ellipsis;
            /* แสดงเครื่องหมาย ... ถ้าเนื้อหาเกินขอบตัวอักษร */
            white-space: nowrap;
            /* ไม่ให้ข้อความขึ้นบรรทัดใหม่ */
        }

        @media only screen and (max-width: 992px) {
            .title-assett-active {
                text-align: center;
            }

            .content-wrapper>.content {
                padding: 0px;
            }

            .form-group.row {
                justify-content: start;
                padding: 0rem 1rem 1rem 0rem;
            }

            .input-detail-m {
                margin-left: unset;
            }
        }

        @media only screen and (min-width: 992px) {
            .form-group.row {
                justify-content: center;
            }

            .cm_detail {
                margin-left: 2rem;
            }

            .input-detail-m {
                margin-left: 0.5rem;
            }
        }

        .col-sm-12.col-md-6 {
            content-visibility: hidden;
        }

        .card {
            box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .vam_repair:hover {
            background-color: rgb(152, 238, 152);
            /* cursor: pointer; */
        }

        #searchFilter {
            background-color: #21b5ae;
            color: #ffffff;
        }

        #searchFilter:hover {
            filter: brightness(50%);
        }

        .brr {
            border-right: 1px solid #dee2e6;
        }

        .tac {
            text-align: center;
        }

        .tar {
            text-align: right;
        }

        /* preview area */
        .preview-area {
            display: flex;
            flex-wrap: wrap;
            padding: 0.5rem;
        }

        .preview-area img {
            width: 24%;
            /* margin: 0 0 10px; */
            object-fit: contain;
            cursor: zoom-in;
            border: 1px solid grey;
        }

        .preview-area img:not(:nth-child(4n)) {
            margin-right: 1.333%;
        }

        /*  */

        /* Add some styling for enlarged images */
        .enlarged {
            max-width: 100%;
            max-height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            background: rgba(0, 0, 0, 0.8);
            cursor: pointer;
        }

        .enlarged img {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: auto;
        }

        .enlarged img:hover {
            /* cursor: zoom-in; */
        }

        /*  */
        .date-label {
            place-self: center;
            margin-left: 0.5rem;
            margin-bottom: unset;
        }

        .input-detail-m {
            /* margin-left: 0.5rem; */
            border: none;
            padding-left: 0.5rem;
            background-color: #80808026;
            font-weight: bold;
            color: gray;
        }

        .label-w {
            width: 170px;
        }

        .cm_detail {
            margin-bottom: 0.5rem;
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-6" style="text-align: start;align-self: start;">
                    <a type="button" class="btn" onclick="b_repair()"
                        style="background-color: #3d8dbd;color:white;
                box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
                        <i class="fas fa-edit"></i>
                        แจ้งซ่อม
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header py-3 title-assett-active">
                    <h6 class="m-0 font-weight-bold text-primary">รายการซ่อมบำรุง</h6>
                </div>
                <div class="card-tools col-lg-6 my-2" style="align-self: center;">
                    <div class="input-group input-group-md">
                        <div class="input-group-append mx-1">
                            <button class="btn" id="searchFilter" onclick="listOwner()" data-target="#search-filter"
                                data-toggle="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="#ffffff"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H352c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V80c0-17.7-14.3-32-32-32s-32 14.3-32 32v35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V432c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H160c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z" />
                                </svg>
                            </button>
                        </div>
                        <input type="text" id="searchInput" class="form-control" placeholder="ค้นหาโดยเลขทะเบียน"
                            required>
                        <div class="input-group-append">
                            <div class="btn" id="searchButton"
                                style="background-color: #21b5ae;color:#ffffff;border-radius: unset;">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0.25rem;">
                    <div class="table-responsive" style="max-height: 600px;">
                        <table class="table" id="listAll_table" width="100%" cellspacing="0">

                            <thead
                                style="background-color: #343a40;color:#fff;position: sticky;
                            top: 0;
                            z-index: 10;">
                                <tr style="text-align: center;white-space:nowrap;">
                                    <th class="brr">ข้อมูลรถ</th>
                                    <th class="brr">บันทึกรายการ</th>
                                    <th class="brr">เลขทะเบียน</th>
                                    <th class="brr">วันที่ทำรายการ</th>
                                    <th class="brr">เลขไมล์</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- </div> --}}
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    {{-- search filter --}}
    <div class="modal fade" id="">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="box-shadow: none;border:none;border-radius:0px;">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-weight: bold;">ตัวกรอกค้นหา</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="date-label">ตั้งแต่วันที่</label>
                        <div class="input-group date col-lg-3" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" id="dateFirst"
                                data-target="#reservationdate" />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <label class="date-label">ถึงวันที่</label>
                        <div class="input-group date col-lg-3" id="reservationdate_t" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" id="dateSecond"
                                data-target="#reservationdate_t" />
                            <div class="input-group-append" data-target="#reservationdate_t" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal"></button> --}}
                    <button type="button" class="btn" id="filterSearch"
                        style="background-color: #21b5ae;color:white;width:124px;font-weight: bold;">ทั้งหมด</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- bill images --}}
    <div class="modal fade" id="cm_detail">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="box-shadow: none;border:none;border-radius:0px;">
                <div class="modal-header"
                    style="background-color: #3d8dbd;color: #ffffff;border-top-left-radius:unset;border-top-right-radius:unset;">
                    <h4 class="modal-title"><b>รายละเอียด</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="color:#ffffff;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 align-self-center">
                            <div class="cm_detail">
                                <div class="cm_detail">
                                    <label class="label-w" for="">วันที่ทำรายการ</label><input type="text"
                                        id="datedo" class="input-detail-m" size="15" disabled>
                                </div>
                                <div class="cm_detail"><label class="label-w" for="">เลขทะเบียน</label><input
                                        type="text" id="num_register" class="input-detail-m" size="15" disabled>
                                </div>
                                <div class="cm_detail"><label class="label-w" for="">เลขไมล์</label><input
                                        type="text" id="CarMileage" class="input-detail-m" size="15" disabled>
                                </div>
                                <div class="cm_detail"><label class="label-w"
                                        for="">เปลี่ยนน้ำมันเครื่องล่าสุด</label><input type="text"
                                        id="LatestEngineOilChangeMileage" class="input-detail-m" size="15" disabled>
                                </div>
                                <div class="cm_detail"><label class="label-w"
                                        for="">เปลี่ยนยางครั้งล่าสุด</label><input type="text"
                                        id="LastTireChangeDate" class="input-detail-m" size="15" disabled></div>
                                <div class="cm_detail"><label class="label-w"
                                        for="">กำหนดเปลี่ยนยาง</label><input type="text"
                                        id="SchedulTireChangeDate" class="input-detail-m" size="15" disabled></div>
                                <div class="cm_detail"><label class="label-w"
                                        for="">รายละเอียดอื่นๆ</label><input type="text" id="note"
                                        class="input-detail-m" size="15" disabled></div>
                                <div class="cm_detail"><label class="label-w" for="">ผู้ทำรายการ</label><input
                                        type="text" id="PsName" class="input-detail-m" size="15" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="b-repair">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="box-shadow: none;border:none;border-radius:0px;">
                <div class="modal-body">
                    <div class="row">
                        <h5> เลือกดูอย่างน้อย 1รายการ</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#loadingStartPage').modal('show');

            listAll();
            // เมื่อคลิกที่ปุ่มค้นหา
            $('#searchButton').click(function() {
                var searchInput = $('#searchInput').val();
                $.ajax({
                    url: '{{ route('listSearch') }}',
                    type: 'GET',
                    data: {
                        searchInput: searchInput
                    },
                    success: function(response) {
                        console.log("search data:", response);
                        displayDataInTable(response);
                    },
                    error: function(error) {
                        console.error('Error fetching chart data', error);
                    }
                });
            });
        });

        function listAll() {
            $.ajax({
                url: '/vam/car_maintenance/listAll',
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    displayDataInTable(response);
                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });
        }

        function listOwner() {
            $.ajax({
                url: '/vam/car_maintenance/listOwner',
                method: 'GET',
                success: function(response) {
                    console.log("owner: ", response);
                    displayDataInTable(response);
                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });
        }

        function displayDataInTable(data) {
            // เริ่มต้นดึงข้อมูลลงใน tbody ของตาราง
            var tbody = $('#listAll_table tbody');

            tbody.empty(); // ลบข้อมูลทั้งหมดใน tbody

            // วนลูปผ่าน JSON Array และสร้างแถวในตารางสำหรับแต่ละรายการ
            if (data.length === 0) {
                // หากไม่มีข้อมูล
                var row =
                    '<tr><td colspan="6" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล</td></tr>'; // กำหนดคอลัมน์ colspan เพื่อให้ข้อความนี้ครอบคลุมทุกคอลัมน์
                tbody.append(row); // เพิ่มแถวลงใน tbody
            } else {
                data.forEach(function(item, index) {
                    setTimeout(function() {
                        if (item.note === "") {
                            item.note = "- -";
                        }
                        if ((item.CarMileage - item.LatestEngineOilChangeMileage) > 8000) {
                            var row = '<tr style="background-color: rgb(255 146 146);">';
                        } else {
                            var row = '<tr data-id="' + item.num_register + '" class="vam_repair">';
                        }
                        row +=
                            '<td class="brr" style="text-align: center; padding: 0px; vertical-align: middle;">' +
                            '<a href="/vam/' + item.CarID +
                            '"><img src="{{ asset('imges/open.png') }}" alt="" style="height: 26px;"></a>' +
                            '</td>';
                        row += '<td class="brr tac" style="padding: 0px;">' +
                            '<a style="cursor: pointer;" onclick="cm_detail(' +
                            item
                            .CM_id +
                            ')"><img src="{{ asset('imges/specification.png') }}" alt="" style="height: 34px;margin-top: 2px;"></a>' +
                            '</td>';
                        row += '<td class="text brr tac">' + item.num_register +
                            '</td>';
                        row += '<td class="text brr tac">' + item.last_do_date + '</td>';
                        row += '<td class="text brr tac">' + item.CarMileage + '</td>';
                        row += '<td class="text tac">' + item.note + '</td>';
                        // เพิ่มคอลัมน์เพิ่มเติมตามจำนวนฟิลด์ใน JSON Array

                        row += '</tr>';
                        tbody.append(row); // เพิ่มแถวลงใน tbody

                        // ตรวจสอบว่าเป็นการวนลูปครั้งสุดท้ายหรือไม่
                        if (index === data.length - 1) {
                            $('#loadingStartPage').modal('hide');
                        }
                    }, (index + 1) * 150); // เพิ่มแถวอย่างช้าๆ 0.0 วินาที
                });
            }

        }

        function cm_detail(id) {
            addDetailToModal(id);
            $('#cm_detail').modal('show');
        }

        function b_repair() {
            let timerInterval;
            Swal.fire({
                //   title: "เลือกรายการ!",
                html: "เลือกดูข้อมูลก่อนทำรายการ.",
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = "/vam";
                }
            });
        }

        function addDetailToModal(id) {
            addItemList(id);
            $.ajax({
                url: '{{ route('cm_detail') }}',
                type: 'GET',
                data: {
                    searchID: id
                },
                success: function(response) {
                    console.log(response);
                    addItemList(response);
                },
                error: function(error) {
                    console.error('Error fetching mtn data', error);
                }
            });
        }

        function addItemList(data) {
            document.getElementById("datedo", "num_register", "CarMileage", "LatestEngineOilChangeMileage",
                "LastTireChangeDate", "SchedulTireChangeDate", "note", "PsName").value = "";

            document.getElementById("datedo").value = data.last_do_date;
            document.getElementById("num_register").value = data.num_register;
            document.getElementById("CarMileage").value = data.CarMileage;
            document.getElementById("LatestEngineOilChangeMileage").value = data.LatestEngineOilChangeMileage;
            document.getElementById("LastTireChangeDate").value = data.LastTireChangeDate;
            document.getElementById("SchedulTireChangeDate").value = data.SchedulTireChangeDate;
            document.getElementById("note").value = data.note;
            document.getElementById("PsName").value = data.PsName;
        }
    </script>
@endpush
