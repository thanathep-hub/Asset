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
            /* background-color: #1c64eb; */
            /* color: white; */
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
                <div class="col-lg-4" id="asset">
                    <div id="menu-card" class="menu-card justify-content-between small-box p-2" style="border-radius: 18px;">
                        <div class="inner">
                            <div id="date_po">
                                <label><i class="fa-regular fa-building"></i> แผนก • QQ</label>
                            </div>
                            <p class="m-0 mb-3" style="font-weight: 900;
                            font-size: 18px;">
                                ไร่ในกรีนซีดส์และไร่นอกริมคลอง(ทดสอบ)
                            </p>
                            <div class="row mb-3">
                                <div class="px-1">
                                    <div style="background-color: #808080;width:32px;height:12px;"></div>
                                </div>
                                <div class="px-1">
                                    <div style="background-color: #0f9402;width:32px;height:12px;"></div>
                                </div>
                                <div class="px-1">
                                    <div style="background-color: #808080;width:32px;height:12px;"></div>
                                </div>
                                <div class="px-1">
                                    <div style="background-color: #808080;width:32px;height:12px;"></div>
                                </div>
                            </div>
                            <div id="date_po" style="text-align-last: justify;">
                                <label class="text-start m-0"><i class="fa-solid fa-clock-rotate-left"></i>
                                    06-06-2567</label>
                                <label class="text-end m-0" style="font-size: 20px;color:#025ab9;">฿18,489.00</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- orther items --}}

            </div>

        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            //

        });
    </script>
@endpush
