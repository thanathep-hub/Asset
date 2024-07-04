@extends('layouts.master')
@section('title', 'Asset')
@push('css')
    <style>
        .bill-code {
            position: fixed;
            bottom: 22px;
            right: 22px;
            color: white;
            /* background-color: #34aae7; */
            /* background-color: #008cba; */
            border-radius: 8px;
        }

        .bill-code-image {
            position: fixed;
            bottom: 138px;
            right: 22px;
            color: white;
            /* background-color: #34aae7; */
            /* background-color: #008cba; */
            border-radius: 8px;
        }

        .qr-code {
            position: fixed;
            bottom: 80px;
            right: 22px;
            color: white;
            /* background-color: #34aae7; */
            /* background-color: #008cba; */
            border-radius: 8px;
        }

        .button1 {
            /* background-color: #006b4f; */
            color: white;
        }

        .button:hover {
            /* background-color: #006b4f; */
            /* Green */
            color: white;
        }

        .preview-area {
            display: flex;
            flex-wrap: wrap;
            padding: 0.5rem;
        }

        .preview-area img {
            width: 24%;
            /* margin: 0 0 10px; */
            object-fit: contain;
        }

        .preview-area img:not(:nth-child(4n)) {
            margin-right: 1.333%;
        }

        .pic-asset {
            margin: 0.5rem;
            padding: 0.5rem;
            border: 1px solid rgb(195, 198, 209);
        }

        #pic-res {
            background-image: url(//www.somkiat.cc/wp-content/themes/accentbox/images/hbg.gif);
        }

        @media only screen and (max-width: 992px) {
            #pic-res {
                display: none;
            }
        }

        .modal-header {
            background-color: #353b40;
            color: white;
            border-top-left-radius: unset;
            border-top-right-radius: unset;
        }
    </style>
