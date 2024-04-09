@extends('layouts.master')
@section('title', 'การแจ้งเตือน')
@push('css')
    <style>
        table#notification_table {
            font-size: 12px;
        }

        th,
        td {
            white-space: nowrap;
        }

        tr>th {
            text-align: center;
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
            <div class="row mb-2">
                <div class="col-6">
                    <h1 class="font-bold">บำรุงรักษา</h1>
                </div>
                <div class="col-6" style="text-align: end;align-self: center;">
                    <a href="/vam" type="button" class="btn"
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
        <div class="row">
            <div class="col-md-3">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h3 class="card-title">รายการ</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle text-danger"></i>
                                    เปลี่ยนน้ำมันเครื่อง
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle text-warning"></i> เปลี่ยนยาง
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title col-lg-6 mb-2">รายการแจ้งซ่อมบำรุง</h3>

                            <div class="card-tools col-lg-6">
                                <div class="input-group input-group-sm"
                                    style="
                                box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
                                    <input type="text" id="searchInput" class="form-control"
                                        placeholder="ค้นหารายการแจ้งซ่อมบำรุง">
                                    <div class="input-group-append">
                                        <div class="btn btn-primary" id="searchButton">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="mailbox-controls" style="padding-left: 1.25rem;">
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-default btn-sm"
                                style="border-radius: 0.5rem;
                            box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
                                <i class="fas fa-sync-alt"></i>
                            </button>

                            <button type="button" class="btn btn-default btn-sm" onclick="listAll()"
                                style="border-radius: 0.5rem;
                            box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
                                <i>ทั้งหมด</i>
                            </button>
                        </div>
                        <div class="table-responsive ">
                            <table class="table table-hover table-striped" id="listAll_table">
                                <thead>
                                    <tr>
                                        <th>เลขทะเบียน</th>
                                        <th>วันที่ทำรายการ</th>
                                        <th>เลขไมล์</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->



@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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

        function displayDataInTable(data) {
            // เริ่มต้นดึงข้อมูลลงใน tbody ของตาราง
            var tbody = $('#listAll_table tbody');

            tbody.empty(); // ลบข้อมูลทั้งหมดใน tbody

            // วนลูปผ่าน JSON Array และสร้างแถวในตารางสำหรับแต่ละรายการ
            if (data.length === 0) {
                // หากไม่มีข้อมูล
                var row =
                    '<tr><td colspan="4">ไม่มีข้อมูล</td></tr>'; // กำหนดคอลัมน์ colspan เพื่อให้ข้อความนี้ครอบคลุมทุกคอลัมน์
                tbody.append(row); // เพิ่มแถวลงใน tbody
            } else {
                data.forEach(function(item) {
                    if (item.note === "") {
                        item.note = "- -";
                    }
                    var row = '<tr>';
                    row += '<td><a href="/vam/' + item.CarID + '">' + item.num_register + '</a></td>';
                    row += '<td>' + item.last_do_date + '</td>';
                    row += '<td>' + item.CarMileage + '</td>';
                    row += '<td>' + item.note + '</td>';
                    // เพิ่มคอลัมน์เพิ่มเติมตามจำนวนฟิลด์ใน JSON Array

                    row += '</tr>';
                    tbody.append(row); // เพิ่มแถวลงใน tbody
                });
            }

        }
    </script>
@endpush
