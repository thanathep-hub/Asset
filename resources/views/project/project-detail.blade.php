@extends('app.app')
@section('title', 'โครงการ')
@push('style')
    <!-- DataTables CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .content {
            background-color: #f1f5f9;
        }

        .h-label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: .5rem;
            color: #000;
            width: 100%;
            max-width: 140px;
            min-width: 125px;
            white-space: nowrap;
            padding-right: .5rem;
        }

        .img {
            height: 100%;
            max-height: 140px;
            min-height: 100px;
            width: 100%;
            max-width: 140px;
            min-width: 100px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        #project-img {
            /* justify-content: space-around; */
        }

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

        td {
            white-space: nowrap;
        }

        td:nth-child(1),
        td:nth-child(3),
        td:nth-child(4) {
            text-align: center;
        }

        td:nth-child(5),
        td:nth-child(6) {
            text-align: end;
        }

        #Project tbody tr:hover {
            cursor: pointer;
        }

        .dataTables_filter {
            /* display: none; */
        }

        @media (max-width: 600px) {
            .h-label {
                max-width: 125px !important;
            }
        }

        /* img full screen */
        .full-screen-modal {
            align-content: center;
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .full-screen-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .close-fullscreen {
            position: absolute;
            top: 20px;
            right: 35px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-fullscreen:hover,
        .close-fullscreen:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        .img:hover {
            cursor: pointer;
        }

        /* / */

        @media (max-width: 576px) {
            .form-control {
                padding: 0px !important;
            }
        }
    </style>
@endpush
@section('content')
    <div class="mt-3">
        <div class="card p-3 p-md-4 border-0 mb-3">
            <h5 style="font-weight: 600;">รายละเอียดโครงการ</h5>
            <div class="border-bottom mb-3"></div>
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 mb-3">
                    <div class="form-control border-0 d-flex">
                        <label for="" class="h-label">ชื่อโครงการ</label>
                        <label for=""
                            id="project-name">{{ $pDetails->ProjectName ? $pDetails->ProjectName : '' }}</label>
                    </div>
                    <div class="form-control border-0 d-flex">
                        <label for="" class="h-label">งบประมาณ</label>
                        <label for=""
                            id="project-budget">{{ $pDetails->Budget ? '฿' . number_format($pDetails->Budget, 2) : '' }}</label>
                    </div>
                    <div class="form-control border-0 d-flex">
                        <label for="" class="h-label">กลุ่มโครงการหลัก</label>
                        <label for=""
                            id="project-main-name">{{ $pDetails->PjGroupMainName ? $pDetails->PjGroupMainName : '' }}</label>
                    </div>
                    <div class="form-control border-0 d-flex">
                        <label for="" class="h-label">กลุ่มโครงการรอง</label>
                        <label for=""
                            id="project-sub-name">{{ $pDetails->PjGroupSubName ? $pDetails->PjGroupSubName : '' }}</label>
                    </div>
                    <div class="form-control border-0 d-flex">
                        <label for="" class="h-label">ผู้สั่งดำเนินการ</label>
                        <label for=""
                            id="project-command-name">{{ $pDetails->PsNamecom ? $pDetails->PsNamecom : '' }}</label>
                    </div>
                    <div class="form-control border-0 d-flex">
                        <label for="" class="h-label">วันที่เริ่มโครงการ</label>
                        <label for=""
                            id="project-date-start">{{ $pDetails->DateStart ? $pDetails->DateStart_f : '' }}</label>
                    </div>
                    <div class="form-control border-0 d-flex">
                        <label for="" class="h-label">วันที่คาดว่าจะเสร็จสิ้น</label>
                        <label for=""
                            id="project-date-start">{{ $pDetails->DateEnd ? $pDetails->DateEnd_f : '' }}</label>
                    </div>
                    <div class="form-control border-0 d-flex">
                        <label for="" class="h-label">อำเภอ</label>
                        <label for=""
                            id="project-district-name">{{ $pDetails->ApName ? $pDetails->ApName : '' }}</label>
                    </div>
                    <div class="form-control border-0 d-flex">
                        <label for="" class="h-label">จังหวัด</label>
                        <label for=""
                            id="project-district-name">{{ $pDetails->ProvinceName ? $pDetails->ProvinceName : '' }}</label>
                    </div>
                    <div class="form-control border-0 d-flex">
                        <label for="" class="h-label">รายละเอียด</label>
                        <label for="" id="project-note">{{ $pDetails->Note ? $pDetails->Note : '' }}</label>
                    </div>
                </div>
                {{-- <div class="col-12 col-md-6 col-lg-6 mb-3">
                    <div class="p-3" style="background-color: #f3f4f6;border-radius: 8px;">
                        <h5 class="mb-3" style="text-align: start;">ภาพประกอบโครงการ</h5>
                        <div class="project-image-list row gap-2 p-0 m-0" id="project-img">
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="border-bottom mb-3"></div>
            <div class="table-items-list">
                <h6>รายการวัสดุที่ใช้</h6>
                <div class="table-responsive">
                    <table class="table table-bordered" id="section-table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-start">ประเภทวัสดุ</th>
                                <th class="text-center">จำนวนวัสดุ</th>
                                <th class="text-end">ราคารวม</th>
                                <th class="text-center">ดูรายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sectionSummary as $i => $section)
                                <tr class="section-header" data-section="{{ $i }}">
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td class="text-start">{{ $section['section'] }}</td>
                                    <td class="text-center">{{ $section['count'] }}</td>
                                    <td class="text-end">฿{{ $section['total'] }}</td>
                                    <td class="text-center">
                                        <span class="toggle-section" style="cursor:pointer;">
                                            <i class="bi bi-chevron-down"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr class="section-detail section-{{ $i }}" style="display:none;">
                                    <td colspan="5">
                                        <div style="max-height: 300px; overflow-y: auto;">
                                            <table class="table table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>ชื่อ</th>
                                                        <th>จำนวน</th>
                                                        <th>หน่วย</th>
                                                        <th>ราคา</th>
                                                        <th>รวมเป็นเงิน</th>
                                                        <th>Supplier</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($section['items'] as $index => $item)
                                                        <tr>
                                                            <td class="align-content-center">{{ $index + 1 }}</td>
                                                            <td class="align-content-center">{{ $item->InvName_ ?? '' }}
                                                            </td>
                                                            <td class="align-content-center">
                                                                {{ $item->Amount ? number_format($item->Amount) : '' }}
                                                            </td>
                                                            <td class="align-content-center">{{ $item->UnitName ?? '' }}
                                                            </td>
                                                            <td class="align-content-center">
                                                                {{ $item->Price ? '฿' . number_format($item->Price, 2) : '' }}
                                                            </td>
                                                            <td class="align-content-center">
                                                                {{ $item->TotalPrice ? '฿' . number_format($item->TotalPrice, 2) : '' }}
                                                            </td>
                                                            <td class="align-content-center">{{ $item->SupName ?? '' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="fullScreenModal" class="full-screen-modal">
        <span class="close-fullscreen">&times;</span>
        <img class="full-screen-content" id="fullScreenImage">
    </div>

@endsection
@push('script')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            checkImage();
            // $('#loader').modal('show');
            totalP();
        });
        let checkImage = function() {
            let textImg = '';
            for (let index = 1; index < 11; index++) {
                var s = document.createElement("IMG");
                s.src = '{{ $img_path . $pDetails->idProject }}' + '_' + index + '.jpg';
                s.onerror = function() {
                    // console.log('error: ' + '{{ $img_path . $pDetails->idProject }}' + '_' + index + '.jpg');
                };
                s.onload = function() {
                    textImg += `
                        <div class="col-auto" style="">
                            <img onclick="fullscreenImg(this.src)" class="img" src="${'{{ $img_path . $pDetails->idProject }}_' + index + '.jpg'}">
                        </div>
                    `;
                    $('#project-img').append(textImg);
                    textImg = '';
                };
            }
        };
        let table = new DataTable('#detail-items', {
            "language": {
                "url": '//cdn.datatables.net/plug-ins/1.13.6/i18n/th.json'
            },
        });

        function totalP() {
            $('#detail-items_filter').empty();
            $('#detail-items_filter').append(`
                <label> รวมเป็นเงิน <strong>{{ $total }}</strong> บาท</label>
            `);
        }

        function fullscreenImg(src) {
            fullScreenModal.style.display = 'block';
            fullScreenImage.src = src;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const fullScreenModal = document.getElementById('fullScreenModal');
            const fullScreenImage = document.getElementById('fullScreenImage');
            const closeBtn = document.querySelector('.close-fullscreen');

            closeBtn.addEventListener('click', function() {
                fullScreenModal.style.display = 'none';
            });

            fullScreenModal.addEventListener('click', function(event) {
                if (event.target === fullScreenModal) {
                    fullScreenModal.style.display = 'none';
                }
            });
        });

        $(document).ready(function() {
            $('.toggle-section').on('click', function() {
                var sectionIndex = $(this).closest('.section-header').data('section');
                $('.section-' + sectionIndex).toggle();
                $(this).find('i').toggleClass('bi-chevron-down bi-chevron-up');
            });
        });
    </script>
@endpush
