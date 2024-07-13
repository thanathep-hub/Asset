@extends('project.project-layout')
@section('title', 'โครงการ')
@push('style')
    <style>
        .card {
            --bs-card-border-color: #00000009;
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

        .color-gray {
            color: gray;
        }

        .text-b {
            font: bold;
        }
    </style>
@endpush
@section('content')
    <div class="project-card mt-4 p-2">
        <div class="p-2">
            <div class="project-title d-flex">
                <div class="logo-company pe-4">
                    <img src="https://seedsgroup.dyndns.org/spm/Center/Logo/3.jpg" style="width:60px;">
                </div>
                <div class="tital-project">
                    <h6>โครงการสร้างแผงกันน้ำเซาะข้างโรงงานฝั่งริมห้วยด้านหลังโรงโสหุ้ย</h6>
                    <p class="p-0 m-0" style="color: gray;">รหัสโครงการ : GR66088</p>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="project-detail m-4">
                <p class="m-0 color-gray">รหัสโครงการ : GR66088</p>
                <h6>โครงการสร้างแผงกันน้ำเซาะข้างโรงงานฝั่งริมห้วยด้านหลังโรงโสหุ้ย</h6>
                <p class="f-14 color-gray">กลุ่มโครงการรอง : โครงการก่อสร้างต่างๆ</p>
                <p class="f-14 color-gray">กลุ่มโครงการหลัก : โครงการก่อสร้างแผงกันน้ำเซาะ </p>
                <div class="border-bottom mb-3"></div>
                <p class="text-b">ระยะเวลาโครงการ</p>
                <p class="text-b color-gray">วันที่เริ่ม : </p>
                <p class="text-b color-gray">วันที่คาดว่าจะสิ้นสุด : </p>
                <div class="border-bottom mb-3"></div>
                <p class="text-b color-gray">จังหวัดของโครงการ : </p>
                <p class="text-b color-gray">อำเภอของของโครงการ : </p>
                <p class="text-b color-gray">รายละเอียด : </p>
                <p class="text-b color-gray">งบประมาณ : </p>
            </div>
        </div>

    </div>
    </div>

@endsection
@push('script')
@endpush
