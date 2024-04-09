@extends('layouts.master')
@section('title', 'Asset')
@push('css')
    <style>
        table#asset_table {
            font-size: 12px;
        }

        th {
            border-left: 1px solid #dee2e6;
        }

        td {
            border-right: 1px solid #dee2e6;
        }

        .brr {
            /* border-right: 1px solid #dee2e6; */
        }

        .brr-secon {
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

        #monthAsset tr:hover {
            text-decoration: underline;
            cursor: pointer;
            background-color: #343a40;
            color: #fff;
            border: unset;
        }
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
            {{-- <div class="card mb-4">
                <div class="card-header py-3 title-assett-active">
                    <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูล Asset</h6>
                </div>
                <div class="card-tools col-lg-4 my-2" style="align-self: center;">
                    <div class="input-group input-group-md">
                        <input type="text" id="searchInput" class="form-control" placeholder="ค้นหาชื่อ,รหัส เช่น AS0000"
                            required>
                        <div class="input-group-append">
                            <div class="btn btn-primary" id="searchButton">
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
                </div>
            </div> --}}
            <div class="row align-items-center mb-1">
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
                                <table class="table " style="border-collapse: collapse;">
                                    <tbody id="monthAsset">
                                        <tr onclick="monthAsset('01')">
                                            <th scope="row">มกราคม</th>
                                            <td id="January" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('02')">
                                            <th scope="row">กุมภาพันธ์</th>
                                            <td id="February" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('03')">
                                            <th scope="row">มีนาคม</th>
                                            <td id="March" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('04')">
                                            <th scope="row">เมษายน</th>
                                            <td id="April" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('05')">
                                            <th scope="row">พฤษภาคม</th>
                                            <td id="May" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('06')">
                                            <th scope="row">มิถุนายน</th>
                                            <td id="June" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('07')">
                                            <th scope="row">กรกฎาคม</th>
                                            <td id="July" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('08')">
                                            <th scope="row">สิงหาคม</th>
                                            <td id="August" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('09')">
                                            <th scope="row">กันยายน</th>
                                            <td id="September" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('10')">
                                            <th scope="row">ตุลาคม</th>
                                            <td id="October" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('11')">
                                            <th scope="row">พฤศจิกายน</th>
                                            <td id="November" class="text-right">- -</td>
                                        </tr>
                                        <tr onclick="monthAsset('12')">
                                            <th scope="row">ธันวาคม</th>
                                            <td id="December" class="text-right">- -</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>


            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="monthAssetModal" tabindex="-1" aria-labelledby="monthAssetModalLabel"
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
    </div>

@endsection

