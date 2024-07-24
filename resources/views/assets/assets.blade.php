@extends('app.app')
@section('title', 'โครงการ')
@push('style')
    <style>
        .content {
            background-image: linear-gradient(to right, #effbfc, #d5d7e48a)
                /* background-image: linear-gradient(to right, #d2e9ee, #d5d7e4); */
        }

        body {

            background: #d1d5db;
        }

        .height {

            height: 100vh;
        }

        .form {
            position: relative;
        }

        .form .fa-search {

            position: absolute;
            top: 20px;
            left: 20px;
            color: #9ca3af;

        }

        .form span {

            position: absolute;
            right: 17px;
            top: 13px;
            padding: 2px;
            border-left: 1px solid #d1d5db;

        }

        .left-pan {
            padding-left: 7px;
        }

        .left-pan i {

            padding-left: 10px;
        }

        .form-input {

            height: 48px;
            text-indent: 33px;
            border-radius: 28px;
        }

        .form-input:focus {

            box-shadow: none;
            border: none;
        }

        /*  */

        .card {
            --bs-card-border-color: none;
            border-radius: 12px;
        }
    </style>
@endpush
@section('content')
    <div class="mt-4 mb-3 search-bar row d-flex justify-content-center align-items-center">
        <div class="col-md-6">

            <div class="form">
                <i class="fa fa-search"></i>
                <input type="text" class="form-control form-input border-0" placeholder="ค้นหารายการสินทรัพย์...">
            </div>
        </div>
    </div>

    <div class=" search-bar row d-flex justify-content-center align-items-center" style="padding-right: .75rem;">
        <div class="col-md-6">
            <div class="count-search" style="text-align: end;height:24px;">
                <span style="color: #3759be;">จำนวน 6 รายการ</span>
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-6 ">
            <div class="card justify-content-center" style="height: 100px;">
                <div class="row m-0">
                    <div class="col-3" style="">
                        <img src="{{ asset('project/asset.png') }}" alt="" height="60px">
                    </div>
                    <div class="col-9" style="align-content: center;">
                        <label style="font-size: 16px;">เตาอบ แก๊ส LK ใช้แก๊สเป็นเชื้อเพลิง - -</label>
                        <span class="text-gray">1 เครื่อง</span>
                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection
@push('script')
    <script></script>
@endpush
