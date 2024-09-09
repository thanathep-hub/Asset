@extends('project.project-layout')
@section('title', 'โครงการ')
@push('style')
    <style>
        body {
            background-image: linear-gradient(to bottom, #e0ebf9, #fde6e7);
            min-height: 100vh;
        }

        .invalid {
            border: 1px solid #ff0000 !important;
        }

        #btnnotconfirm1.disabled {
            background-color: #f49d0c;
            cursor: not-allowed;
            pointer-events: none;
        }

        #btnnotconfirm2.disabled {
            background-color: #fb7a6e;
            cursor: not-allowed;
            pointer-events: none;
        }

        .card {
            --bs-card-border-color: #00000009;
        }

        .card-approve {
            background-color: #f6f5fa;
            border-radius: 8px;
        }

        .card-btn-approve {
            height: 3.75rem;
            /* margin: 0 1.75rem; */
            background-color: #fff;
            align-content: center;
            border-radius: 8px;
        }

        .border-bm {
            border-bottom: 2px solid #00000009;
        }

        .border-left-cus {
            border-left: 1px solid #00000010;
        }

        .logo-company {
            align-content: center;
        }

        .tital-project {
            align-content: center;
        }

        .f-14 {
            font-size: 14px;
        }

        .f-15 {
            font-size: 15px;
        }

        .color-gray {
            color: gray;
        }

        .text-b {
            font-weight: bold;
        }

        .project-icon {
            height: 40px;
        }

        .btn-approve {
            /* border: 1px solid #087c69; */
            background-color: #5587dc;
            border-radius: 8px;
            color: #fff;
            /* width: 140px; */
        }

        .btn-approve:hover {
            background-color: #2d417b;
            border-radius: 8px;
            color: #fff;
        }

        .btn-not-approve {
            border-radius: 8px;
            color: #000;
            /* width: 140px; */
        }

        .btn-not-approve:hover {
            /* background-color: #808080; */
            background-color: #f7aab2;
            border-radius: 8px;
            color: #fff;
        }

        /* btn-approve-fixed */
        .btn-approve-fixed {
            background-color: #5587dc;
            border-radius: 8px;
            color: #fff;
            width: 160px;

        }

        .btn-approve-fixed:hover {
            background-color: #2d417b;
            color: #fff;
        }

        .btn-approve-fixed:active {
            /* background-color: #2d417b; */
            background-color: #416ccf;
            color: #fff;
        }

        .btn-not-approve-fixed {
            width: 160px;
            color: #212529;
            /* background-color: #f8f9fa; */
            background-color: #8aaacb2e;
            border-color: #f8f9fa;
        }

        .btn-not-approve-fixed:hover {
            /* background-color: #808080; */
            background-color: #f7aab2;
            color: #fff;
        }

        .btn-not-approve-fixed:focus {
            background-color: #808080;
            color: #fff;
            border: none;
        }

        .btn-not-approve-fixed-modal {
            background-color: #fb7a6e;
        }

        .btn-not-approve-fixed-modal-update {
            background-color: #f49d0c;
        }

        .btn-not-approve-fixed-modal-update:hover {
            background-color: #f49d0c;
        }

        .btn-not-approve-fixed-modal-update:active {
            background-color: #f49d0c;
        }

        .btn-not-approve-fixed-modal-update:focus {
            background-color: #f49d0c;
        }

        .btn-not-approve-fixed-modal:hover {
            background-color: #e03222;
        }

        .btn-not-approve-fixed-modal:active {
            background-color: #e03222;
        }

        .btn-not-approve-fixed-modal:focus {
            background-color: #e03222;
        }

        .fixed-bottom {
            /* backdrop-filter: blur(5px); */
        }

        button.btn-close {
            background-color: #effef7;
            border-radius: 50%;
            color: gray;
        }

        /* table list  */
        td {
            border: 2px solid #00000009;
        }

        td:first-child {
            border-left: none;
        }

        td:last-child {
            border-right: none;
        }

        .form-select option:hover {
            padding: 1rem;
            border-radius: 1rem;
        }

        /*  */

        /* select option not approved */
        .dropdown-toggle {
            border: 1px solid #e7e7e7;
            font-size: 14px;
        }

        .dropdown-toggle:hover,
        .dropdown-toggle:active,
        .dropdown-toggle:focus {
            border: 1px solid #e7e7e7;
        }

        /* .dropdown-toggle::after {
                                    background-color: #000;
                                } */

        /* scroll */
        ::-webkit-scrollbar {
            width: 0px;
        }
    </style>
