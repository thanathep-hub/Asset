@extends('layouts.master')
@section('title', 'บิลสินทรัพย์')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <style>
        body {
            background-color: #f4f6f9;
        }

        table#asset_repair {
            font-size: 14px;
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

        .asset_repair:hover {
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
            /* margin-left: 0.5rem; */
            margin-bottom: unset;
        }

        .comp-label {
            place-self: center;
            /* margin-left: 0.5rem; */
            margin-bottom: unset;
        }
    </style>
@endpush
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid pt-2">
            <div class="card mb-4 ">
                <div class="card-header py-3 title-assett-active">
                    <h6 class="m-0 font-weight-bold text-primary">ตารางข้อมูลบิล</h6>
                </div>
                <div class="card-tools col-lg-6 my-2" style="align-self: center;">
                    <div class="input-group input-group-md">
                        <div class="input-group-append mx-1">
                            <button class="btn" id="searchFilter" data-target="#search-filter" data-toggle="modal">
                                <i class="fas fa-filter"> Filter</i>
                            </button>
                        </div>
                        <input type="text" id="searchInput" class="form-control" placeholder="รายการซ่อม, เลขที่บิลซ่อม"
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
                        <table class="table" id="asset_repair" width="100%" cellspacing="0">

                            <thead
                                style="background-color: #343a40;color:#fff;position: sticky;
                            top: 0;
                            z-index: 10;">
                                <tr style="text-align: center;white-space:nowrap;">
                                    {{-- <th class="brr">ดูข้อมูล</th> --}}
                                    <th class="brr">ใบเสร็จ</th>
                                    <th class="brr">วันที่บิลซ่อม</th>
                                    <th class="brr">บริษัท</th>
                                    {{-- <th class="brr">วันที่บิลซ่อม</th> --}}
                                    <th class="brr">เลขที่บิลซ่อม</th>
                                    <th class="brr">รวมสุทธิ</th>
                                    <th>หมายเหตุ</th>
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
                                @if (session('idPositions') == 15)

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
                        <div class="col-lg-6 row">
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
                    <button type="button" class="btn" id="filterSearch"
                        style="background-color: #21b5ae;color:white;width:124px;font-weight: bold;">ค้นหา</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- bill images --}}
    <div class="modal fade" id="bill-image">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="box-shadow: none;border:none;border-radius:0px;">
                <form action="/asset_active" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title"><b>รูปบิลซ่อม</b></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 align-self-center">
                                <div class="preview-area"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script type="text/javascript">
        $('#filterSearch').click(function() {
            filterSearch();
            $('#search-filter').modal('hide');
        });

        function filterSearch() {
            var id_comp = $('#comp').val();
            var dateFirst = $('#dateFirst').val();
            var dateSecond = $('#dateSecond').val();
            console.log(id_comp);
            $.ajax({
                url: '{{ route('search_filter_date') }}',
                type: 'GET',
                data: {
                    id_comp: id_comp,
                    dateFirst: dateFirst,
                    dateSecond: dateSecond
                },
                success: function(response) {
                    if (response.length < 1) {
                        callAlert();
                    }
                    search_repair(response);
                    console.log(response);
                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });
        }

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

        function callAlert() {
            Swal.fire({
                title: 'ข้อมูลบิลซ่อม',
                text: 'ไม่มีข้อมูลในรายการค้นหา',
                icon: 'info',
                confirmButtonText: 'ตกลง'
            });
        }

        function search_repair(data) {
            var tbody = $('#asset_repair tbody');
            tbody.empty();
            if (data.length === 0) {
                var row =
                    '<tr><td colspan="6" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล</td></tr>';
                tbody.append(row);
            } else {
                data.forEach(function(item, index) {
                    setTimeout(function() {
                        if (index < 30) {
                            var row = '<tr data-id="' + item.idRepair + '" class="asset_repair">';
                            row += '<td class="brr tac" style="padding:unset;vertical-align: middle;">' +
                                '<a style="cursor: pointer;" data-toggle="modal" data-target="#bill-image" onclick="bill_image(' +
                                item.idRepair +
                                ')"><img src="{{ asset('imges/bill.png') }}" alt="" style="height: 26px;"></a>' +
                                '</td>';
                            row += '<td class="text brr tac">' + item.BillDate + '</td>';
                            row += '<td class="text brr tac">' + item.CompCode + '</td>';
                            row += '<td class="brr tac">' + item.RepairCode + '</td>';
                            row += '<td class="brr tar">' + item.TotalNet + '</td>';
                            row += '<td class="text">' + item.Note + '</td>';
                            row += '</tr>';
                            tbody.append(row);
                            if (index == data.length - 1) {
                                $('#loadingStartPage').modal('hide');
                            }
                            // console.log(index, data.length - 1);
                        } else {
                            $('#loadingStartPage').modal('hide');
                            return;
                        }
                    }, (index + 1) * 75);
                });
            }
        }

        $(document).ready(function() {
            $('#loadingStartPage').modal('show');
            asset_search();
            $('#asset_repair').on('click', '.asset_repair', function() {
                var assetIdRepair = $(this).data('id');
            });
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
            $.ajax({
                url: '{{ route('search_repair') }}',
                type: 'GET',
                data: {
                    searchInput: searchInput
                },
                success: function(response) {
                    if (response.length < 1) {
                        callAlert();
                    }
                    search_repair(response);
                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });
        }

        function bill_image(id) {
            var assetIdRepair = id;
            async function isImageUrl(assetIdRepair) {
                try {
                    const response = await fetch(assetIdRepair, {
                        method: 'HEAD'
                    });
                    const contentType = response.headers.get('content-type');
                    return contentType.includes('image');
                } catch (error) {
                    console.error('An error occurred:', error);
                    return false;
                }
            }
            var image = [1, 2, 3, 4];
            var imagList = [];
            var counter = 0;
            var promises = image.map(async (element) => {
                var imageUrl = 'http://203.151.27.229/spm/POP/images/pBill/AssetAM' + assetIdRepair + '_' +
                    element + '.jpg';
                const isImage = await isImageUrl(imageUrl);
                if (isImage) {
                    imagList.push(imageUrl);
                    counter++;
                }
            });
            Promise.all(promises).then(() => {
                let output = "";
                for (let i = 0; i < imagList.length; i++) {
                    output += `<img data-enlargable src="${imagList[i]}" alt="Image ${i + 1}">`;
                }
                const previewArea = document.querySelector('.preview-area');
                previewArea.innerHTML = output;
                const previewImages = document.querySelectorAll('[data-enlargable]');
                previewImages.forEach(image => {
                    image.addEventListener('click', () => {
                        const enlargedImage = document.createElement('div');
                        enlargedImage.className = 'enlarged';
                        enlargedImage.innerHTML = `<img src="${image.src}" alt="${image.alt}">`;
                        enlargedImage.style.position = 'fixed';
                        enlargedImage.style.top = '0';
                        enlargedImage.style.left = '0';
                        enlargedImage.style.width = '100%';
                        enlargedImage.style.height = '100%';
                        enlargedImage.style.background = 'rgba(0, 0, 0, 0.8)';
                        enlargedImage.style.zIndex = '9999';
                        enlargedImage.style.display = 'flex';
                        enlargedImage.style.alignItems = 'center';
                        enlargedImage.style.justifyContent = 'center';
                        enlargedImage.style.cursor = 'zoom-out';
                        document.body.appendChild(enlargedImage);
                        enlargedImage.addEventListener('click', () => {
                            document.body.removeChild(enlargedImage);
                        });
                    });
                });
            });
        }
    </script>
@endpush
