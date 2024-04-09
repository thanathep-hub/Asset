@extends('layouts.master')
@section('title', 'บิล')
@push('css')
    <style>
        table#vam_table {
            font-size: 12px;
        }

        td {
            white-space: nowrap;
        }

        /* CSS ที่มีการซ้ำซ้อน */
        th,
        td {
            text-align: center;
        }

        /* ลดการซ้ำซ้อน */
        .cell-center {
            text-align: center;
        }

        .card {
            border-radius: 0.5rem;
            /* max-width: 290px; */
            box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            background-color: #fff;
        }

        .info-box {
            /* overflow: hidden; */
            /* position: relative; */
            /* text-align: left; */
            border-radius: 0.5rem;
            /* max-width: 290px; */
            box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            background-color: #fff;
        }

        .table.table-head-fixed-custom thead tr:nth-child(1) th {
            background-color: #343a40;
            color: #ffffff;
            border-bottom: 0;
            box-shadow: inset 0 1px 0 #dee2e6, inset 0 -1px 0 #dee2e6;
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 10;
        }
    </style>
@endpush
@section('content')

    <!-- Main content -->
    <section class="content" style="padding: 0.5rem 0.5rem;">
        <div class="container-fluid">
            <div class="card mb-2">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">ตารางข้อมูล VAM</h5>
                </div>

                <div class="card-tools col-lg-4 mt-2" style="align-self: center;">
                    <div class="input-group input-group-md"
                        style="border-radius: 0.5rem;
                    box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                    background-color: #fff;">
                        <input type="text" id="searchInput" class="form-control" placeholder="ค้นหาทะเบียน">

                        <div class="input-group-append">
                            <div class="btn btn-primary" id="searchButton">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-1 card-body p-0">
                    <div class="table-responsive" style="height: 500px;">
                        <table class="table table-striped table-head-fixed-custom mt-2" id="vam_table" width="100%"
                            cellspacing="0">
                            <thead>{{--  --}}
                                <tr style="white-space:nowrap;">
                                    <th>ดูข้อมูล</th>
                                    <th>ทะเบียน</th>
                                    {{-- <th>ยี่ห้อ</th> --}}
                                    {{-- <th>แผนก</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">ไม่มีข้อมูล</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
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
                    url: '{{ route('vamSearch') }}',
                    type: 'GET',
                    data: {
                        searchInput: searchInput
                    },
                    success: function(response) {
                        displayDataInTable(response);
                    },
                    error: function(error) {
                        console.error('Error fetching chart data', error);
                    }
                });
            });
        });

        function displayDataInTable(data) {
            // เริ่มต้นดึงข้อมูลลงใน tbody ของตาราง
            var tbody = $('#vam_table tbody');

            tbody.empty(); // ลบข้อมูลทั้งหมดใน tbody

            // วนลูปผ่าน JSON Array และสร้างแถวในตารางสำหรับแต่ละรายการ
            if (data.length === 0) {
                // หากไม่มีข้อมูล
                var row =
                    '<tr><td colspan="2">ไม่มีข้อมูล</td></tr>'; // กำหนดคอลัมน์ colspan เพื่อให้ข้อความนี้ครอบคลุมทุกคอลัมน์
                tbody.append(row); // เพิ่มแถวลงใน tbody
            } else {
                data.forEach(function(item) {
                    if (item.note === "") {
                        item.note = "- -";
                    }
                    var row = '<tr>';

                    row += '<td>';
                    row += '<a href="/vam/' + item.id_rec_car + '">';
                    row +=
                        '<img src="https://cdn-icons-png.flaticon.com/128/3767/3767084.png" alt="" style="height: 26px;">';
                    row += '</a>';
                    row += '</td>';
                    row += '<td>' + item.num_register + '</td>';

                    // เพิ่มคอลัมน์เพิ่มเติมตามจำนวนฟิลด์ใน JSON Array

                    row += '</tr>';
                    tbody.append(row); // เพิ่มแถวลงใน tbody
                });
            }

        }
    </script>
@endpush
