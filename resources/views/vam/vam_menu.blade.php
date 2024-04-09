@extends('layouts.master')
@section('title', 'VAM')
@push('css')
    <style>
        .small-box:hover {
            /* filter: brightness(50%); */
            cursor: pointer;
            text-align: unset;
        }
        .small-box {
            text-align: unset;
        }
        .menu-card {
            background-color: #ffffff;
        }

        .menu-card:hover {
            background-color: #1c64eb;
            color: white;
            font-weight: 900;

        }

        .detail-card {
            color: gray;
        }

        .menu-card:hover .detail-card {
            color: white;
        }
    </style>
@endpush
@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="row pt-4">

                {{-- <div class="col-lg-3">
                    <div class="small-box" id="vam"
                        style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);background-color: #158cba;
                    color: #fff;">
                        <div class="inner">
                            <h3>VAM<sup style="font-size: 20px"></sup></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <a href="/vam" class="small-box-footer">
                            ดูข้อมูล <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="small-box" id="bill_vam"
                        style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);background: #7c5108 linear-gradient(180deg,#e8b867e3,#ba9352) repeat-x!important;color: #fff;">
                        <div class="inner">
                            <h3>บิลต่างๆ</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            ดูข้อมูล <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="small-box" id="car_maintenance"
                        style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);background: #3caf85 linear-gradient(180deg,#3caf85,#3caf85) repeat-x!important;color: #fff;">
                        <div class="inner">
                            <h3>ซ่อมบำรุง</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tollbox"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" height="78.75" width="88" viewBox="0 0 448 512">
                                <path fill="#00000026"
                                    d="M176 88v40H336V88c0-4.4-3.6-8-8-8H184c-4.4 0-8 3.6-8 8zm-48 40V88c0-30.9 25.1-56 56-56H328c30.9 0 56 25.1 56 56v40h28.1c12.7 0 24.9 5.1 33.9 14.1l51.9 51.9c9 9 14.1 21.2 14.1 33.9V304H384V288c0-17.7-14.3-32-32-32s-32 14.3-32 32v16H192V288c0-17.7-14.3-32-32-32s-32 14.3-32 32v16H0V227.9c0-12.7 5.1-24.9 14.1-33.9l51.9-51.9c9-9 21.2-14.1 33.9-14.1H128zM0 416V336H128v16c0 17.7 14.3 32 32 32s32-14.3 32-32V336H320v16c0 17.7 14.3 32 32 32s32-14.3 32-32V336H512v80c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64z" />
                            </svg>
                        </div>
                        <a href="/vam/car_maintenance/list" class="small-box-footer">
                            ดูข้อมูล <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div> --}}

                <div class="col-lg-3 " id="vam">
                    <div id="menu-card" class="menu-card d-flex justify-content-between small-box p-2"
                        style="border-radius: 18px;">
                        <div class="inner">
                            <p class="m-0" style="font-weight: 900;
                            font-size: 27px;">VAM
                            </p>
                            <p class="m-0 detail-card" style="font-weight: 900;font-size: small;">รายการ VAM</p>
                        </div>
                        <div class="">
                            <img src="{{ asset('imges/vehicles.png') }}" alt="" height="84">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 " id="car_maintenance">
                    <div id="menu-card" class="menu-card d-flex justify-content-between small-box p-2"
                        style="border-radius: 18px;">
                        <div class="inner">
                            <p class="m-0" style="font-weight: 900;
                            font-size: 27px;">ซ่อมบำรุง
                            </p>
                            <p class="m-0 detail-card" style="font-weight: 900;font-size: small;">รายการซ่อมบำรุงต่างๆ</p>
                        </div>
                        <div class="">
                            <img src="{{ asset('imges/tools.png') }}" alt="" height="84" style="background-color: #3caf85;border-radius: 44px;">
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('#vam').on('click', function() {
                window.location.href = "/vam";
            });
            $('bill_vam').on('click', function() {
                window.location.href = "#";
            });
            $('#car_maintenance').on('click', function() {
                window.location.href = "/vam/car_maintenance/list";
            });

        });
    </script>
@endpush
