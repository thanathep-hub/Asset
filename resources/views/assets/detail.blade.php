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

        /*  */

        .card {
            --bs-card-border-color: none;
            border-radius: 12px;
        }

        .asset-box-img {
            width: 150px;
            height: 150px;
        }

        .asset-img {
            /* box-shadow: 0 0 .875rem 0 rgba(34, 46, 60, .05); */
        }
    </style>
@endpush
@section('content')
    <div class="mt-4 mb-3 search-bar row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card p-4 align-items-center">
                <div class="asset-box-img">
                    <img class="asset-img" src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/10163_1.jpg"
                        style="width: 100%;">
                </div>


            </div>
        </div>
    </div>




@endsection
@push('script')
    <script></script>
@endpush
