@extends('project.project-layout')
@section('title', 'โครงการ')
@push('style')
    <style>
        .card {
            --bs-card-border-color: #00000009;
        }

        .card-approve {
            background-color: #f6f5fa;
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
            background-color: #808080;
            border-radius: 8px;
            color: #fff;
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

        /*  */
    </style>
@endpush
@section('content')
    <div class="project-card card mt-4 mb-4 bg-white accent-blue">
        <div class="row m-2 mt-4">
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
                        <p class="f-14 m-0 color-gray d-inline">กลุ่มโครงการรอง :
                        <p class="f-14 m-0 d-inline ">{{ $query_mt->PjGroupMainName ?? '-' }}</p>
                        </p>
                        <p class="f-14 m-0 color-gray d-inline">กลุ่มโครงการหลัก :
                        <p class="f-14 m-0 d-inline">{{ $query_mt->PjGroupSubName ?? '-' }}</p>
                        </p>
                        <div class="border-bm mb-3"></div>
                        <p class="text-b f-15">ระยะเวลาโครงการ <img class="ps-1"
                                src="{{ asset('project/timetable.png') }}" height="24px;"></p>
                        <p class="f-14 color-gray d-inline">
                            วันที่เริ่ม:
                        <p class="d-inline ">
                            {{ \Carbon\Carbon::parse($query_mt->cDateStart)->locale('th')->addYears(543)->translatedFormat('d F Y') ?? '-' }}
                        </p>

                        </p>
                        <p class="f-14 color-gray d-inline">
                            วันที่คาดว่าจะสิ้นสุด:
                        <p class="d-inline">
                            {{ \Carbon\Carbon::parse($query_mt->cDateEnd)->locale('th')->addYears(543)->translatedFormat('d F Y') ?? '-' }}
                        </p>

                        </p>
                        <div class="border-bm mb-3"></div>
                        <p class="f-14 m-0 color-gray d-inline">จังหวัดของโครงการ :
                        <p class="f-14 d-inline "> {{ $query_mt->ProvinceName ?? '-' }}</p>
                        </p>
                        <p class="f-14 m-0 color-gray d-inline">อำเภอของของโครงการ :
                        <p class="f-14 d-inline "> {{ $query_mt->ApName ?? '-' }}</p>
                        </p>
                        <p class="f-14 m-0 color-gray d-inline">รายละเอียด :
                        <p class="f-14 d-inline "> {{ $query_mt->Note ?? '-' }}</p>
                        </p>
                        <p class="f-14 m-0 color-gray d-inline align-items-center"><img class="pe-2"
                                src="{{ asset('project/accounting.png') }}" height="24px"> งบประมาณ :
                        <p class="f-14 d-inline "> {{ number_format($query_mt->Budget, 2) ?? '-' }} บาท</p>
                        </p>
                        <div class="border-bm mb-3 d-lg-none"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 card-approve d-none d-lg-block"> {{-- d-lg-none --}}
                <div class="text-start pt-3 mb-1 ">
                    <img src="{{ asset('project/quality-control-ap.png') }}" height="32px">
                    <label class="f-15 text-b">อนุมัติโครงการ</label>
                </div>
                <div class="border-b mb-3 mt-3" style="border: 1px solid #86b7fe"></div>
                <div class="mb-3 f-15 color-gray">
                    <label for="note_project f-14">หมายเหตุ(โปรดระบุ)</label>
                    <textarea class="form-control f-14" id="note_project" rows="3" {{-- placeholder="เหตุผล : ในการอนุมัติ / ไม่อนุมัติ" --}}></textarea>
                </div>
                <div class="row mt-4 m-1">
                    <button type="button" class="col-12 btn btn-approve mb-2">อนุมัติ</button>
                    <button type="button" class="col-12 btn btn-not-approve">ยกเลิก</button>
                </div>
            </div>

            <div class="col-12 d-block d-lg-none">
                <div class="row" style="justify-content: center;">
                    <button type="button" class="col-5 btn btn-not-approve mb-2 me-2">ยกเลิก</button>
                    <button type="button" class="col-5 btn btn-approve mb-2">อนุมัติ</button>
                </div>
            </div>

            <div class="border-bm mb-3 d-none d-lg-block"></div>
            @if (count($query_dt) > 0)
                <div class="lis-material d-none d-lg-block">
                    <h6>รายการวัสดุ</h6>
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


    </div>

@endsection
@push('script')
@endpush
