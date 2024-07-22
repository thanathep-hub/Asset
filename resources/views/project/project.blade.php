@extends('app.app')
@section('title', 'โครงการ')
@push('style')
    <style>
        .card-list-card {
            box-shadow: 0 .25rem .5rem 0 rgb(34 46 60 / 12%);
        }
    </style>
@endpush
@section('content')
    <div class="list-card mt-4">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <div class="icon card-list-card m-2 p-1 border-0" style="width:40px;">
                            <img src="{{ asset('project/growth.png') }}" alt="" width="32px;">
                        </div>
                        <div class="title-list-item align-items-center">
                            <label class="kanit-bold" style="color: #6d6d6d;">โครงการทั้งหมด</label>
                            <p class="kanit-semibold p-0 m-0">1000</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <div class="icon card-list-card m-2 p-1 border-0" style="width:40px;">
                            <img src="{{ asset('project/stamp.png') }}" alt="" width="32px;">
                        </div>
                        <div class="title-list-item align-items-center">
                            <label class="kanit-bold" style="color: #6d6d6d;">ได้รับการอนุมัติ</label>
                            <p class="kanit-semibold p-0 m-0">375ss</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <div class="icon card-list-card m-2 p-1 border-0" style="width:40px;">
                            <img src="{{ asset('project/solution.png') }}" alt="" width="32px;">
                        </div>
                        <div class="title-list-item align-items-center">
                            <label class="kanit-bold" style="color: #6d6d6d;">รอการแก้ไข</label>
                            <p class="kanit-semibold p-0 m-0">55</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <div class="icon card-list-card m-2 p-1 border-0" style="width:40px;">
                            <img src="{{ asset('project/growth.png') }}" alt="" width="32px;">
                        </div>
                        <div class="title-list-item align-items-center">
                            <label class="kanit-bold" style="color: #6d6d6d;">รอการอนุมัติ</label>
                            <p class="kanit-semibold p-0 m-0">ภจ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
