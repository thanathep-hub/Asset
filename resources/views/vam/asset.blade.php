@extends('layouts.master')
@section('title', 'Asset')
@push('css')
    <style>
        table#asset_table {
            font-size: 12px;
        }

        td {
            white-space: nowrap;
        }

        @media only screen and (max-width: 576px) {
            .title-assett-active {
                text-align: center;
            }
        }

        .col-sm-12.col-md-6 {
            content-visibility: hidden;
        }

        .card {
            box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
@endpush
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row align-items-center">
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

        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

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
                                    <tbody>
                                        <tr>
                                            <th scope="row">มกราคม</th>
                                            <td id="January" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">กุมภาพันธ์</th>
                                            <td id="February" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">มีนาคม</th>
                                            <td id="March" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">เมษายน</th>
                                            <td id="April" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">พฤษภาคม</th>
                                            <td id="May" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">มิถุนายน</th>
                                            <td id="June" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">กรกฎาคม</th>
                                            <td id="July" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">สิงหาคม</th>
                                            <td id="August" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">กันยายน</th>
                                            <td id="September" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ตุลาคม</th>
                                            <td id="October" class="text-right">- -</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">พฤศจิกายน</th>
                                            <td id="November" class="text-right">- -</td>
                                        </tr>
                                        <tr>
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

            <div class="card mb-4">
                <div class="card-header py-3 title-assett-active">
                    <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูล Asset</h6>
                </div>
                <div class="card-tools col-lg-4 my-2" style="align-self: center;">
                    <div class="input-group input-group-md">
                        <input type="text" id="searchInput" class="form-control" placeholder="ค้นหารหัสหรือชื่อ">
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

                            <thead
                                style="background-color: #343a40;color:#fff;position: sticky;
                            top: 0;
                            z-index: 10;"">
                                <tr style="text-align: center;white-space:nowrap;">
                                    <th>ดูข้อมูล</th>
                                    <th>รหัส</th>
                                    <th>สินทรัพย์</th>
                                    <th>ประเภท</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" style="text-align: center;">ไม่มีข้อมูล</td>
                                </tr>
                                {{-- @foreach ($asset_all as $item) --}}
                                {{-- <tr>
                                    <td style="text-align: center;padding: 0px;vertical-align: middle;">
                                        <a href="/asset/{{ $item->idAsset }}"><img
                                                src="https://cdn-icons-png.flaticon.com/128/3767/3767084.png"
                                                alt="" style="height: 26px;"></a>
                                    </td>
                                    <td style="text-align:
                                                    center;">
                                        {{ $item->AssetCode }}
                                    </td>
                                    <td>{{ $item->AssetName }}</td>
                                    <td style="text-align: center;">{{ $item->AssTypeName }}</td>
                                </tr> --}}
                                {{-- @endforeach --}}
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

@endsection

@push('scripts')
    <script>
        let myChart;

        function createChart(chartData) {
            // ล้างข้อมูลกราฟเก่าโดยการทำลายตัวแปร myChart ถ้ามี
            if (myChart) {
                myChart.destroy();
            }

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
                            beginAtZero: true
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
                    '<tr><td colspan="4">ไม่มีข้อมูล</td></tr>';
                tbody.append(row);
            } else {
                data.forEach(function(item) {
                    var row = '<tr>';
                    row += '<td style="text-align: center; padding: 0px; vertical-align: middle;">' +
                        '<a href="/asset/' + item.idAsset +
                        '"><img src="https://cdn-icons-png.flaticon.com/128/3767/3767084.png" alt="" style="height: 26px;"></a>' +
                        '</td>';

                    row += '<td style="text-align: center;">' + item.AssetCode + '</td>';

                    row += '<td>' + item.AssetName + '</td>';

                    row += '<td style="text-align: center;">' + item.AssTypeName + '</td>';

                    row += '</tr>';
                    tbody.append(row);
                });
            }
        }

        // เรียกใช้งานฟังก์ชัน ajaxCall เมื่อหน้าเว็บโหลดเสร็จ
        $(document).ready(function() {
            ajaxCall();
        });

        // เรียกใช้งานฟังก์ชัน ajaxCall เมื่อมีการเปลี่ยนแปลงใน dropdown
        $('#asset_year, #asset_category').change(function() {
            ajaxCall();
        });

        $('#searchButton').click(function() {
            var searchInput = $('#searchInput').val();
            $.ajax({
                url: '{{ route('asset_search') }}',
                type: 'GET',
                data: {
                    searchInput: searchInput
                },
                success: function(response) {
                    assetCall(response);
                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });
        });


        // Call the dataTables jQuery plugin
        // $(document).ready(function() {
        //     $('#asset_table').DataTable({
        //         language: {
        //             url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/th.json',
        //         },
        //     });
        // });
    </script>
@endpush
