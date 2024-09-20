@extends('app.app')
@section('title', 'โครงการ')
@push('style')
    <!-- DataTables CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
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
            border-radius: 4px;
        }

        #project-img {
            justify-content: space-around;
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
            display: none;
        }

        @media (max-width: 600px) {}
    </style>
@endpush
@section('content')
    <div class="mt-3">
        <div class="card p-4 border-0 mb-3">
            <h4 style="font-weight: 700;">รายละเอียดโครงการ</h3>
                <div class="border-bottom mb-3"></div>
                <div class="row mb-3">
                    <div class="col-12 col-md-6 col-lg-6">
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
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="p-2 border">
                            <h5 class="mb-3" style="text-align: center;">ภาพประกอบโครงการ</h5>
                            <div class="project-image-list row gap-2 p-0 m-0" id="project-img">
                                {{-- <div class="col-auto" style="">
                                    <img class="img" src="{{ $img_path . $pDetails->idProject }}_1.jpg">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom mb-3"></div>
                <div class="table-items-list">
                    <h5>รายการวัสดุที่ใช้</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered " id="detail-items">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ชื่อ</th>
                                    <th scope="col">จำนวน</th>
                                    <th scope="col">หน่วย</th>
                                    <th scope="col">ราคา</th>
                                    <th scope="col">รวมเป็นเงิน</th>
                                    <th scope="col">Supplier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pItems as $index => $items)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $items->InvName_ ? $items->InvName_ : '' }}</td>
                                        <td>{{ $items->Amount ? number_format($items->Amount) : '' }}</td>
                                        <td>{{ $items->UnitName ? $items->UnitName : '' }}</td>
                                        <td>{{ $items->Price ? '฿' . number_format($items->Price, 2) : '' }}</td>
                                        <td>{{ $items->TotalPrice ? '฿' . number_format($items->TotalPrice, 2) : '' }}</td>
                                        <td>{{ $items->SupName ? $items->SupName : '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">ไม่มีรายการ</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>

    <div class="modal fade" id="loader" data-bs-backdrop="static" tabindex="-1" aria-labelledby="loader"
        aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <button class="btn btn-primary" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                    <span role="status">Loading...</span>
                </button>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            checkImage();
            // $('#loader').modal('show');
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
                            <img class="img" src="${'{{ $img_path . $pDetails->idProject }}_' + index + '.jpg'}">
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
    </script>
@endpush
