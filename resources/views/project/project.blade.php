@extends('app.app')
@section('title', 'โครงการ')
@push('style')
    <style>
        .content {
            background-image: linear-gradient(to right, #d2e9ee8f, #d5d7e48a)
                /* background-image: linear-gradient(to right, #d2e9ee, #d5d7e4); */
        }

        .card-list-card {
            box-shadow: 0 .25rem .5rem 0 rgb(34 46 60 / 12%);
            border-radius: 12px;
        }

        .card-list-title {
            border-radius: 8px;
            margin-bottom: .5rem;
        }

        .card {
            --bs-card-border-color: none;
        }

        .search-all-project {
            width: 300px;
        }

        .btn-filter {
            height: 40px;
            width: 180px;
            background-color: #169fa8;
            color: #fff;
        }

        .btn-filter:hover,
        .btn-filter:active,
        .btn-filter::after {
            background-color: #116b74;
            color: #fff;
        }

        /* grid js */

        @media only screen and (max-width: 576px) {
            .card-body {
                padding: unset;
            }

            .gridjs-pages {
                float: unset !important;
                text-align: center !important;
            }

            .gridjs-summary {
                float: unset !important;
                text-align: center !important;
            }
        }

        .gridjs-search {
            display: none;
        }

        th.gridjs-th {
            padding: .75rem .5rem .5rem .5rem;
            text-align: center;
            /* background-color: #e7e7e7; */
            background-color: #e8e7ed7d;
        }

        th.gridjs-th:hover {
            background-color: #d1d1d1;
        }

        th.gridjs-th:nth-child(1) {
            text-align: start;
            padding-left: 24px;
        }

        th.gridjs-th:nth-child(4) {
            text-align: start;
            padding-left: 24px;
        }

        tr.gridjs-tr:last-child td {
            /* background-color: yellow;
                                                border-radius: 18px 18px 18px 18px; */
            /* เปลี่ยนพื้นหลังเป็นสีเหลือง */
        }

        td:nth-child(1) {
            text-align: start;
            /* width: 10px; */
        }

        td:nth-child(2) {
            text-align: center;
        }

        td:nth-child(3) {
            text-align: center;
        }

        td:nth-child(4) {
            text-align: start;
        }

        .gridjs-footer {
            box-shadow: none;
        }

        .fa-circle {
            color: #23a66c;
            font-size: 8px;
        }


        /* /grid js */
    </style>
@endpush
@section('content')
    <div class="list-card mt-4">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card card-list-title">
                    <div class="d-flex align-items-center" style="height: 4.25rem;">
                        <div class="icon card-list-card m-2 p-1 border-0" style="width:40px;">
                            <img src="{{ asset('project/growth.png') }}" alt="" width="32px;">
                        </div>
                        <div class="title-list-item align-items-center">
                            <label class="" style="color: #6d6d6d;">โครงการทั้งหมด</label>
                            <h5 class="kanit-semibold p-0 m-0">-</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card card-list-title">
                    <div class="d-flex align-items-center" style="height: 4.25rem;">
                        <div class="icon card-list-card m-2 p-1 border-0" style="width:40px;">
                            <img src="{{ asset('project/stamp.png') }}" alt="" width="32px;">
                        </div>
                        <div class="title-list-item align-items-center">
                            <label class="" style="color: #6d6d6d;">ได้รับการอนุมัติ</label>
                            <p class="kanit-semibold p-0 m-0">-</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card card-list-title">
                    <div class="d-flex align-items-center" style="height: 4.25rem;">
                        <div class="icon card-list-card m-2 p-1 border-0" style="width:40px;">
                            <img src="{{ asset('project/waiting.png') }}" alt="" width="32px;">
                        </div>
                        <div class="title-list-item align-items-center">
                            <label class="" style="color: #6d6d6d;">รอการแก้ไข</label>
                            <p class="kanit-semibold p-0 m-0">-</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card card-list-title">
                    <div class="d-flex align-items-center" style="height: 4.25rem;">
                        <div class="icon card-list-card m-2 p-1 border-0" style="width:40px;">
                            <img src="{{ asset('project/work-in-progress.png') }}" alt="" width="32px;">
                        </div>
                        <div class="title-list-item align-items-center">
                            <label class="" style="color: #6d6d6d;">รอการอนุมัติ</label>
                            <p class="kanit-semibold p-0 m-0">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="option-filter mt-4 mb-3 d-flex justify-content-end">
        <input class="search-all-project form-control" type="search" placeholder="ค้นตามชื่อโครงการ"
            id="search-all-project">
        <div class="mx-2" style="border-right:2px solid #169fa836;"></div>
        <button class="btn btn-filter form-control" type="button">
            <i class="fa-solid fa-table-cells pe-2"></i>
            กรอง</button>
    </div>
    <div class="table-project card p-2">


        <div class="table-responsive">
            <table class="table" id="project_table">
                <thead>
                    <tr>
                        <th>โครงการ</th>
                        <th>บริษัท</th>
                        <th>สถานะ</th>
                        <th>วันที่เริ่มโครงการ</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>


    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            loginLoading();
            get_project_all();
        });

        function get_project_all() {
            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Make the AJAX request with the CSRF token in the headers
            $.ajax({
                url: "/api/project", // Ensure this route is served over HTTPS
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken // Include the CSRF token
                },
                success: function(data) {
                    // Clear the existing table body
                    $('#project_table tbody').empty();

                    // Iterate over the data and append rows to the table body
                    $.each(data.query_result, function(index, project_data) {
                        $('#project_table tbody').append('<tr><td>' + project_data.ProjectName +
                            '</td><td>' +
                            project_data.CompName +
                            '</td><td><i class="fa-solid fa-circle pe-2"></i>' + project_data
                            .ProjStName +
                            '</td><td><i class="fa-solid fa-calendar-days pe-2"></i>' + project_data
                            .cDateStart +
                            '</td></tr>');
                    });

                    // Call a function to render the grid (if needed)
                    rederGridjs();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }


        function rederGridjs() {
            const grid = $("table#project_table").Grid({
                pagination: true,
                sort: true,
                resizable: true,
                language: {
                    'search': {
                        'placeholder': 'ค้นหา...'
                    },
                    'pagination': {
                        'previous': 'ก่อนหน้า',
                        'next': 'ถัดไป',
                        'showing': 'แสดง',
                        'results': () => 'ผลลัพธ์',
                        'to': 'ถึง',
                        'of': 'จาก',
                        'noResults': 'ไม่พบผลลัพธ์',
                        'loading': 'กำลังโหลด...',
                        'show': 'แสดง'
                    }
                }
            });

            const searchInput = document.getElementById("search-all-project");
            searchInput.addEventListener("input", function(e) {
                const searchString = e.target.value;
                grid.updateConfig({
                    search: {
                        keyword: searchString
                    },
                }).forceRender();
            });
            setTimeout(function() {
                StoploginLoading();
            }, 2000);

        }

        function loginLoading() {
            console.log("test load");
            document.getElementById('loadingWait')?.classList.remove('d-none');
            document.getElementById('loadingWait')?.classList.add('d-flex');
        }

        function StoploginLoading() {

            document.getElementById('loadingWait')?.classList.remove('d-flex');
            document.getElementById('loadingWait')?.classList.add('d-none');
        }
    </script>
@endpush