@endpush
@section('content')
    @include('sweetalert::alert')
    <section class="content" style="padding: 0rem;">
        <div class="container-fluid" style="padding-top: 1rem;">
            <div class="invoice p-3 mb-3 pt-3">
                <!-- title row -->
                <div class="row mb-1" style="border-bottom: 1px solid rgb(112 112 112 / 27%);">
                    <div class="col-12">
                        <h4>
                            @empty(!$asset_pic)
                                <img src="{{ asset('imges/approved.png') }}" alt="approved" height="44" width="44">
                            @else
                                <img src="{{ asset('imges/approved-remove.png') }}" alt="approved" height="44"
                                    width="44">
                            @endempty

                            <b class="pl-2">รายละเอียดสินทรัพย์</b>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-auto col-lg-10">
                        <div class="row invoice-info">

                            @php
                                $total = 0;
                                $totalSum = $asset_detail->Price;
                                $totalSumNet = 0;
                                $thSumNet = 0;

                                for ($i = 1; $i <= $asset_detail->YearAsset; $i++) {
                                    $total = (($totalSum - $total) * $asset_detail->AssPerc) / 100;
                                    $totalSumNet += $total;

                                    if ($i < $asset_detail->AssYearType) {
                                        $thSumNet += $total;
                                    }
                                }

                            @endphp

                            @php
                                $sum = 0;
                                $sumTotal = $asset_detail->Price;
                                $sumTotalNet = 0;
                                $sumThNet = 0;
                                $i = 1;
                            @endphp

                            @for ($i; $i <= $asset_detail->YearAsset; $i++)
                                @php
                                    $sum = (($sumTotal - $sum) * $asset_detail->AssPerc) / 100;
                                    $sumTotalNet += $sum;

                                    if ($i < $asset_detail->AssYearType) {
                                        $sumThNet += $sum;
                                    }
                                @endphp
                            @endfor

                            <div class=" col-lg-6 invoice-col border m-1" style="padding-top: 4px;"> {{-- col-sm-6 --}}
                                <b>รหัสสินทรัพย์ : </b> {{ $asset_detail->AssetCode ?? '-' }}<br>
                                <b>ชื่อสินทรัพย์ : </b> {{ $asset_detail->AssetName ?? '-' }}<br>
                                <b>บริษัท : </b> {{ $asset_detail->CompName ?? '-' }}<br>
                                <b>สถานะ : </b> {{ $asset_detail->statusUse ?? '-' }}<br>
                                <b>จำนวน : </b> {{ $asset_detail->AssAmount ?? '-' }}<br>
                                {{-- <b>ราคา : </b> {{ number_format($asset_detail->Price, 2) ?? '-' }} ฿<br> --}}
                                <b>อายุการใช้งานที่ตั้งไว้ : </b> {{ $asset_detail->AssYearType ?? '-' }}
                            </div>

                            <!-- Divider -->
                            <div class="col-lg-5 invoice-col border m-1" style="padding-top: 4px;">{{-- //col-sm-6 --}}
                                <b>ประเภท : </b> {{ $asset_detail->AssTypeName ?? '-' }}<br>
                                <b>กลุ่ม : </b> -<br>
                                <b>เลขทะเบียน : </b>-<br>
                                <b>สถานที่ : </b> {{ $asset_detail->PlaceName ?? '-' }}<br>
                                <b>ผู้จัดซื้อ : </b> {{ $detail_two->PsRp ?? '-' }}<br>
                                <b>Supplier : </b> {{ $detail_three->SupName ?? '-' }}
                                <br>
                                <b>หมายเหตุ : </b> {{ $asset_detail->Note ?? '-' }}
                            </div>

                            <div class=" col-lg-6 invoice-col border m-1" style="padding-top: 4px;">{{-- //col-sm-6 --}}
                                <b>สถานะประกัน : </b> {{ $asset_detail->stIns ?? '-' }} <br>
                                <b>วันที่เริ่มประกัน : </b> {{ $asset_detail->AssDateT ?? '-' }}<br>
                                <b>วันที่หมดประกัน : </b> {{ $asset_detail->AssDateTEnd ?? '-' }}<br>
                                <b>ระยะประกัน : </b> {{ $asset_detail->YearInsur ?? '-' }}
                            </div>

                            <div class=" col-lg-5 invoice-col border m-1" style="padding-top: 4px;">{{-- //col-sm-6 --}}

                                <b>วิธีคิดค่าเสื่อม : </b> คิดค่าเสื่อมต่อปี<br>
                                <b>วันที่ซื้อ : </b> {{ $asset_detail->AssDateT ?? '-' }}<br>
                                <b>วันที่เริ่มใช้ : </b> {{ $asset_detail->AssDateT ?? '-' }}<br>
                                <b>ราคาทุน : </b> {{ number_format($asset_detail->Price, 2) ?? '-' }}<br>
                                <b>อายุการใช้งาน : </b> {{ $asset_detail->YearAsset ?? '-' }}<br>
                                <b>ราคาซาก : </b> {{ number_format(0, 2) ?? '-' }}<br>
                                <b>อัตรา : </b>{{ $asset_detail->AssPerc ?? '-' }}%
                            </div>

                            <div class=" col-lg-6 invoice-col border m-1" style="padding-top: 4px;">{{-- //col-sm-6 --}}
                                <b>คิดค่าเสื่อม : </b> รายปี<br>
                                <b>ค่าเสื่อมยกมา : </b> {{ number_format($thSumNet, 2) ?? '-' }}<br>
                                <b>คำนวนเอง : </b> {{ number_format($asset_detail->AssPerc, 2) ?? '-' }}%<br>
                                <b>ถึงวันที่ : </b> {{ $asset_detail->AssDateTEnd ?? '-' }}<br>
                                {{-- <b>วันที่ขาย : </b> {{$asset_detail->}}<br> --}}
                                <b>ค่าเสื่อมเบื้อง : </b> -<br>
                                <b>กำไรขาดทุน : </b> -<br>
                                <b>ราคาขาย : </b>
                                @if ($totalSum - $totalSumNet > 0)
                                    {{ number_format($totalSum - $totalSumNet, 2) ?? '-' }} บาท
                                @else
                                    0 บาท
                                @endif
                            </div>

                            <div class=" col-lg-5 invoice-col border m-1" style="padding-top: 4px;">{{-- //col-sm-6 --}}
                                <b>วิธีคิดค่าเสื่อม : </b> คิดค่าเสื่อมต่อปีเอง<br>
                                <b>อัตราเสื่อม : </b> {{ number_format($asset_detail->AssPerc, 2) ?? '-' }}%<br>
                                <b>มูลค่าต้นงวด : </b> {{ number_format($asset_detail->Price, 2) ?? '-' }}<br>
                                <b>มูลค่า ณ ปัจจุบัน : </b>
                                @if ($asset_detail->Price - $sumTotalNet > 0)
                                    {{ number_format($asset_detail->Price - $sumTotalNet, 2) ?? '-' }} บาท
                                @else
                                    {{ number_format(0, 2) ?? '-' }} บาท
                                @endif
                            </div>

                            {{-- QR Code --}}
                            <div class="col-12 invoice-col m-1" style="padding-top: 4px;">
                                <div class="row">
                                    <div class="col-auto  py-2 text-right">
                                        {!! QrCode::size(100)->generate(Request::url()) !!}
                                    </div>
                                    <div class="col-8 align-self-center">
                                        <b>รหัสสินทรัพย์ : </b> {{ $asset_detail->AssetCode ?? '-' }}<br>
                                        <b>ชื่อ : </b> {{ $asset_detail->AssetName ?? '-' }}<br>
                                        <b>บริษัท : </b> {{ $asset_detail->CompName ?? '-' }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-2 border p-3 " id="pic-res">
                        @foreach ($asset_pic as $items)
                            <img data-enlargable
                                src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/{{ $items->pic_name }}"
                                alt="" width="100%">
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </section>

    @empty(!$asset_pic)
        <div class="bill-code-image">
            <a href="/" type="button" class="btn fw-bold button1" data-toggle="modal" data-target="#modal-lg-image">
                <img src="{{ asset('imges/image-file.png') }}" alt="approved" height="44" width="44"></a>
        </div>
    @else
    @endempty
    <div class="qr-code">
        <a href="/asset-qr/{{ $asset_detail->idAsset }}" type="button" class="btn fw-bold button1">
            <img src="{{ asset('imges/qr-code.png') }}" alt="qr-code" height="44" width="44"
                style="border-radius: 25px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);"></a>
    </div>

    {{-- <div class="bill-code">
        <a href="/qr-code" type="button" class="btn fw-bold button1" data-toggle="modal" data-target="#modal-lg">
            <img src="{{ asset('imges/contract.png') }}" alt="approved" height="44" width="44"></a>
    </div> --}}


    <div class="modal fade" id="modal-lg-image">
        <div class="modal-dialog modal-lg">

            <div class="modal-content"
                style="box-shadow: none;border:none;border-radius:0px;background-image: url(//www.somkiat.cc/wp-content/themes/accentbox/images/hbg.gif);">

                <div class="preview-area">
                    @foreach ($asset_pic as $items)
                        <img data-enlargable src="http://203.151.27.229/spm/Asset/PicAsset/{{ $items->pic_name }}"
                            alt="">
                    @endforeach
                </div>
                {{-- <img src="{{ asset('imges/contract.png') }}" alt=""> --}}
                {{-- <div class="modal-footer justify-content-end" style="padding: 0rem;">
                    <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">ปิด</button>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="box-shadow: none;border:none;border-radius:0px;">
                <form action="/asset_active" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title"><b>ยืนยันสินทรัพย์</b></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 align-self-center">
                                <input type="text" name="idAsset" id="idAsset" value="{{ $asset_detail->idAsset }}"
                                    hidden>
                                <input type="text" name="AssetCode" id="AssetCode"
                                    value="{{ $asset_detail->AssetCode }}" hidden>
                                <input type="text" name="AssetName" id="AssetName"
                                    value="{{ $asset_detail->AssetName }}" hidden>
                                <input type="text" name="CompName" id="CompName"
                                    value="{{ $asset_detail->CompName }}" hidden>


                                <a name="asset_code"><b>รหัสสินทรัพย์ : </b> {{ $asset_detail->AssetCode }}<br></a>
                                <b>ชื่อ : </b> {{ $asset_detail->AssetName }}<br>
                                <b>บริษัท : </b> {{ $asset_detail->CompName }}
                                <div class="control-group increment">

                                    <input type="file" name="filenames[]" id="filenames" class="form-control"
                                        placeholder="wal" multiple="multiple" accept="image/png, image/jpeg"
                                        onchange="preview(this)" style="padding-bottom: 35px;" required>


                                    <div class="preview-area"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn font-bold"
                            style="background-color: #3d8dbd;color:white;font-weight:800;">บันทึก</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            style="font-weight:800;">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function preview(elem, output = '') { //preview multi images
            Array.from(elem.files).map((file) => {
                const blobUrl = window.URL.createObjectURL(file)
                output += `<img src=${blobUrl}>`
            })
            elem.nextElementSibling.innerHTML = output
        }

        $('img[data-enlargable]').addClass('img-enlargable').click(function() {
            var src = $(this).attr('src');
            $('<div>').css({
                background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
                backgroundSize: 'contain',
                width: '100%',
                height: '100%',
                position: 'fixed',
                zIndex: '10000',
                top: '0',
                left: '0',
                cursor: 'zoom-out'
            }).click(function() {
                $(this).remove();
            }).appendTo('body');
        });
    </script>
@endpush
