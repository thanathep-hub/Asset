@extends('layouts.master')
@section('title', 'ASSET')
@push('css')
    <style>
        .small-box:hover {
            /* filter: brightness(50%); */
            cursor: pointer;
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
                <div class="col-lg-3 " id="asset">
                    <div id="menu-card" class="menu-card d-flex justify-content-between small-box p-2"
                        style="border-radius: 18px;">
                        <div class="inner">
                            <p class="m-0" style="font-weight: 900;
                            font-size: 27px;">ASSET
                            </p>
                            <p class="m-0 detail-card" style="font-weight: 900;font-size: small;">รายการสินทรัพย์ต่างๆ</p>
                        </div>
                        <div class="">
                            <img src="{{ asset('imges/tasks.png') }}" alt="" height="84">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 " id="asset_bill_repair" @if (session('idPositions') != 15) hidden @endif>
                    <div id="menu-card" class="menu-card d-flex justify-content-between small-box p-2"
                        style="border-radius: 18px;">
                        <div class="inner">
                            <p class="m-0" style="font-weight: 900;
                            font-size: 27px;">บิลซ่อม
                            </p>
                            <p class="m-0 detail-card" style="font-weight: 900;font-size: small;">รายการบิลซ่อม</p>
                        </div>
                        <div class="">
                            <img src="{{ asset('imges/bill.png') }}" alt="" height="84">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 " id="asset_graph" @if (session('idPositions') != 15) hidden @endif>
                    <div id="menu-card" class="menu-card d-flex justify-content-between small-box p-2"
                        style="border-radius: 18px;">
                        <div class="inner">
                            <p class="m-0" style="font-weight: 900;
                            font-size: 27px;">Graph
                            </p>
                            <p class="m-0 detail-card" style="font-weight: 900;font-size: small;">ข้อมูล asset ในรูปแบบกราฟ
                            </p>
                        </div>
                        <div class="">
                            <img src="{{ asset('imges/bar-chart.png') }}" alt="" height="84">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 " id="asset_land" @if (session('idPositions') != 15) hidden @endif>
                    <div id="menu-card" class="menu-card d-flex justify-content-between small-box p-2"
                        style="border-radius: 18px;">
                        <div class="inner">
                            <p class="m-0" style="font-weight: 900;
                            font-size: 27px;">ที่ดิน
                            </p>
                            <p class="m-0 detail-card" style="font-weight: 900;font-size: small;">ไปยัง Asset ประเภทที่ดิน
                            </p>
                        </div>
                        <div class="">
                            <img src="{{ asset('imges/land-green.png') }}" alt="" height="84" style="">
                        </div>
                    </div>
                </div>

                {{-- <div class="col-lg-3">
                    <div class="small-box" id="asset"
                        style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);background: #208383 linear-gradient(180deg,#2ebebd,#2ebebd) repeat-x!important;color: #fff;">
                        <div class="inner">
                            <h3>ASSET</h3>
                            <p>-</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <a href="/asset" class="small-box-footer">
                            ดูข้อมูล <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="small-box" id="asset_bill_repair"
                        style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);background: #fcbf18 linear-gradient(180deg,#f8ce5c,#f8ce5c) repeat-x!important;color: #fff;">
                        <div class="inner">
                            <h3>บิลซ่อม</h3>
                            <p>-</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tollbox"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" height="78.75" width="88" viewBox="0 0 448 512">
                                <path fill="#00000026"
                                    d="M176 88v40H336V88c0-4.4-3.6-8-8-8H184c-4.4 0-8 3.6-8 8zm-48 40V88c0-30.9 25.1-56 56-56H328c30.9 0 56 25.1 56 56v40h28.1c12.7 0 24.9 5.1 33.9 14.1l51.9 51.9c9 9 14.1 21.2 14.1 33.9V304H384V288c0-17.7-14.3-32-32-32s-32 14.3-32 32v16H192V288c0-17.7-14.3-32-32-32s-32 14.3-32 32v16H0V227.9c0-12.7 5.1-24.9 14.1-33.9l51.9-51.9c9-9 21.2-14.1 33.9-14.1H128zM0 416V336H128v16c0 17.7 14.3 32 32 32s32-14.3 32-32V336H320v16c0 17.7 14.3 32 32 32s32-14.3 32-32V336H512v80c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64z" />
                            </svg>
                        </div>
                        <a href="/asset_bill_repair" class="small-box-footer">
                            ดูข้อมูล <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="small-box" id="asset_graph"
                        style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);background-color: #158cba;
                    color: #fff;">
                        <div class="inner">
                            <h3>กราฟข้อมูล<sup style="font-size: 20px"></sup></h3>
                            <p>-</p>
                        </div>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="78.75" width="70" viewBox="0 0 448 512">
                                <path fill="#00000026"
                                    d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm64 192c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm64-64c0-17.7 14.3-32 32-32s32 14.3 32 32V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V160zM320 288c17.7 0 32 14.3 32 32v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V320c0-17.7 14.3-32 32-32z" />
                            </svg>
                        </div>
                        <a href="/asset_graph" class="small-box-footer">
                            ดูข้อมูล <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div> --}}

            </div>

        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('#asset_graph').on('click', function() {
                window.location.href = "/asset_graph";
            });

            $('#asset_bill_repair').on('click', function() {
                window.location.href = "/asset_bill_repair";
            });

            $('#asset').on('click', function() {
                window.location.href = "/asset";
            });

            $('#asset_land').on('click', function() {
                window.location.href = '/asset_land';
            });

        });
    </script>
@endpush