@endpush
@section('content')
    <div class="modal fade" id="show-modal-loading" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false" style="align-content: center;
    margin-top: -5rem;">
        <div class="modal-dialog" style="text-align: -webkit-center;">
            <div class="loader"></div>
        </div>
    </div>

    <div class="project-card card mt-4 mb-4 bg-white accent-blue" style="margin-bottom:3rem;">
        <div class="row m-2 mt-4" style="margin-bottom:3rem;">
            <div class="col-lg-8">
                <div class="">
                    <div class="project-title d-flex">
                        <div class="logo-company pe-4">
                            <img src="https://seedsgroup.dyndns.org/spm/Center/Logo/{{ $query_mt->idComp ?? '-' }}.jpg"
                                style="width:60px;">
                        </div>
                        <div class="tital-project">
                            <h6>{{ $query_mt->ProjectName ?? '-' }}</h6>
                            <label class="p-0 m-0" style="color: gray;">รหัสโครงการ
                                :{{ $query_mt->ProjectCode ?? '-' }}</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="project-detail">
                        <h6 class="d-flex align-items-center">
                            <img class="project-icon pe-2"
                                src="{{ asset('project/project-management.png') }}">{{ $query_mt->ProjectName ?? '-' }}
                        </h6>
                        {{-- <p class="m-0 color-gray">รหัสโครงการ : {{ $query_mt->ProjectCode ?? '-' }}</p> --}}
                        <p class="f-14 m-0 color-gray">กลุ่มโครงการรอง :
                            <span class="f-14 m-0 text-dark">{{ $query_mt->PjGroupMainName ?? '-' }}</span>
                        </p>
                        <p class="f-14 m-0 color-gray ">กลุ่มโครงการหลัก :
                            <span class="f-14 m-0 text-dark">{{ $query_mt->PjGroupSubName ?? '-' }}</span>
                        </p>
                        <br>
                        <div class="border-bm mb-3"></div>

                        <p class="text-b f-15">ระยะเวลาโครงการ
                            <img class="ps-1" src="{{ asset('project/timetable.png') }}" height="24px;">
                        </p>
                        <p class="f-14 m-0 color-gray">
                            วันที่เริ่ม:
                            <span class="m-0 text-dark">
                                {{ \Carbon\Carbon::parse($query_mt->cDateStart)->locale('th')->addYears(543)->translatedFormat('d F Y') ?? '-' }}
                            </span>
                        </p>
                        <p class="f-14 color-gray">
                            วันที่คาดว่าจะสิ้นสุด:
                            <span class="text-dark">
                                {{ \Carbon\Carbon::parse($query_mt->cDateEnd)->locale('th')->addYears(543)->translatedFormat('d F Y') ?? '-' }}
                            </span>
                        </p>


                        </p>
                        <div class="border-bm mb-3"></div>
                        <p class="f-14 m-0 color-gray">จังหวัดของโครงการ:
                            <span class="f-14 text-dark"> {{ $query_mt->ProvinceName ?? '-' }}</span>
                        </p>
                        <p class="f-14 m-0 color-gray ">อำเภอของของโครงการ:
                            <span class="f-14 text-dark"> {{ $query_mt->ApName ?? '-' }}</span>
                        </p>
                        <br>
                        <p class="f-14 m-0 color-gray d-inline">รายละเอียด :
                        <p class="f-14 d-inline "> {{ $query_mt->Note ?? '-' }}</p>
                        </p>
                        <p class="f-14 m-0 color-gray d-inline align-items-center"><img class="pe-2"
                                src="{{ asset('project/accounting.png') }}" height="24px"> งบประมาณ :
                        <p class="f-14 d-inline "> {{ number_format($query_mt->Budget, 2) ?? '-' }} บาท</p>
                        </p>
                        <div class="border-bm mb-3 d-lg-none"></div>
                        <p class="f-14 m-0 color-gray mb-3">เอกสารที่แนบมา :
                            <img src="{{ asset('project/copy.png') }}" height="40px" data-bs-toggle="modal"
                                data-bs-target="#show-file-project"
                                style="box-shadow: 0 0 .875rem 0 rgba(34, 46, 60, .05);">
                        </p>
                        <div class="border-bm mb-3 d-lg-none"></div>
                    </div>
                </div>
            </div>
            @if ($permiss->check && $check_approve->idPsCheck == null && $check_approve->idPsCancel == null)
                <div class="col-lg-4 card-approve d-none d-lg-block">
                    <div class="text-start pt-3 mb-1 ">
                        <img class="pe-2" src="{{ asset('project/quality-control-ap.png') }}" height="32px">
                        <label class="f-15 text-b">ตรวจสอบโครงการ</label>
                    </div>
                    <div class="border-b mb-3 mt-3" style="border: 1px solid #86b7fe"></div>
                    <div class="row mt-4 m-1">
                        <button type="button" class="col-12 btn btn-approve mb-2" data-bs-toggle="modal"
                            data-bs-target="#show-modal-check">ตรวจสอบโครงการ</button>
                    </div>
                </div>
            @elseif($permiss->accept && $check_approve->idPsAccept == null && $check_approve->idPsCancel == null)
                <div class="col-lg-4 card-approve d-none d-lg-block">
                    <div class="text-start pt-3 mb-1 ">
                        <img class="pe-2" src="{{ asset('project/quality-control-ap.png') }}" height="32px">
                        <label class="f-15 text-b">รับทราบโครงการ</label>
                    </div>
                    <div class="border-b mb-3 mt-3" style="border: 1px solid #86b7fe"></div>
                    <div class="row mt-4 m-1">
                        <button type="button" class="col-12 btn btn-approve mb-2" data-bs-toggle="modal"
                            data-bs-target="#show-modal-accept">รับทราบโครงการ</button>
                    </div>
                </div>
            @elseif($permiss->confirm_1 && $check_approve->idPsConfirm == null && $check_approve->idPsCancel == null)
                <div class="col-lg-4 card-approve d-none d-lg-block">
                    <div class="text-start pt-3 mb-1 ">
                        <img class="pe-2" src="{{ asset('project/quality-control-ap.png') }}" height="32px">
                        <label class="f-15 text-b">อนุมัติโครงการ</label>
                    </div>
                    <div class="border-b mb-3 mt-3" style="border: 1px solid #86b7fe"></div>
                    <div class="mb-3 f-15 color-gray d-none">
                        <label for="note_project f-14">หมายเหตุ(โปรดระบุ)</label>
                        <textarea class="form-control f-14" id="note_approve_1" rows="3" {{-- placeholder="เหตุผล : ในการอนุมัติ / ไม่อนุมัติ" --}}></textarea>
                    </div>
                    <div class="row mt-4 m-1">
                        <button type="button" class="col-12 btn btn-approve mb-2" data-bs-toggle="modal"
                            data-bs-target="#show-modal-approve-1">อนุมัติโครงการ(1)</button>
                        <button type="button" class="col-12 btn btn-not-approve" data-bs-toggle="modal"
                            data-bs-target="#show-modal-not-approve-1">ไม่อนุมัติโครงการ(1)</button>
                    </div>
                </div>
            @elseif($permiss->confirm_2 && $check_approve->idPsConfirm2 == null && $check_approve->idPsCancel == null)
                <div class="col-lg-4 card-approve d-none d-lg-block">
                    <div class="text-start pt-3 mb-1 ">
                        <img class="pe-2" src="{{ asset('project/quality-control-ap.png') }}" height="32px">
                        <label class="f-15 text-b">อนุมัติโครงการ</label>
                    </div>
                    <div class="border-b mb-3 mt-3" style="border: 1px solid #86b7fe"></div>
                    <div class="mb-3 f-15 color-gray d-none">
                        <label for="note_project f-14">หมายเหตุ(โปรดระบุ)</label>
                        <textarea class="form-control f-14" id="note_approve_2" rows="3" {{-- placeholder="เหตุผล : ในการอนุมัติ / ไม่อนุมัติ" --}}></textarea>
                    </div>
                    <div class="row mt-4 m-1">
                        <button type="button" class="col-12 btn btn-approve mb-2" data-bs-toggle="modal"
                            data-bs-target="#show-modal-approve-2">อนุมัติโครงการ(2)</button>
                        <button type="button" class="col-12 btn btn-not-approve" data-bs-toggle="modal"
                            data-bs-target="#show-modal-not-approve-2">ไม่อนุมัติโครงการ(2)</button>
                    </div>
                </div>
            @endif


            <div class="border-bm mb-3 d-none d-lg-block"></div>
            @if (count($query_dt) > 0)
                <div class="lis-material d-none d-lg-block">
                    <h6><img src="{{ asset('images/checklist.png') }}" alt="" height="24px"> รายการวัสดุ</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:72px;"><i class="fa-solid fa-list-ol pe-2"></i>ลำดับ</th>
                                <th class=""><i class="fa-solid fa-bars-progress pe-2"></i>รายการ</th>
                                <th class="text-end"><i class="fa-regular fa-rectangle-list pe-2"></i>จำนวน</th>
                                <th class="text-end" style="width:180px;"><i
                                        class="fa-solid fa-calculator pe-2"></i>รวมเป็นเงิน
                                </th>
                                <th class="text-center"><i class="fa-solid fa-user-group pe-2"></i>Supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($query_dt as $items)
                                <tr>
                                    <td class="f-14 text-center">{{ $loop->index + 1 }}</td>
                                    <td class="f-14 text-start">{{ $items->InvName }}</td>
                                    <td class="f-14 text-end">{{ number_format($items->Amount) ?? '0' }}</td>
                                    <td class="f-14 text-end">{{ number_format($items->TotalPrice, 2) ?? '0.00' }}</td>
                                    <td class="f-14 text-center">{{ $items->SupName }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="f-14 text-center">-</td>
                                    <td class="f-14 text-start">-</td>
                                    <td class="f-14 text-end">-</td>
                                    <td class="f-14 text-end">-</td>
                                    <td class="f-14 text-center">-</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
        @if ($permiss->check && $check_approve->idPsCheck == null)
        @elseif($permiss->accept && $check_approve->idPsAccept == null)

        @elseif($permiss->confirm_1 && $check_approve->idPsConfirm == null && $check_approve->idPsCancel == null)
            <div class="d-block d-lg-none fixed-bottom">
                <div class="row card-btn-approve m-0" style="justify-content: space-evenly;">
                    <button type="button" class="col-6 btn btn-not-approve-fixed" data-bs-toggle="modal"
                        data-bs-target="#show-modal-not-approve-1">แก้ไข</button>
                    <button type="button" class="col-6 btn btn-approve-fixed" data-bs-toggle="modal"
                        data-bs-target="#show-modal-approve-1">อนุมัติ</button>
                </div>
            </div>
        @elseif($permiss->confirm_2 && $check_approve->idPsConfirm2 == null && $check_approve->idPsCancel == null)
            <div class="d-block d-lg-none fixed-bottom">
                <div class="row card-btn-approve m-0" style="justify-content: space-evenly;">
                    <button type="button" class="col-6 btn btn-not-approve-fixed" data-bs-toggle="modal"
                        data-bs-target="#show-modal-not-approve-2">แก้ไข</button>
                    <button type="button" class="col-6 btn btn-approve-fixed" data-bs-toggle="modal"
                        data-bs-target="#show-modal-approve-2">อนุมัติ</button>
                </div>
            </div>
        @endif
        {{-- <div class="d-block d-lg-none fixed-bottom">
            <div class="row card-btn-approve m-0" style="justify-content: space-evenly;">
                <button type="button" class="col-6 btn btn-not-approve-fixed" data-bs-toggle="modal"
                    data-bs-target="#show-modal-not-approve-1">ยกเลิก</button>
                <button type="button" class="col-6 btn btn-approve-fixed" data-bs-toggle="modal"
                    data-bs-target="#show-modal-approve-1">อนุมัติ</button>
            </div>
        </div> --}}

    </div>
    <div class="modal fade" id="show-modal-check" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: unset">
                <div class="modal-header border-0">
                    <div class="text-start mb-1">
                        <img class="pe-2" src="{{ asset('project/stamp.png') }}" height="32px">
                        <h6 class="text-b d-inline">ตรวจสอบโครงการ</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="f-15 m-0 color-gray">โครงการ :
                            <span class="f-15 text-dark"> {{ $query_mt->ProjectName ?? '-' }}</span>
                        </p>
                        <p class="f-14 color-gray">บริษัท :
                            <span class="f-14 text-dark"> {{ $query_mt->CompName ?? '-' }}</span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn w-100" style="background-color:#5587dc;color:#fff;"
                        onclick="checkProject('check')">
                        ยืนยันการตรวจสอบโครงการ
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="show-modal-accept" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: unset">
                <div class="modal-header border-0">
                    <div class="text-start mb-1">
                        <img class="pe-2" src="{{ asset('project/stamp.png') }}" height="32px">
                        <h6 class="text-b d-inline">รับทราบโครงการ</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="f-15 m-0 color-gray">โครงการ :
                            <span class="f-15 text-dark"> {{ $query_mt->ProjectName ?? '-' }}</span>
                        </p>
                        <p class="f-14 color-gray">บริษัท :
                            <span class="f-14 text-dark"> {{ $query_mt->CompName ?? '-' }}</span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn w-100" style="background-color:#5587dc;color:#fff;"
                        onclick="checkProject('accept')">
                        ยืนยันการรับทราบโครงการ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show-modal-not-approve-1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: unset">
                <div class="modal-header border-0">
                    <div class="text-start mb-1 ">
                        <img class="pe-2" src="{{ asset('project/stamp-2.png') }}" height="32px">
                        <h6 class="d-inline text-b">ไม่อนุมัติโครงการ</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <p class="f-15 m-0">{{ $query_mt->ProjectName }}</p> --}}
                    <p class="f-15 m-0 color-gray">โครงการ :
                        <span class="f-15 text-dark"> {{ $query_mt->ProjectName ?? '-' }}</span>
                    </p>
                    <p class="f-14 color-gray">บริษัท :
                        <span class="f-14 text-dark"> {{ $query_mt->CompName ?? '-' }}</span>
                    </p>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="noteSelect">รวมหมายเหตุทั้งหมด</label>
                            <select class="form-control form-select" id="noteSelect" style="font-size:14px;">
                                <option value="note_user">กำหนดเอง</option>
                                @forelse ($note_reject as $item)
                                    <option value="{{ $item->note }}">{{ $item->note }}</option>
                                @empty
                                    <option value="" disabled>ไม่มีหมายเหตุ</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 f-15 color-gray">
                        <label class=" f-14 mb-1" for="note_project">หมายเหตุ(โปรดระบุ)</label>
                        <textarea class="form-control f-14" id="note_project_1" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 row" style="justify-content: space-evenly;">
                    <button type="button" class="btn col-5 btn-not-approve-fixed-modal-update disabled"
                        style="color:#fff;" id="btnnotconfirm1" onclick="notConfirm('1')">
                        แก้ไข
                    </button>
                    <button type="button" class="btn col-5 btn-not-approve-fixed-modal" style="color:#fff;"
                        id="cancel" onclick="cancel()">
                        ยกเลิก
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="show-modal-approve-1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: unset">
                <div class="modal-header border-0">
                    <div class="text-start mb-1">
                        <img class="pe-2" src="{{ asset('project/stamp.png') }}" height="32px">
                        <h6 class="text-b d-inline">อนุมัติโครงการ</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="f-15 m-0 color-gray">โครงการ :
                            <span class="f-15 text-dark"> {{ $query_mt->ProjectName ?? '-' }}</span>
                        </p>
                        <p class="f-14 color-gray">บริษัท :
                            <span class="f-14 text-dark"> {{ $query_mt->CompName ?? '-' }}</span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn w-100" style="background-color:#5587dc;color:#fff;"
                        onclick="checkProject('confirm_1')">
                        ยืนยันการอนุมัติโครงการ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show-modal-not-approve-2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: unset">
                <div class="modal-header border-0">
                    <div class="text-start mb-1 ">
                        <img class="pe-2" src="{{ asset('project/stamp-2.png') }}" height="32px">
                        <h6 class="d-inline text-b">ไม่อนุมัติโครงการ</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <p class="f-15 m-0">{{ $query_mt->ProjectName }}</p> --}}
                    <p class="f-15 m-0 color-gray">โครงการ :
                        <span class="f-15 text-dark"> {{ $query_mt->ProjectName ?? '-' }}</span>
                    </p>
                    <p class="f-14 color-gray">บริษัท :
                        <span class="f-14 text-dark"> {{ $query_mt->CompName ?? '-' }}</span>
                    </p>

                    <div class="mb-3 f-15 color-gray">
                        <label class=" f-14 mb-1" for="note_project">หมายเหตุ(โปรดระบุ)</label>
                        <textarea class="form-control f-14" id="note_project_2" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn w-100 btn-not-approve-fixed-modal disabled" style="color:#fff;"
                        id="btnnotconfirm2" onclick="notConfirm('2')">
                        ยืนยันการไม่อนุมัติโครงการ
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="show-modal-approve-2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: unset">
                <div class="modal-header border-0">
                    <div class="text-start mb-1">
                        <img class="pe-2" src="{{ asset('project/stamp.png') }}" height="32px">
                        <h6 class="text-b d-inline">อนุมัติโครงการ</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="f-15 m-0 color-gray">โครงการ :
                            <span class="f-15 text-dark"> {{ $query_mt->ProjectName ?? '-' }}</span>
                        </p>
                        <p class="f-14 color-gray">บริษัท :
                            <span class="f-14 text-dark"> {{ $query_mt->CompName ?? '-' }}</span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn w-100" style="background-color:#5587dc;color:#fff;"
                        onclick="checkProject('confirm_2')">
                        ยืนยันการอนุมัติโครงการ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show-file-project" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border: unset">
                <div class="modal-header border-0">
                    <div class="text-start mb-1">
                        <img class="pe-2" src="{{ asset('project/copy.png') }}" height="32px">
                        <h6 class="text-b d-inline">เอกสารประกอบโครงการ</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const noteSelect = document.getElementById("noteSelect");
            const textarea = document.getElementById("note_project_1");

            noteSelect.addEventListener("change", function() {
                console.log(noteSelect.value);
                if (noteSelect.value === "note_user") {
                    console.log("กำหนดเอง");
                    textarea.readOnly = false;
                    textarea.value = "";
                } else {
                    console.log("เลือก");
                    textarea.readOnly = true;
                    textarea.value = noteSelect.options[noteSelect.selectedIndex].text;
                }

                if ($('#note_project_1').val().trim() === '') {
                    $('#btnnotconfirm1').addClass('disabled');
                } else {
                    $('#btnnotconfirm1').removeClass('disabled');
                }
            });
        });


        $(document).ready(function() {
            const textInput = $('#note_project_1');
            const submitButton = $('#btnnotconfirm1');
            const textInput2 = $('#note_project_2');
            const submitButton2 = $('#btnnotconfirm2');

            textInput.on('input', function() {
                if (textInput.val().trim() === '') {
                    console.log("Input is empty");
                    submitButton.addClass('disabled');
                } else {
                    console.log("Input is not empty");
                    submitButton.removeClass('disabled');
                }
            });

            textInput2.on('input', function() {
                if (textInput2.val().trim() === '') {
                    console.log("Input is empty");
                    submitButton2.addClass('disabled');
                } else {
                    console.log("Input is not empty");
                    submitButton2.removeClass('disabled');
                }
            });

        });

        function checkProject(permiss) {
            $('#show-modal-check').modal('hide');
            $('#show-modal-accept').modal('hide');
            $('#show-modal-approve-1').modal('hide');
            $('#show-modal-approve-2').modal('hide');
            $('#show-modal-loading').modal('show');

            $.ajax({
                url: '/project/items/' + {{ $query_mt->idProject }},
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    permiss: permiss
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == true) {
                        Swal.fire({
                            title: "สำเร็จ!",
                            text: response.message,
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        console.log(response);
                    }

                }
            });
        }

        function notConfirm(notConfirm) {
            $('#show-modal-not-approve-1').modal('hide');
            $('#show-modal-not-approve-2').modal('hide');
            $('#show-modal-loading').modal('show');

            if (notConfirm === '1') {
                var note_status = 'Note_Reject';
                var note = document.getElementById('note_project_1').value;

            }
            if (notConfirm === '2') {
                var note_status = 'Note_Reject2';
                var note = document.getElementById('note_project_2').value;
            }

            $.ajax({
                url: '/project/reject/' + {{ $query_mt->idProject }},
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    note_status: note_status,
                    note: note
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == true) {
                        Swal.fire({
                            title: "สำเร็จ!",
                            text: response.message,
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        console.log(response, "tets");
                    }

                }
            });

        }

        function cancel() {
            $.ajax({
                url: '/project/cancel/' + {{ $query_mt->idProject }},
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == true) {
                        Swal.fire({
                            title: "สำเร็จ!",
                            text: response.message,
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        console.log(response, "tets");
                    }
                }
            });
            console.log("cancel");
            // $('#show-modal-not-approve-1').modal('hide');
        }
    </script>
@endpush
