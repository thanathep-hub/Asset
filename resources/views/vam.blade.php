@extends('layouts.master')
@section('title', 'VAM')
@push('css')
    <style>
        table#vam_table {
            font-size: 12px;
        }

        .brr {
            border-right: 1px solid #dee2e6;
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

        .vamRow:hover {
            background-color: rgb(152, 238, 152);
            cursor: pointer;
        }
    </style>
@endpush
@section('content')

    <!-- Main content -->
    <section class="content" style="padding: 0.5rem 0.5rem;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <svg xmlns="http://www.w3.org/2000/svg" height="36" width="36"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M165.4 96H346.6c13.6 0 25.7 8.6 30.2 21.4L402.9 192H109.1l26.1-74.6c4.5-12.8 16.6-21.4 30.2-21.4zm-90.6 .3L39.6 196.8C16.4 206.4 0 229.3 0 256v80c0 23.7 12.9 44.4 32 55.4V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V400H384v48c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V391.4c19.1-11.1 32-31.7 32-55.4V256c0-26.7-16.4-49.6-39.6-59.2L437.2 96.3C423.7 57.8 387.4 32 346.6 32H165.4c-40.8 0-77.1 25.8-90.6 64.3zM208 272h96c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H208c-8.8 0-16-7.2-16-16V288c0-8.8 7.2-16 16-16zM48 280c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H72c-13.3 0-24-10.7-24-24zm360-24h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H408c-13.3 0-24-10.7-24-24s10.7-24 24-24z" />
                            </svg>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">VAM จำนวนทั้งหมด</span>
                            <span class="info-box-number">{{ $CarTotal->CarTotal }} รายการ</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
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
                            <div class="btn" id="searchButton"
                                style="background-color:#21b5ae;border-color:#21b5ae;color:#ffffff;">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-1 card-body p-0">
                    <div class="table-responsive" style="height: 500px;">
                        <table class="table" id="vam_table" width="100%" cellspacing="0">
                            <thead
                                style="background-color: #343a40;color:#fff;position: sticky;
                            top: 0;
                            z-index: 10;">
                                <tr style="text-align: center;white-space:nowrap;">
                                    <th class="brr">ดูข้อมูล</th>
                                    <th class="brr">ทะเบียน</th>
                                    <th class="brr">ยี่ห้อ</th>
                                    <th>แผนก</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4">ไม่มีข้อมูล</td>
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

    <div class="modal fade" id="loadingStartPage" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="justify-content: center;">
            <button class="btn btn-primary" type="button" readonly>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                กำลังโหลด...
            </button>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#loadingStartPage').modal('show');
            searchVam();

            // เมื่อคลิกที่ปุ่มค้นหา
            $('#searchButton').click(function() {
                searchVam();
            });

            $('#vam_table').on('click', '.vamRow', function() {
                var assetId = $(this).data('id'); // ดึงค่า id ของทรัพยากรจาก data-id ของแถว
                window.location.href = "/vam/" +
                    assetId; // นำ id ไปสร้าง URL และเปลี่ยนเส้นทางของหน้าเว็บไปยังหน้ารายละเอียดทรัพยากร
            });
        });

        function searchVam() {
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
        }

        function displayDataInTable(data) {
            // เริ่มต้นดึงข้อมูลลงใน tbody ของตาราง
            var tbody = $('#vam_table tbody');

            tbody.empty(); // ลบข้อมูลทั้งหมดใน tbody

            // วนลูปผ่าน JSON Array และสร้างแถวในตารางสำหรับแต่ละรายการ
            if (data.length === 0) {
                // หากไม่มีข้อมูล
                var row =
                    '<tr><td colspan="4">ไม่มีข้อมูล</td></tr>'; // กำหนดคอลัมน์ colspan เพื่อให้ข้อความนี้ครอบคลุมทุกคอลัมน์
                tbody.append(row); // เพิ่มแถวลงใน tbody
            } else {
                data.forEach(function(item, index) {
                    setTimeout(function() {
                        if (item.note === "") {
                            item.note = "- -";
                        }
                        var row = '<tr data-id="' + item.id_rec_car + '" class="vamRow">';

                        row += '<td class="brr">';
                        row += '<a href="/vam/' + item.id_rec_car + '">';
                        row +=
                            '<img src="{{ asset('imges/open.png') }}" alt="" style="height: 26px;">';
                        row += '</a>';
                        row += '</td>';
                        row += '<td class="brr">' + item.num_register + '</td>';
                        row += '<td class="brr">' + item.name_brand_car + '</td>';
                        row += '<td>' + item.department + '</td>';

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
    </script>
@endpush
