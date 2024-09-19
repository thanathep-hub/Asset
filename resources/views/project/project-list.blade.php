@extends('app.app')
@section('title', 'โครงการ')
@push('style')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <style>
        .content {
            background-color: #f1f5f9;
        }

        .h-40 {
            height: 40px;
        }

        #global_filter {
            width: 100%;
            max-width: 400px;
            box-shadow: #f3f4f6 1.95px 1.95px 2.6px;
        }

        @media (max-width: 600px) {
            #btn-repeat-search-project {
                margin: 0px !important;
                margin-bottom: .5rem !important;
            }
        }

        #btn-filter-search-project {
            width: 100%;
            max-width: 100px;
            border-radius: 8px;
            border: none;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            background-color: #64748b;
            color: #fff;
        }

        #btn-repeat-search-project {
            width: 100%;
            max-width: 100px;
            border-radius: 8px;
            border: none;
            box-shadow: #fef9c3 1.95px 1.95px 2.6px;
            background-color: #facc15;
            color: #fff;
        }

        #btn-repeat-search-project:hover {
            border: 1px solid #facc15;
            box-shadow: #fef9c3 1.95px 1.95px 2.6px;
            background-color: #fff;
            color: #facc15;
        }

        #btn-filter-search-project:hover {
            border: 1px solid #64748b;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            background-color: #fff;
            color: #64748b;
        }

        #btn-filter-update {
            border-radius: 8px;
            border: 1px solid #64748b;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            background-color: #64748b;
            color: #fff;
            width: 100px;
        }

        #btn-filter-update:hover {
            border: 1px solid #64748b;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            background-color: #fff;
            color: #64748b;
        }

        /* tom select */
        .ts-control {
            font-size: unset;
            line-height: unset;
            border: unset;
            padding: unset;
        }

        .ts-dropdown {
            font-size: unset;
            border: 1px solid #dee2e6;
            border-radius: 12px;
        }

        .ts-dropdown [data-selectable].option {
            padding: .75rem;
            border-radius: 0px;
        }

        .form-select {
            height: 40px;
        }

        /* tom select */

        /* data table  */
        thead {
            height: 40px;
            font-size: 14px;
            background-color: #e5e7ebf6;
        }

        th {
            text-align: center;
            white-space: nowrap;
        }

        tr {
            height: 40px;
        }

        td:nth-child(1),
        td:nth-child(2),
        td:nth-child(4) {
            text-align: center;
        }

        td:nth-child(5) {
            text-align: end;
        }

        #Project tbody tr:hover {
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <div class="mt-3">
        <div class="card p-4 border-0 mb-3">
            <h4 style="font-weight: 700;">โครงการ</h3>
                <div class="border-bottom mb-3"></div>
                <div class="row mb-3">
                    <div class="col">
                        <input class="h-40 search form-control global_filter" type="text" name="search-project"
                            id="global_filter" placeholder="ค้นหาโครงการ">
                    </div>
                    <div class="col text-end">
                        <button class="btn btn-filter h-40 me-2" id="btn-repeat-search-project" onclick="resetPage()">
                            <i class="fa-solid fa-repeat"></i>
                            รีเซ็ต
                        </button>
                        <button class="btn btn-filter h-40" id="btn-filter-search-project" data-bs-toggle="modal"
                            data-bs-target="#modal-filter-search-project">
                            <i class="fa-solid fa-sliders"></i>
                            ตัวกรอง
                        </button>
                    </div>
                </div>
                <div class="border-bottom mb-3"></div>
                <div class="table-responsive">
                    <table id="Project" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th scope="col">บริษัท</th>
                                <th scope="col">โครงการ</th>
                                <th scope="col">วันที่เริ่มโครงการ</th>
                                <th scope="col">งบประมาณ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>


    {{-- search filter modal setting --}}
    <!-- Modal -->
    <div class="modal fade" id="modal-filter-search-project" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ProjectModalLabel">ตัวกรอง</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="filter-comp" class="form-label">บริษัท</label>
                        <select class="form-select" id="filter-comp" placeholder="ค้นหาบริษัท...">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">ระหว่างวันที่</label>
                        <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">ถึงวันที่</label>
                        <input type="date" class="form-control" id="startEnd">
                    </div>
                    <div class="modal-footer border-0 p-0">
                        <button onclick="filter_save()" type="button" class="btn btn-primary"
                            id="btn-filter-update">ตกลง</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{--  --}}

@endsection
@push('script')
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

    <script>
        var projectComp = {!! json_encode(session('user') ? session('user')->idComp : null) !!};
        $(document).ready(function() {
            console.log("Project Page.");
            fetch_comp();
        });

        let table = new DataTable('#Project', {
            "ajax": {
                "url": "/api/project-list",
                "type": "GET",
                "data": function(d) {
                    // เพิ่มพารามิเตอร์เพิ่มเติมที่นี่
                    d.comp = document.getElementById('filter-comp').value;
                    d.startDate = document.getElementById('startDate').value;
                    d.startEnd = document.getElementById('startEnd').value;
                },
                "dataSrc": ""
            },
            "columns": [{
                    "data": null, // คอลัมน์สำหรับลำดับ
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": "CompCode"
                },
                {
                    "data": "ProjectName"
                },
                {
                    "data": "DateStart"
                },
                {
                    "data": "Budget"
                }
            ],
            "dom": 'lrtip',
            "language": {
                "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/th.json'
            },
        });

        $('#Project tbody').on('click', 'tr', function() {
            let data = table.row(this).data(); // ดึงข้อมูลของแถวที่คลิก
            let id = data.idProject; // ดึงค่า ID จากข้อมูลของแถว
            alert('Row clicked with ID: ' + id);
        });

        document.querySelectorAll('input.global_filter').forEach((el) => {
            el.addEventListener(el.type === 'text' ? 'keyup' : 'change', () =>
                filterGlobal(table)
            );
        });

        function filterGlobal(table) {
            let filter = document.querySelector('#global_filter');
            table.search(filter.value).draw();
        }

        function filter_save() {
            console.log(document.getElementById('filter-comp').value);
            console.log(document.getElementById('startDate').value);
            console.log(document.getElementById('startEnd').value);

            $('#modal-filter-search-project').modal('hide');
        }

        function fetch_comp() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/company",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(data) {

                    $('#filter-comp').empty();
                    $.each(data, function(index, items) {
                        $('#filter-comp').append(`
                    <option value="${items.idComp}" ${items.idComp === projectComp ? 'selected' : ''}>${items.CompName}</option>
                    `);
                    });
                    new TomSelect("#filter-comp", {
                        sortField: {
                            field: "text",
                            direction: "asc",
                        },
                        render: {
                            no_results: function(data, escape) {
                                return '<option class="no-results">ไม่พบข้อมูล</option>';
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function resetPage() {
            window.location.reload();
        }
    </script>
@endpush
