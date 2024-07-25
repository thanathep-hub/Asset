@extends('app.app')
@section('title', 'สินทรัพย์')
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
                <input type="text" class="form-control form-input border-0" placeholder="ค้นหารายการสินทรัพย์..."
                    id="searchAsset" onchange="searchAsset()">
            </div>
        </div>
    </div>
    {{-- <div class="border-bottom mb-3" style="border-bottom: 2px solid #87b4ff2e;"></div> --}}
    <div class=" search-bar row d-flex justify-content-center align-items-center" style="padding-right: .75rem;">
        <div class="col-md-6">
            <div class="count-search" style="text-align: end;height:24px;">
                <span style="color: #3759be;">จำนวน <span id="amountResult"></span> รายการ</span>
            </div>
        </div>
    </div>


    <div class="row justify-content-center align-items-center" id="showResult">
        <div class="col-12 col-md-6">
            <div class="card justify-content-center mb-3" style="height: 100px;">
                <div class="row m-0">
                    <div class="col-3" style="text-align: center;">
                        <img src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/+items.idAsset+_1.png"
                            onerror="this.src = '{{ asset('project/no-photo.png') }}';" alt="" height="60px">
                    </div>
                    <div class="col-9" style="align-content: center;">
                        <h6 style="font-size: 16px;"> +items.AssetName+
                        </h6>
                        <span class="text-gray" style="font-size: 14px;">จำนวน +items.AssAmount+ </span>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card justify-content-center mb-3" style="height: 100px;">
                <div class="row m-0">
                    <div class="col-3" style="text-align: center;">
                        <img src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/+items.idAsset+_1.png"
                            onerror="this.src = '{{ asset('project/no-photo.png') }}';" alt="" height="60px">
                    </div>
                    <div class="col-9" style="align-content: center;">
                        <h6 style="font-size: 16px;"> +items.AssetName+
                        </h6>
                        {{-- <span class="text-gray" style="font-size: 14px;">จำนวน </span> --}}
                    </div>
                </div>

            </div>
        </div>


    </div>




@endsection
@push('script')
    <script>
        function searchAsset() {
            var textInput = document.getElementById("searchAsset").value;

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/assets/search/text_query",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                data: {
                    textInput: textInput
                },
                success: function(data) {
                    console.log(data.length);
                    document.getElementById("amountResult").innerText = data.length;

                    $('#showResult').empty();

                    $.each(data, function(index, items) {
                        $('#showResult').append(`
                            <div class="col-12 col-md-6">
                                <div class="card justify-content-center mb-3" style="height: 100px;">
                                    <div class="row m-0">
                                        <div class="col-3" style="text-align: center;align-content: center;">
                                            <img src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/${items.idAsset}_1.jpg"
                                                onerror="this.src = '{{ asset('project/no-photo.png') }}';" alt="" height="60px">
                                        </div>
                                        <div class="col-9" style="align-content: center;">
                                            <h6 style="font-size: 16px;">${items.AssetName}</h6>
                                            <span class="text-gray" style="font-size: 14px;">จำนวน ${items.AssAmount}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `);
                    });

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
    </script>
@endpush
