@extends('layouts.master')
@section('title', 'Asset')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <style>
        table#asset_table {
            font-size: 12px;
        }

        .brr {
            border-right: 1px solid #dee2e6;
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

        @media only screen and (max-width: 576px) {
            .title-assett-active {
                text-align: center;
            }

            .content-wrapper>.content {
                padding: 0px;
            }

            .form-group.row {
                justify-content: center;
                padding: 0rem 0rem 1rem 0rem;
            }

            .col-lg-3 {
                text-align: start;
                margin: 0.25rem;
            }

            .form-group {
                margin-bottom: unset;
            }
        }

        @media only screen and (min-width: 992px) {
            .form-group.row {
                justify-content: center;
            }

            .col-lg-3 {
                text-align: end;
            }
        }

        .col-sm-12.col-md-6 {
            content-visibility: hidden;
        }

        .card {
            box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .assetRow:hover {
            background-color: rgb(152, 238, 152);
            cursor: pointer;
        }

        #monthAsset th:hover {
            text-decoration: underline;
            cursor: pointer;
            background-color: #343a40;
            color: #fff;
        }

        #searchFilter {
            background-color: #21b5ae;
            color: #ffffff;
        }

        #searchFilter:hover {
            filter: brightness(50%);
        }

        .date-label {
            place-self: center;
            /* margin-left: 0.5rem; */
            margin-bottom: unset;
        }

        .comp-label {
            place-self: center;
            /* margin-left: 0.5rem; */
            margin-bottom: unset;
        }

        /* select 2 */
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px);
            border: 1px solid #ced4da;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(30px + 2px);
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #62b6b2;
            color: white;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected],
        .select2-container--default .select2-results__option--highlighted[aria-selected]:hover {
            background-color: #21b5ae;
            color: #fff;
        }

        /* /select2 */
    </style>