@push('scripts')
    <script>
        let myChart;

        function createChart(chartData) {
            // Check if myChart is defined and destroy it if it exists
            if (myChart) {
                myChart.destroy();
            }

            const thaiMonths = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม",
                "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
            ];

            var ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.map(data => data.textMonthAsset),
                    datasets: [{
                        label: 'มูลค่าสินทรัพย์',
                        data: chartData.map(data => data.AssTotal),
                        backgroundColor: ["#41699d", "#9e413e", "#7f9a48", "#685085",
                            "#3d8ca3", "#cd7b39", "#6c757d", "#41699d", "#9e413e",
                            "#7f9a48", "#685085", "#3d8ca3"
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            ticks: {
                                // Include a dollar sign in the ticks
                                callback: function(value, index, ticks) {
                                    return '$' + Chart.Ticks.formatters.numeric.apply(this, [value, index,
                                        ticks
                                    ]);
                                }
                            }
                        }
                    }
                }
            });
        }

        function createMonthValue(MonthData) {

            ClearMonthValue()
            // วนลูปเพื่อเพิ่มข้อมูลให้กับแต่ละเดือน
            MonthData.forEach(function(item) {

                var monthElement = document.getElementById(item.textMonthAssetEng);
                if (monthElement) {
                    monthElement.textContent = parseFloat(item.AssTotal).toLocaleString('th-TH', {
                        style: 'currency',
                        currency: 'THB'
                    });
                }
            });
        }

        function ClearMonthValue() {
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                "October", "November", "December"
            ];
            months.forEach(month => {
                document.getElementById(month).textContent = "- -";
            });
        }


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

            $.ajax({
                url: '/chart-data/' + selectedValue + '/' + selectedCategory,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    if (response.length < 1) {
                        callAlert()
                    }
                    createChart(response)
                    createMonthValue(response)

                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });

        }

        function assetCall(data) {
            console.log(data);
            var tbody = $('#asset_table tbody');

            tbody.empty();

            if (data.length === 0) {
                // หากไม่มีข้อมูล
                var row =
                    '<tr><td colspan="4" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล</td></tr>';
                tbody.append(row);
            } else {
                data.forEach(function(item, index) {
                    setTimeout(function() {
                        var row = '<tr data-id="' + item.idAsset + '" class="assetRow">';
                        row +=
                            '<td class="brr" style="text-align: center; padding: 0px; vertical-align: middle;">' +
                            '<a href="/asset/' + item.idAsset +
                            '"><img src="{{ asset('imges/open.png') }}" alt="" style="height: 26px;"></a>' +
                            '</td>';

                        row += '<td class="brr" style="text-align: center;">' + item.AssetCode + '</td>';

                        row += '<td class="text brr">' + item.AssetName + '</td>';

                        row += '<td style="text-align: center;">' + item.AssTypeName + '</td>';

                        row += '</tr>';
                        tbody.append(row);

                    }, (index + 1) * 75); // เพิ่มแถวอย่างช้าๆ 0.0 วินาที
                });
            }
        }

        // เรียกใช้งานฟังก์ชัน ajaxCall เมื่อหน้าเว็บโหลดเสร็จ
        $(document).ready(function() {
            ajaxCall();

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

        $('#searchButton').click(function() {
            asset_search();
        });

        $(document).keypress(function(event) {
            if (event.which === 13) {
                asset_search();
            }
        });

        function asset_search() {
            var searchInput = $('#searchInput').val();
            if (searchInput == "") {
                console.log("null");
            } else {
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
                        assetCall(response);
                    },
                    error: function(error) {
                        console.error('Error fetching chart data', error);
                    }
                });
            }
        }

        function monthAsset(month) {
            var selectedValue = $('#asset_year').val();
            var selectedCategory = $('#asset_category').val();

            $.ajax({
                url: '/asset_ytm/',
                type: 'GET',
                data: {
                    selectedValue: selectedValue,
                    selectedCategory: selectedCategory,
                    month: month
                },
                success: function(response) {
                    if (response.length < 1) {
                        callAlert()
                    } else {
                        console.log(response);
                        monthAssetCall(response);
                    }


                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });
        }

        function monthAssetCall(data) {

            var tbody = $('#asset_ytm_table tbody');

            tbody.empty();

            if (data.length === 0) {
                // หากไม่มีข้อมูล
                var row =
                    '<tr><td colspan="4" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล</td></tr>';
                tbody.append(row);
            } else {
                data.forEach(function(item, index) {
                    setTimeout(function() {
                        var row = '<tr data-id="' + item.idAsset + '" class="assetRow">';
                        row +=
                            '<td class="brr" style="text-align: center; padding: 0px; vertical-align: middle;">' +
                            '<a href="/asset/' + item.idAsset +
                            '"><img src="{{ asset('imges/open.png') }}" alt="" style="height: 26px;"></a>' +
                            '</td>';

                        row += '<td class="brr" style="text-align: center;">' + item.AssetCode + '</td>';

                        row += '<td class="text brr">' + item.AssetName + '</td>';

                        row += '<td style="text-align: center;">' + item.AssTypeName + '</td>';

                        row += '</tr>';
                        tbody.append(row);

                    }, (index + 1) * 75); // เพิ่มแถวอย่างช้าๆ 0.0 วินาที
                });

                $('#monthAssetModal').modal('show');
            }


        }
    </script>
@endpush
