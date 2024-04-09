@extends('layouts.master')
@section('title', 'Home')
@push('css')
@endpush
@section('content')
    <section class="content">
        <div class="container-fluid">

            <!-- Small Box (Stat card) -->
            <div class="row pt-4">
                <!-- ./col -->
                <div class="col-lg-3">
                    <!-- small card -->
                    <div class="small-box bg-gradient-success" style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            ดูข้อมูล <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3">
                    <!-- small card -->
                    <div class="small-box bg-gradient-info" style="box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);">
                        <div class="inner">
                            <h3>65</h3>

                            <p>สินทรัพย์</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            ดูข้อมูล <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