@endpush
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

            {{-- <div class="row align-items-center">
                <!-- Dropdown เพื่อเลือกค่า -->
                <div class="col-lg-2 col-sm-12 my-1">
                    <select id="asset_year" class="form-control">
                        <option value="2566">สินทรัพย์ปี 2566</option>
                        <option value="2567" selected>สินทรัพย์ปี 2567</option>
                    </select>
                </div>

                <!-- Dropdown เพื่อเลือก category -->
                <div class="col-lg-2 col-sm-12 my-1">
                    <select id="asset_category" class="form-control">
                        <option value="0" selected>ทุกประเภท</option>
                        @foreach ($asset_category as $item)
                            <option value="{{ $item->idAssType }}">{{ $item->AssTypeName }}</option>
                        @endforeach

                    </select>
                </div>
            </div> --}}

        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header py-3 title-assett-active">
                    <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูล Asset</h6>
                    <div class="row mt-2">
                        <div class="col-lg-auto " style="font-weight: 900;font-size: small;color:gray;">
                            <label style="margin-top: 0px;margin-bottom:0px;">ผลลัพธ์</label>
                            <label id="CountSearch" style="margin-top: 0px;margin-bottom:0px;">...</label>
                            <label style="margin-top: 0px;margin-bottom:0px;">รายการ</label>
                        </div>
                        <div class="col-lg-auto" style="font-weight: 900;font-size: small;color:gray;">
                            <label style="margin-top: 0px;margin-bottom:0px;">แสดงอย่างน้อย</label>
                            <label id="" style="margin-top: 0px;margin-bottom:0px;"> 30 </label>
                            <label style="margin-top: 0px;margin-bottom:0px;">รายการ</label>
                        </div>
                        <div class="col-lg-auto" style="font-weight: 900;font-size: small;color:gray;" hidden>
                            <label style="margin-top: 0px;margin-bottom:0px;">มูลค่ารวม</label>
                            <label id="assetValue" style="margin-top: 0px;margin-bottom:0px;">...</label>
                            <label style="margin-top: 0px;margin-bottom:0px;">บาท</label>
                        </div>
                    </div>
                </div>
                <div class="card-tools col-lg-4 my-2" style="align-self: center;">
                    <div class="input-group input-group-md">
                        <div class="input-group-append mx-1">
                            <button class="btn" id="searchFilter" data-target="#search-filter" data-toggle="modal">
                                <i class="fas fa-filter"> Filter</i>
                            </button>
                        </div>
                        <input type="text" id="searchInput" class="form-control" placeholder="ค้นหาชื่อ,รหัสสินทรัพย์"
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
                        <table class="table" id="asset_table" width="100%" cellspacing="0">

                            <thead style="background-color: #343a40;color:#fff;position: sticky;top: 0;z-index: 10;">
                                <tr style="text-align: center;white-space:nowrap;">
                                    <th class="brr">ดูข้อมูล</th>
                                    <th class="brr">รหัส</th>
                                    <th class="brr">สินทรัพย์</th>
                                    <th>ประเภท</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- </div> --}}
                </div>
                <!-- /.row -->
            </div>
            {{-- <div class="row align-items-center mb-1">
                <div class="col-lg-2 col-sm-12 my-1">
                    <select id="asset_year" class="form-control">
                        <option value="2566">สินทรัพย์ปี 2566</option>
                        <option value="2567" selected>สินทรัพย์ปี 2567</option>
                    </select>
                </div>

                <div class="col-lg-2 col-sm-12 my-1">
                    <select id="asset_category" class="form-control">
                        <option value="0" selected>ทุกประเภท</option>
                        @foreach ($asset_category as $item)
                            <option value="{{ $item->idAssType }}">{{ $item->AssTypeName }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" style="background-color: #343a40;color:#fff;">
                            <h3 class="card-title">Asset Value Chart</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="height: 500px;">
                            <canvas id="myChart" style="width:100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="background-color: #343a40;color:#fff;">
                            <h3 class="card-title">มูลค่าสินทรัพย์(เดือน)</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="height: 500px; overflow-y: auto;padding:1rem;">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <tbody id="monthAsset">
                                        <tr>
                                            <th scope="row" onclick="monthAsset('01')">มกราคม</th>
                                            <td id="January" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('02')">กุมภาพันธ์</th>
                                            <td id="February" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('03')">มีนาคม</th>
                                            <td id="March" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('04')">เมษายน</th>
                                            <td id="April" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('05')">พฤษภาคม</th>
                                            <td id="May" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('06')">มิถุนายน</th>
                                            <td id="June" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('07')">กรกฎาคม</th>
                                            <td id="July" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('08')">สิงหาคม</th>
                                            <td id="August" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('09')">กันยายน</th>
                                            <td id="September" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('10')">ตุลาคม</th>
                                            <td id="October" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('11')">พฤศจิกายน</th>
                                            <td id="November" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" onclick="monthAsset('12')">ธันวาคม</th>
                                            <td id="December" class="text-right">- -</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div> --}}

    </section>
    <!-- /.content -->

    {{-- <div class="modal fade" id="monthAssetModal" tabindex="-1" aria-labelledby="monthAssetModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="table-responsive" style="max-height: 600px;">
                    <table class="table" id="asset_ytm_table" width="100%" cellspacing="0" style="font-size:12px;">

                        <thead style="background-color: #343a40;color:#fff;position: sticky;top: 0;z-index: 10;">
                            <tr style="text-align: center;white-space:nowrap;">
                                <th class="brr">ดูข้อมูล</th>
                                <th class="brr">รหัส</th>
                                <th class="brr">สินทรัพย์</th>
                                <th>ประเภท</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div> --}}

    <!-- Modal -->
    <div class="modal fade" id="loadingStartPage" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="justify-content: center;">
            <button class="btn btn-primary" type="button" readonly>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                กำลังโหลด...
            </button>
        </div>
    </div>

    {{-- search filter --}}
    <div class="modal fade" id="search-filter">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="box-shadow: none;border:none;border-radius:0px;">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-weight: bold;">ตัวกรองค้นหา</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">

                        <div class="col-lg-6 row justify-content-end align-items-center">
                            <div class="col-lg-3">
                                <label class="comp-label" style="color:gray;">บริษัท</label>
                            </div>
                            <div class="col-lg-8">
                                @if (session('role') === 'admin' || session('role') === 'superAdmin')

                                    <select class="form-control select2" style="width: 100%;" id="comp">
                                        <option value="0" selected>ทุกบริษัท</option>
                                        @foreach ($Comp as $items)
                                            <option value="{{ $items->idComp }}">{{ $items->CompName }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control select2" style="width: 100%;" id="comp" disabled>
                                        @foreach ($Comp as $items)
                                            @if ($items->idComp == session('idComp'))
                                                <option value="{{ $items->idComp }}" selected>{{ $items->CompName }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 row justify-content-start align-items-center">
                            <div class="col-lg-3">
                                <label class="comp-label" style="color:gray;">ประเภท</label>
                            </div>
                            <div class="col-lg-8">
                                <select class="form-control select2" style="width: 100%;" id="category">
                                    <option value="0" selected style="color:gray;">ทุกประเภท</option>
                                    @foreach ($asset_category as $items)
                                        <option value="{{ $items->idAssType }}" style="color:gray;">
                                            {{ $items->AssTypeName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 row justify-content-end align-items-center">
                            <div class="col-lg-3">
                                <label class="date-label" style="color:gray;">วันที่</label>
                            </div>
                            <div class="col-lg-8">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="dateFirst"
                                        data-target="#reservationdate" />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 row justify-content-start align-items-center">
                            <div class="col-lg-3">
                                <label class="date-label" style="color:gray;">ถึงวันที่</label>
                            </div>
                            <div class="col-lg-8">
                                <div class="input-group date" id="reservationdate_t" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="dateSecond"
                                        data-target="#reservationdate_t" />
                                    <div class="input-group-append" data-target="#reservationdate_t"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal"></button> --}}
                    <button type="button" class="btn" id="ResetFilterSearch" onclick="ResetFilterSearch()"
                        {{-- data-dismiss="modal" --}}
                        style="background-color: #f8db35;color:dimgray;width:124px;font-weight: bold;">รีเซ็ต</button>
                    <button type="button" class="btn" id="filterSearch"
                        style="background-color: #21b5ae;color:white;width:124px;font-weight: bold;">ค้นหา</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script>
        var sessionUser = @json(session('role'));
        console.log(sessionUser);
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
        $(function() {
            $('#reservationdate').datetimepicker({
                format: 'L'
            });
        });
        $(function() {
            $('#reservationdate_t').datetimepicker({
                format: 'L'
            });
        });
        let myChart;

        // function createChart(chartData) {
        //     if (myChart) {
        //         myChart.destroy();
        //     }

        //     var ctx = document.getElementById('myChart').getContext('2d');
        //     myChart = new Chart(ctx, {
        //         type: 'bar',
        //         data: {
        //             labels: chartData.map(data => data.textMonthAsset),
        //             datasets: [{
        //                 label: 'มูลค่าสินทรัพย์',
        //                 data: chartData.map(data => data.AssTotal),
        //                 backgroundColor: ["#41699d", "#9e413e", "#7f9a48", "#685085",
        //                     "#3d8ca3", "#cd7b39", "#6c757d", "#41699d", "#9e413e",
        //                     "#7f9a48", "#685085", "#3d8ca3"
        //                 ],
        //                 borderWidth: 1
        //             }]
        //         },
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //             scales: {
        //                 y: {
        //                     beginAtZero: true
        //                 }
        //             }
        //         }
        //     });

        // }

        // function createMonthValue(MonthData) {

        //     ClearMonthValue()
        //     MonthData.forEach(function(item) {

        //         var monthElement = document.getElementById(item.textMonthAssetEng);
        //         if (monthElement) {
        //             monthElement.textContent = parseFloat(item.AssTotal).toLocaleString('th-TH', {
        //                 style: 'currency',
        //                 currency: 'THB'
        //             });
        //         }
        //     });
        // }

        // function ClearMonthValue() {
        //     const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
        //         "October", "November", "December"
        //     ];
        //     months.forEach(month => {
        //         document.getElementById(month).textContent = "- -";
        //     });
        // }


        function callAlert() {
            Swal.fire({
                title: 'ข้อมูลสินทรัพย์',
                text: 'ไม่มีข้อมูลในรายการค้นหา',
                icon: 'info',
                confirmButtonText: 'ตกลง'
            });
        }

        function ajaxCall() {
            var selectedValue = $('#asset_year').val();
            var selectedCategory = $('#asset_category').val();

            // console.log(selectedValue, selectedCategory);
            $.ajax({
                url: '/chart-data/' + selectedValue + '/' + selectedCategory,
                method: 'GET',
                success: function(response) {
                    if (response.length < 1) {
                        callAlert()
                    }
                    // createChart(response)
                    // createMonthValue(response)

                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });

        }

        function assetCall(val) {
            var data = val.assAll;
            var assetSumvalue = parseFloat(val.totalAssets.assPriceTotal);

            var tbody = $('#asset_table tbody');

            tbody.empty();

            if (data.length === 0) {
                // หากไม่มีข้อมูล
                document.getElementById("CountSearch").textContent = 0;
                document.getElementById("assetValue").textContent = 0.00;
                var row =
                    '<tr><td colspan="4" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล</td></tr>';
                tbody.append(row);
            } else {

                var formattedValue = assetSumvalue.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                document.getElementById("CountSearch").textContent = data.length;
                document.getElementById("assetValue").textContent = formattedValue;

                data.forEach(function(item, index) {
                    setTimeout(function() {
                        if (index < 30) {
                            var row = '<tr data-id="' + item.idAsset + '" class="assetRow">';
                            row +=
                                '<td class="brr" style="text-align: center; padding: 0px; vertical-align: middle;">' +
                                '<a href="/asset/' + item.idAsset +
                                '"><img src="{{ asset('imges/open.png') }}" alt="" style="height: 26px;"></a>' +
                                '</td>';

                            row += '<td class="brr" style="text-align: center;">' + item.AssetCode +
                                '</td>';

                            row += '<td class="text brr">' + item.AssetName + '</td>';

                            row += '<td style="text-align: center;">' + item.AssTypeName + '</td>';

                            row += '</tr>';
                            tbody.append(row);

                            // ตรวจสอบว่าเป็นการวนลูปครั้งสุดท้ายหรือไม่
                            if (index === data.length - 1) {
                                $('#loadingStartPage').modal('hide');
                            }
                        } else {
                            $('#loadingStartPage').modal('hide');
                            return;
                        }
                    }, (index + 1) * 75); // เพิ่มแถวอย่างช้าๆ 0.0 วินาที

                });
            }
        }

        // เรียกใช้งานฟังก์ชัน ajaxCall เมื่อหน้าเว็บโหลดเสร็จ
        $(document).ready(function() {
            $('#loadingStartPage').modal('show');
            asset_search();

            $('#asset_table').on('click', '.assetRow', function() {
                var assetId = $(this).data('id'); // ดึงค่า id ของทรัพยากรจาก data-id ของแถว
                window.location.href = "/asset/" +
                    assetId; // นำ id ไปสร้าง URL และเปลี่ยนเส้นทางของหน้าเว็บไปยังหน้ารายละเอียดทรัพยากร
            });

            $('#asset_ytm_table').on('click', '.assetRow', function() {
                var assetId = $(this).data('id'); // ดึงค่า id ของทรัพยากรจาก data-id ของแถว
                window.location.href = "/asset/" +
                    assetId; // นำ id ไปสร้าง URL และเปลี่ยนเส้นทางของหน้าเว็บไปยังหน้ารายละเอียดทรัพยากร
            });
        });

        // เรียกใช้งานฟังก์ชัน ajaxCall เมื่อมีการเปลี่ยนแปลงใน dropdown
        $('#asset_year, #asset_category').change(function() {
            ajaxCall();
        });
        // ค้นหา
        $('#searchButton').click(function() {
            asset_search();
        });
        $('#filterSearch').click(function() {
            filterSearch();
            $('#search-filter').modal('hide');
        });

        function filterSearch() {
            var id_comp = $('#comp').val();
            var id_category = $('#category').val();
            var dateFirst = $('#dateFirst').val();
            var dateSecond = $('#dateSecond').val();
            console.log(dateFirst, dateSecond);
            $.ajax({

                url: '{{ route('search_filter_asset') }}',
                type: 'GET',
                data: {
                    id_comp: id_comp,
                    id_category: id_category,
                    dateFirst: dateFirst,
                    dateSecond: dateSecond
                },
                success: function(response) {
                    if (response.length < 1) {
                        callAlert();
                    }
                    assetCall(response);
                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });
        }

        function ResetFilterSearch() {

            var sessionData = {!! json_encode(session('idPositions')) !!};
            if (sessionData == 15) {
                document.getElementById('comp').selectedIndex = 0;
                document.getElementById('select2-comp-container').innerHTML = "ทุกบริษัท";
            }
            document.getElementById('category').selectedIndex = 0;
            document.getElementById('select2-category-container').innerHTML = "ทุกประเภท";
            document.getElementById('dateFirst').value = '';
            document.getElementById('dateSecond').value = '';
        }


        $(document).keypress(function(event) {
            if (event.which === 13) {
                asset_search();
            }
        });

        function asset_search() {
            var searchInput = $('#searchInput').val();
            // if (searchInput == "") {
            //     console.log("null");
            // } else {
            $.ajax({
                url: '{{ route('asset_search') }}',
                type: 'GET',
                data: {
                    searchInput: searchInput
                },
                success: function(response) {
                    if (response.length < 1) {
                        callAlert();
                    }
                    console.log(response);
                    assetCall(response);
                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });
            // }
        }

        // function monthAsset(month) {
        //     var selectedValue = $('#asset_year').val();
        //     var selectedCategory = $('#asset_category').val();

        //     $.ajax({
        //         url: '/asset_ytm/',
        //         type: 'GET',
        //         data: {
        //             selectedValue: selectedValue,
        //             selectedCategory: selectedCategory,
        //             month: month
        //         },
        //         success: function(response) {
        //             if (response.length < 1) {
        //                 callAlert()
        //             } else {
        //                 // console.log(response);
        //                 monthAssetCall(response);
        //             }


        //         },
        //         error: function(error) {
        //             console.error('Error fetching chart data', error);
        //         }
        //     });
        // }

        // function monthAssetCall(data) {

        //     var tbody = $('#asset_ytm_table tbody');

        //     tbody.empty();

        //     if (data.length === 0) {
        //         var row =
        //             '<tr><td colspan="4" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล</td></tr>';
        //         tbody.append(row);
        //     } else {
        //         data.forEach(function(item, index) {
        //             setTimeout(function() {
        //                 var row = '<tr data-id="' + item.idAsset + '" class="assetRow">';
        //                 row +=
        //                     '<td class="brr" style="text-align: center; padding: 0px; vertical-align: middle;">' +
        //                     '<a href="/asset/' + item.idAsset +
        //                     '"><img src="https://cdn-icons-png.flaticon.com/128/3767/3767084.png" alt="" style="height: 26px;"></a>' +
        //                     '</td>';

        //                 row += '<td class="brr" style="text-align: center;">' + item.AssetCode + '</td>';

        //                 row += '<td class="text brr">' + item.AssetName + '</td>';

        //                 row += '<td style="text-align: center;">' + item.AssTypeName + '</td>';

        //                 row += '</tr>';
        //                 tbody.append(row);

        //             }, (index + 1) * 150);
        //         });

        //         $('#monthAssetModal').modal('show');
        //     }


        // }
    </script>
@endpush
