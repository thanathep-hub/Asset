@extends('layouts.master')
@section('title', 'Home')
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

            <!-- Small Box (Stat card) -->
            <div class="row pt-4">
                <!-- ./col -->
                {{-- <div class="col-lg-3">
                    <div class="small-box" id="vam"
                        style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);background-color: #158cba;
                    color: #fff;">
                        <div class="inner">
                            <h3>VAM<sup style="font-size: 20px"></sup></h3>

                            <p>{{ $QVam->CarTotal }} รายการ</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <a href="/vam_menu" class="small-box-footer">
                            ดูข้อมูล <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="small-box" id="asset"
                        style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);background: #7c5108 linear-gradient(180deg,#e8b867e3,#ba9352) repeat-x!important;color: #fff;">
                        <div class="inner">
                            <h3>ASSET</h3>

                            <p>-- รายการ</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <a href="/asset_menu" class="small-box-footer">
                            ดูข้อมูล <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div> --}}

                <div class="col-lg-3 " id="asset">
                    <div id="menu-card" class="menu-card d-flex justify-content-between small-box p-2"
                        style="border-radius: 18px;">
                        <div class="inner">
                            <p class="m-0" style="font-weight: 900;
                            font-size: 27px;">ASSET
                            </p>
                            <p class="m-0 detail-card" style="font-weight: 900;font-size: small;">ไปยังรายการ ASSET</p>
                        </div>
                        <div class="">
                            <img src="{{ asset('imges/asset-menu1.png') }}" alt="" height="84">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 " id="land"
                @if (session('idPositions') != 15) hidden @endif
                >
                    <div id="menu-card" class="menu-card d-flex justify-content-between small-box p-2"
                        style="border-radius: 18px;">
                        <div class="inner">
                            <p class="m-0" style="font-weight: 900;
                            font-size: 27px;">ที่ดิน
                            </p>
                            <p class="m-0 detail-card" style="font-weight: 900;font-size: small;">ไปยัง Asset ประเภทที่ดิน </p>
                        </div>
                        <div class="">
                            <img src="{{ asset('imges/land-green.png') }}" alt="" height="84" style="">
                        </div>
                    </div>
                </div>

                {{-- <div class="col-lg-3 " id="vam">
                    <div id="menu-card" class="menu-card d-flex justify-content-between small-box p-2"
                        style="border-radius: 18px;">
                        <div class="inner">
                            <p class="m-0" style="font-weight: 900;
                            font-size: 27px;">VAM
                            </p>
                            <p class="m-0 detail-card" style="font-weight: 900;font-size: small;">ยานพาหนะต่างๆ</p>
                        </div>
                        <div class="">
                            <img src="{{ asset('imges/vehicles.png') }}" alt="" height="84">
                        </div>
                    </div>
                </div> --}}

                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div>
    </section>

    {{-- modal asset  --}}

    {{-- <div class="modal fade" id="assetItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="card" style="width: 10rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h2>Bill</h2>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            $('#vam').on('click', function() {
                window.location.href = "/vam_menu";
            });
            $('#asset').on('click', function() {
                // $('#assetItemModal').modal('show');
                window.location.href = "/asset_menu";
            });

        });
    </script>
@endpush
