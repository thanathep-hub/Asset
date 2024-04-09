@extends('layouts.master')
@section('title', 'Asset')
@push('css')
    <style>
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
            width: 48%;
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

            .select-custom-option {
                justify-content: end;
                margin-right: -3px;
            }
        }

        .select-custom-option {
            margin-left: -3px;
        }

        thead {
            background-color: greenyellow;
        }

        .car-maintenance {
            position: fixed;
            bottom: 22px;
            right: 22px;
            color: white;
            /* background-color: #34aae7; */
            /* background-color: #008cba; */
            border-radius: 8px;
        }

        .qr-code {
            position: fixed;
            bottom: 70px;
            right: 22px;
            color: white;
            /* background-color: #34aae7; */
            /* background-color: #008cba; */
            border-radius: 8px;
        }

        .btn-repair:hover {
            filter: brightness(50%);
        }

        /*  */

        button {
            font-family: inherit;
            /* background: linear-gradient(to bottom, #20ad88 0%, #006b4f 100%); */
            color: white;
            padding: 0.4em 0.4em;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 25px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }

        .button-qr {
            font-family: inherit;
            font-size: 15px;
            background: linear-gradient(to bottom, #fab005 0%, #6e4d00 100%);
            color: white;
            padding: 0.4em 0.4em;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 25px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }

        .button-qr a {
            color: white;
            display: block;
            margin-right: 0.4rem;
            transition: all 0.3s;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);
        }

        button:active {
            transform: scale(0.95);
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        button span {
            display: block;
            margin-right: 0.4rem;
            transition: all 0.3s;
        }

        button svg {
            width: 18px;
            height: 18px;
            fill: white;
            transition: all 0.3s;
        }

        button .svg-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            margin-right: 0.5em;
            transition: all 0.3s;
        }

        button:hover .svg-wrapper {
            background-color: rgba(255, 255, 255, 0.5);
        }

        button:hover svg {
            transform: rotate(45deg);
        }


        /*  */
        .invoice {
            box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: none;
        }
    </style>
@endpush
@section('content')

    <section class="content" style="padding: 0rem;">
        <div class="container-fluid" style="padding-top: 1rem;">
            <div class="invoice p-3 mb-3 pt-3">
                <!-- title row -->
                <div class="row mb-2" style="border-bottom: 1px solid rgb(112 112 112 / 27%);">
                    <div class="col-12">
                        <h4>
                            <img src="{{ asset('imges/van.png') }}" alt="approved" height="44" width="44">
                            <b class="pl-2">ทะเบียน {{ $query_vam->num_register }}</b>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row text-sm-center select-custom-option mb-1">
                    <div>
                        <select class="custom-select" aria-label="Default select" id="vam_select">
                            <optgroup label="ยานยนต์">
                                <option value="11">ข้อมูลยานยนต์</option>
                            </optgroup>
                            <optgroup label="เล่มเขียว">
                                <option value="21">ข้อมูลเล่มเขียว</option>
                            </optgroup>
                            <optgroup label="ค่าใช้จ่าย">
                                <option value="31">ค่าน้ำมัน</option>
                                <option value="32">ค่าบำรุงรักษา</option>
                                <option value="33">ค่าเบี้ยประกัน</option>
                                <option value="34">ค่า พ.ร.บ.</option>
                                <option value="35">ค่าภาษี</option>
                                <option value="36">ค่าซ่อมรถ</option>
                            </optgroup>
                            <optgroup label="มูลค่ารถยนต์">
                                <option value="41">มูลค่ารถยนต์</option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="row option" id="option_one"
                    style="box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
                    <div class="col-lg-4 border mr-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">ข้อมูลยานยนต์</h3>
                        </div>
                        <div class="p-1 mt-1">
                            <b>วันที่จดทะเบียน :
                            </b>{{ \Carbon\Carbon::parse($query_vam->date_register)->format('d/m/Y') }}<br>
                            <b>ใช้งานที่ : </b> {{ $query_vam->CompName }}<br>
                            <b>เลขทะเบียน : </b> {{ $query_vam->num_register }}<br>
                            <b>การครอบครอง : </b> {{ $query_vam->name_type_occupy }}<br>
                            <b>อายุ : </b> -<br>
                            <b>เกียร์ : </b>{{ $query_vam->gear ? $query_vam->gear : '-' }}<br>
                            <b>สถานะ : </b> {{ $query_vam->status_type ? $query_vam->status_type : '-' }}<br>
                            <b>แบบ : </b>{{ $query_vam->model ? $query_vam->model : '-' }}<br>
                            <b>ยี่ห้อรถ : </b> {{ $query_vam->name_brand_car }}<br>
                            <b>จังหวัด : </b> {{ $query_vam->name_province }}<br>
                            <b>ชื่อเรียกของรถ : </b> {{ $query_vam->name_car }}<br>
                            <b>สี : </b> {{ $query_vam->name_colour }}<br>
                            <b>ชนิดเชื้อเพลิง : </b> {{ $query_vam->name_fuel }}<br>
                            <b>รุ่น : </b>{{ $query_vam->name_generation }}<br>
                            <b>โครงการ : </b> {{ $query_vam->ProjectName }}<br>
                            <b>สถานะการซื้อ : </b>-
                            <div class="row">
                                <label class="col-auto fw-bold gr-font">หลักของรถสำหรับสรรพากร :
                                </label>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-auto text-lg-start">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"
                                            @if ($query_vam->revenue_name === 'ถูกหลัก') checked @endif>
                                        <label class="form-check-label gr-font" for="inlineCheckbox1">ถูกหลัก</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"
                                            @if ($query_vam->revenue_name === 'ไม่ถูกหลัก') checked @endif>
                                        <label class="form-check-label gr-font" for="inlineCheckbox2">ไม่ถูกหลัก</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 border mr-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">ข้อมูลการใช้งาน</h3>
                        </div>
                        <div class="p-1">
                            {{-- <b>ข้อมูลการใช้งาน </b><br> --}}
                            <b>ผู้รับผิดชอบ : </b> {{ $query_vam->nameOwner }}<br>
                            <b>แผนก : </b> {{ $query_vam->department }}<br>
                            {{-- <b>ข้อมูลผู้ขับ</b><br> --}}
                            <b>ผู้ขับ : </b> {{ $query_vam->nameOwner }}<br>
                            <p class="border-bottom pb-3"></p>
                            <b>อายุรถ :
                            </b>{{ $query_price->life_Time }} ปี<br>
                            <b>ค่าบำรุง : </b> {{ number_format($m_total, 2) }} บาท<br>
                            <b>ค่าซ่อม : </b> {{ number_format($repair_total, 2) }}<br>
                            <b>ราคารถ : </b> {{ number_format($query_price->price_car, 2) }} บาท<br>
                            <b>มูลค่าหลังหักค่าเสื่อม : </b> {{ number_format($query_price->Deteriorate_price, 2) }}
                            บาท<br>

                        </div>
                    </div>
                    <div class="col-lg-3 border "
                        style="background-image: url(//www.somkiat.cc/wp-content/themes/accentbox/images/hbg.gif);">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">รูปภาพ</h3>
                        </div>
                        <div class="preview-area">
                            <img data-enlargable src="{{ $query_vam->pic_front }}" alt="ด้านหน้า">
                            <img data-enlargable src="{{ $query_vam->pic_rear }}" alt="ด้านหลัง">
                            <img data-enlargable src="{{ $query_vam->pic_left }}" alt="ด้านซ้าย">
                            <img data-enlargable src="{{ $query_vam->pic_right }}" alt="ด้านขวา">

                        </div>
                    </div>
                </div>

                <div class="row option" id="option_two" style="display: none">
                    <div class="col-lg-4 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">ข้อมูลสมุดเล่มเขียว</h3>
                        </div>
                        <div class="p-1 mt-1">
                            <b>ราคา :
                            </b>{{ number_format($query_vam->price_car, 2) }}<br>
                            <b>ลักษณะของรถ : </b> {{ $query_vam->name_characteristic }}<br>
                            <b>ยี่ห้อรถ : </b> {{ $query_vam->name_brand_car }}<br>
                            <b>ตัวเลขรถ : </b> {{ $query_vam->num_body }}<br>
                            <b>เลขเครื่องยนต์ : </b>{{ $query_vam->num_engine }}<br>
                            <b>เลขถังแก๊ส : </b>{{ $query_vam->gear ? $query_vam->gear : '-' }}<br>
                            <b>ที่นั่ง : </b> {{ $query_vam->seat ? $query_vam->seat : '-' }}<br>
                            <b>น้ำหนักลงเพลา :
                            </b>{{ $query_vam->weight_transport ? $query_vam->weight_transport : '-' }}<br>
                            <b>น้ำหนักรถ : </b> {{ $query_vam->weight_car ? $query_vam->weight_car : '-' }}<br>
                            <b>น้ำหนักรวม : </b> {{ $query_vam->weight_add ? $query_vam->weight_add : '-' }}<br>
                            <b>จำนวนลูกสูบ : </b> {{ $query_vam->num_piston ? $query_vam->num_piston : '-' }}<br>
                            <b>เพลา : </b> {{ $query_vam->shaft ? $query_vam->shaft : '-' }}<br>
                            <b>แรงม้า : </b> {{ $query_vam->horsepower ? $query_vam->horsepower : '-' }}<br>
                            <b>จำนวนซีซี : </b>{{ $query_vam->num_cc ? $query_vam->num_cc : '-' }}<br>
                            <b>ล้อ : </b> {{ $query_vam->wheel ? $query_vam->wheel : '-' }}<br>
                            <b>ยาง : </b>{{ $query_vam->rubber ? $query_vam->rubber : '-' }}
                        </div>
                    </div>
                    <div class="col-lg-4 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">
                                ผู้ถือกรรมสิทธิ์และครอบครอง</h3>
                        </div>
                        <div class="p-1">
                            {{-- <b>ข้อมูลการใช้งาน </b><br> --}}
                            <b>ผู้ถือกรรมสิทธิ์ : </b>
                            @if ($query_vam->owner_idOut != null)
                                บุคคลหรือบริษัทภายนอก
                            @elseif ($query_vam->owner_idComp != null)
                                บริษัท
                            @elseif ($query_vam->owner_idPs != null)
                                บุคคลภายใน
                            @endif
                            <br>
                            <b>ชื่อ : </b>
                            @if ($query_vam->owner_idComp != null)
                                {{ $query_vam->owCompName }}
                            @elseif ($query_vam->owner_idPs != null)
                                {{ $query_vam->owPsName }}
                            @elseif ($query_vam->owner_idOut != null)
                                {{ $query_vam->owOutName }}
                            @else
                                -
                            @endif
                            <br><br>

                            <b>ผู้ครอบครอง : </b>
                            @if ($query_vam->occ_idOut != null)
                                บุคคลหรือบริษัทภายนอก
                            @elseif ($query_vam->occ_idComp != null)
                                บริษัท
                            @elseif ($query_vam->occ_idPs != null)
                                บุคคลภายใน
                            @endif
                            <br>
                            <b>ชื่อ : </b>
                            @if ($query_vam->occ_idComp != null)
                                {{ $query_vam->occCompName }}
                            @elseif ($query_vam->occ_idPs != null)
                                {{ $query_vam->occPsName }}
                            @elseif ($query_vam->occ_idOut != null)
                                {{ $query_vam->occOutName }}
                            @else
                                -
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-3 border m-1"
                        style="background-image: url(//www.somkiat.cc/wp-content/themes/accentbox/images/hbg.gif);">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">รูปภาพ</h3>
                        </div>
                        <div class="">
                            @if ($query_vam->doc_car != null)
                                <img data-enlargable src="{{ $query_vam->doc_car }}" alt="เล่มเขียว" width="100%">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row option" id="option_t_one" style="display: none">
                    <div class="col-lg-3 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">ข้อมูลค่าน้ำมัน</h3>
                        </div>
                        <div class="p-1 mt-1 text-center">
                            <b>รวมสุทธิ :
                            </b>{{ number_format($sum_total[0]->sum_total, 2) }}<br>
                        </div>
                    </div>
                    <div class="col-lg-8 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold text-nowrap" style="float: none;font-size: 1rem;">
                                ตารางข้อมูลค่าน้ำมัน</h3>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-head-fixed text-nowrap table-bordered">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>วันที่</th>
                                        <th>รายการ</th>
                                        <th>บิลรวม</th>
                                        <th>ผู้ทำรายการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query_oil as $items)
                                        <tr>
                                            <td style="text-align: center;">{{ $items->dateDo }}</td>
                                            <td style="">{{ $items->comment ? $items->comment : '- -' }}</td>
                                            <td style="text-align: center;">{{ number_format($items->total, 2) }}</td>
                                            {{-- <td class="text-center" style="padding: 0px;vertical-align: middle;"> <img
                                                    src="{{ asset('imges/image-file.png') }}" style="height: 36px"
                                                    alt=""></td> --}}
                                            <td style="text-align: center;">{{ $items->PsName }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row option" id="option_t_two" style="display: none">
                    <div class="col-lg-3 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">ข้อมูลค่าบำรุงรักษา</h3>
                        </div>
                        <div class="p-1 mt-1 text-center">
                            <b>รวมสุทธิ :
                            </b>{{ number_format($m_total, 2) }}<br>
                        </div>
                    </div>
                    <div class="col-lg-8 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">
                                ตารางข้อมูลค่าบำรุงรักษา</h3>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-hover table-head-fixed text-nowrap table-bordered">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>วันที่</th>
                                        <th>รายการ</th>
                                        <th>บิลรวม</th>
                                        <th>ผู้ทำรายการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query_m as $items)
                                        <tr>
                                            <td style="text-align: center;">{{ $items->dateDo }}</td>
                                            <td style="">{{ $items->comment ? $items->comment : '- -' }}</td>
                                            <td style="text-align: center;">{{ number_format($items->total, 2) }}</td>
                                            <td style="text-align: center;">{{ $items->PsName }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row option" id="option_t_three" style="display: none">
                    <div class="col-lg-3 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">ข้อมูลค่าเบี้ยประกัน
                            </h3>
                        </div>
                        <div class="p-1 mt-1 text-center">
                            <b>รวมสุทธิ :
                            </b>{{ number_format($insurance_total, 2) }}<br>
                        </div>
                    </div>
                    <div class="col-lg-8 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">
                                ตารางข้อมูลค่าเบี้ยประกัน</h3>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-hover table-head-fixed text-nowrap table-bordered">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>วันที่</th>
                                        <th>รายการ</th>
                                        <th>บิลรวม</th>
                                        <th>ผู้ทำรายการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query_insurance as $items)
                                        <tr>
                                            <td style="text-align: center;">{{ $items->dateDo }}</td>
                                            <td style="">{{ $items->comment ? $items->comment : '- -' }}</td>
                                            <td style="text-align: center;">{{ number_format($items->total, 2) }}</td>
                                            <td style="text-align: center;">{{ $items->PsName }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row option" id="option_t_four" style="display: none">
                    <div class="col-lg-3 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">ข้อมูลค่า พ.ร.บ.
                            </h3>
                        </div>
                        <div class="p-1 mt-1 text-center">
                            <b>รวมสุทธิ :
                            </b>{{ number_format($prb_total, 2) }}<br>
                        </div>
                    </div>
                    <div class="col-lg-8 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">
                                ตารางข้อมูล พ.ร.บ.</h3>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-hover table-head-fixed text-nowrap table-bordered">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>วันที่</th>
                                        <th>รายการ</th>
                                        <th>บิลรวม</th>
                                        <th>ผู้ทำรายการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query_prb as $items)
                                        <tr>
                                            <td style="text-align: center;">{{ $items->dateDo }}</td>
                                            <td style="">{{ $items->comment ? $items->comment : '- -' }}</td>
                                            <td style="text-align: center;">{{ number_format($items->total, 2) }}</td>
                                            <td style="text-align: center;">{{ $items->PsName }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row option" id="option_t_five" style="display: none">
                    <div class="col-lg-3 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">ข้อมูลค่าภาษี
                            </h3>
                        </div>
                        <div class="p-1 mt-1 text-center">
                            <b>รวมสุทธิ :
                            </b>{{ number_format($vat_total, 2) }}<br>
                        </div>
                    </div>
                    <div class="col-lg-8 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">
                                ตารางข้อมูลค่าภาษี</h3>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-hover table-head-fixed text-nowrap table-bordered">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>วันที่</th>
                                        <th>รายการ</th>
                                        <th>บิลรวม</th>
                                        <th>ผู้ทำรายการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query_vat as $items)
                                        <tr>
                                            <td style="text-align: center;">{{ $items->dateDo }}</td>
                                            <td style="">{{ $items->comment ? $items->comment : '- -' }}</td>
                                            <td style="text-align: center;">{{ number_format($items->total, 2) }}</td>
                                            {{-- <td class="text-center" style="padding: 0px;vertical-align: middle;"> <img
                                                    src="{{ asset('imges/image-file.png') }}" style="height: 36px"
                                                    alt=""></td> --}}
                                            <td style="text-align: center;">{{ $items->PsName }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row option" id="option_t_six" style="display: none">
                    <div class="col-lg-3 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">ข้อมูลค่าซ่อม
                            </h3>
                        </div>
                        <div class="p-1 mt-1 text-center">
                            <b>รวมสุทธิ :
                            </b>{{ number_format($repair_total, 2) }}<br>
                        </div>
                    </div>
                    <div class="col-lg-8 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">
                                ตารางข้อมูลค่าซ่อม</h3>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-hover table-head-fixed text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>วันที่</th>
                                        <th>รายการ</th>
                                        <th>บิลรวม</th>
                                        {{-- <th>รูปบิล</th> --}}
                                        <th>ผู้ทำรายการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query_repair as $items)
                                        <tr>
                                            <td class="text-center">{{ $items->dateDo }}</td>
                                            <td style="">{{ $items->comment ? $items->comment : '- -' }}</td>
                                            <td class="text-center">{{ number_format($items->total, 2) }}</td>
                                            {{-- <td class="text-center" style="padding: 0px;vertical-align: middle;"> <img
                                                    src="{{ asset('imges/image-file.png') }}" style="height: 36px"
                                                    alt=""></td> --}}
                                            <td class="text-center">{{ $items->PsName }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row option" id="option_four" style="display: none">
                    <div class="col-lg-4 border m-1">
                        <div class="card-header" style="padding: 0.25rem 1.25rem;text-align: center;">
                            <h3 class="card-title text-bold" style="float: none;font-size: 1rem;">ข้อมูลสินทรัพย์</h3>
                        </div>
                        <div class="p-1 mt-1">
                            <b>อายุรถ :
                            </b>{{ $query_price->life_Time }} ปี<br>
                            <b>ค่าบำรุง : </b> {{ number_format($m_total, 2) }} บาท<br>
                            <b>ค่าซ่อม : </b> {{ number_format($repair_total, 2) }}<br>
                            <b>ราคารถ : </b> {{ number_format($query_price->price_car, 2) }} บาท<br>
                            <b>มูลค่าหลังหักค่าเสื่อม : </b> {{ number_format($query_price->Deteriorate_price, 2) }}
                            บาท<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        </div>
    </section>

    <div class="qr-code ">
        <button data-toggle="modal" data-target="#qr-code" class="btn button-qr">
            {{-- <a href="/vam-qr/qr-code/{{ $query_vam->id_rec_car }}"> --}}
            <div class="svg-wrapper-1">
                <div class="svg-wrapper">
                    <img src="{{ asset('imges/scan.png') }}" width="24" height="26"
                        style="background-color: white;
                    border-radius: 4px;">
                </div>
            </div>
            <a href="/vam-qr/qr-code/{{ $query_vam->id_rec_car }}">QR-code</a>
            {{-- </a> --}}
        </button>
    </div>
    <div class="car-maintenance ">
        <button data-toggle="modal" data-target="#CarMaintenance"
            style="background: linear-gradient(to bottom, #20ad88 0%, #006b4f 100%);">
            <div class="svg-wrapper-1">
                <div class="svg-wrapper">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="26">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor"
                            d="M78.6 5C69.1-2.4 55.6-1.5 47 7L7 47c-8.5 8.5-9.4 22-2.1 31.6l80 104c4.5 5.9 11.6 9.4 19 9.4h54.1l109 109c-14.7 29-10 65.4 14.3 89.6l112 112c12.5 12.5 32.8 12.5 45.3 0l64-64c12.5-12.5 12.5-32.8 0-45.3l-112-112c-24.2-24.2-60.6-29-89.6-14.3l-109-109V104c0-7.5-3.5-14.5-9.4-19L78.6 5zM19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L233.7 374.3c-7.8-20.9-9-43.6-3.6-65.1l-61.7-61.7L19.9 396.1zM512 144c0-10.5-1.1-20.7-3.2-30.5c-2.4-11.2-16.1-14.1-24.2-6l-63.9 63.9c-3 3-7.1 4.7-11.3 4.7H352c-8.8 0-16-7.2-16-16V102.6c0-4.2 1.7-8.3 4.7-11.3l63.9-63.9c8.1-8.1 5.2-21.8-6-24.2C388.7 1.1 378.5 0 368 0C288.5 0 224 64.5 224 144l0 .8 85.3 85.3c36-9.1 75.8 .5 104 28.7L429 274.5c49-23 83-72.8 83-130.5zM56 432a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z" />
                    </svg>
                </div>
            </div>
            <span>แจ้งซ่อม</span>
        </button>
    </div>
    {{-- <div>
        <input type="text" name="num_register" id="num_register" value="{{ $query_vam->num_register }}">
        <input type="text" name="CompName" value="{{ $query_vam->CompName }}">
        <input type="text" name="name_car" value="{{ $query_vam->name_car }}">
        <input type="text" name="url" value="{{ Request::url() }}">
    </div> --}}

    <div tabindex="-1" class="modal pmd-modal fade " id="CarMaintenance" style="display: none;" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="box-shadow: none;background-clip:unset;">
                <div class="modal-header pmd-modal-border">
                    <h4 class="modal-title" style="color:black;"><b>ทะเบียน</b> : {{ $query_vam->num_register }}</h4>
                    {{-- <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button> --}}
                </div>
                <div class=" bxColor px-3 py-1" style="font-weight: 500;
                color: #566a7f;">

                    <b>กำหนดเปลี่ยนน้ำมันเครื่อง :
                    </b>
                    @if ($CarMaintenance != null)
                        @if ($CarMaintenance->CarMileage > $CarMaintenance->LatestEngineOilChangeMileage + 8000)
                            เลยกำหนด
                        @else
                            อีก {{ $CarMaintenance->LatestEngineOilChangeMileage + 8000 - $CarMaintenance->CarMileage }}
                            km.
                        @endif
                    @else
                        - -
                    @endif


                    <br>
                    <b>กำหนดเปลี่ยนยาง : </b>
                    @if ($CarMaintenance != null)
                        {{ $CarMaintenance->SchedulTireChangeDate ? \Carbon\Carbon::parse($CarMaintenance->SchedulTireChangeDate)->format('d/m/Y') : '- -' }}
                    @else
                        - -
                    @endif
                </div>
                <div class="modal-body" style="padding-bottom: 0px;">
                    <form action="/vam/car_maintenance" method="POST" style="font-size: 15px;">
                        @csrf
                        <div class="row d-flex justify-content-center border-bottom pb-2"
                            style="margin-left: 0px; margin-right:0px;">
                            <input type="text" name="id_rec_car" id="id_rec_car"
                                value="{{ $query_vam->id_rec_car }}" hidden>
                            <div class="form-check m-1 mx-2">
                                <input class="form-check-input" type="checkbox" value="EngineOilCheck"
                                    id="EngineOilCheck" name="EngineOilCheck">
                                <label class="form-check-label" for="EngineOilCheck"
                                    style="font-weight: 500;
                                color: #566a7f;">
                                    เปลี่ยนน้ำมันเครื่อง
                                </label>
                            </div>
                            <div class="form-check m-1 mx-2">
                                <input class="form-check-input" type="checkbox" value="TireCheck" id="TireCheck"
                                    name="TireCheck">
                                <label class="form-check-label" for="TireCheck"
                                    style="font-weight: 500;
                                color: #566a7f;">
                                    เปลี่ยนยาง
                                </label>
                            </div>
                            <div class="form-check m-1 mx-2">
                                <input class="form-check-input" type="checkbox" value="otherCheck" id="otherCheck"
                                    name="otherCheck">
                                <label class="form-check-label" for="other"
                                    style="font-weight: 500;
                                color: #566a7f;">
                                    อื่นๆ
                                </label>
                            </div>
                        </div>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label mt-2">
                            <label for="Mileage" style="color:#566a7f;">เลขไมล์ : <a
                                    style="color: red">*จำเป็น</a></label>
                            <input id="Mileage" name="Mileage" class="form-control" type="number"
                                placeholder="ระบุเลขไมล์" oninvalid="this.setCustomValidity('ระบุเลขไมล์')"
                                oninput="this.setCustomValidity('')" required>
                            <br>
                            <label style="color:#566a7f;">Note : อื่นๆ </label>
                            <textarea class="form-control" id="note" name="note" rows="3"
                                placeholder="เช่น เติมน้ำมัน เปลี่ยนอะไหล่..." required></textarea>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn pmd-ripple-effect btn-dark pmd-btn-flat"
                                    style="color: #8592a3;
                    border-color: rgba(0,0,0,0);
                    background: #ebeef0;"
                                    type="button">ยกเลิก</button>
                                <button class="btn pmd-ripple-effect pmd-btn-flat"
                                    style="color: #fff;
                        background-color: #158cba;
                        border-color: #137ea7;"
                                    type="submit">บันทึก</button>
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
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

        document.addEventListener('DOMContentLoaded', function() {
            const engineOilCheck = document.getElementById('EngineOilCheck');
            const tireCheck = document.getElementById('TireCheck');
            const noteTextarea = document.getElementById('note');
            const vamSelect = document.getElementById('vam_select');

            engineOilCheck.addEventListener('change', updateNote);
            tireCheck.addEventListener('change', updateNote);
            vamSelect.addEventListener('change', handleVamSelect);

            function updateNote() {
                let note = '';

                if (engineOilCheck.checked) {
                    note += 'เปลี่ยนน้ำมันเครื่อง';
                }
                if (tireCheck.checked) {
                    if (note !== '') {
                        note += ', ';
                    }
                    note += 'เปลี่ยนยาง';
                }

                noteTextarea.value = note;
            }

            function handleVamSelect() {
                const selectValue = parseInt(vamSelect.value);
                const optionFunctions = {
                    11: optionOne,
                    21: optionTwo,
                    31: optionTOne,
                    32: optionTTwo,
                    33: optionTThree,
                    34: optionTFour,
                    35: optionTFive,
                    36: optionTSix,
                    41: optionFour
                };

                if (optionFunctions[selectValue]) {
                    hideAllOptions();
                    optionFunctions[selectValue]();
                }
            }

            function optionOne() {
                console.log('ข้อมูลรถเบื้องต้น');
                showOption('option_one');
            }

            function optionTwo() {
                console.log('ข้อมูลเล่มเขียว');
                showOption('option_two');
            }

            function optionTOne() {
                console.log('ค่าน้ำมัน');
                showOption('option_t_one');
            }

            function optionTTwo() {
                console.log('ค่าบำรุงรักษา');
                showOption('option_t_two');
            }

            function optionTThree() {
                console.log('ค่าเบี้ยประกัน');
                showOption('option_t_three');
            }

            function optionTFour() {
                console.log('ค่า พ.ร.บ.');
                showOption('option_t_four');
            }

            function optionTFive() {
                console.log('ค่า ภาษี');
                showOption('option_t_five');
            }

            function optionTSix() {
                console.log('ค่า ซ่อม');
                showOption('option_t_six');
            }

            function optionFour() {
                console.log('มูลค่าสินทรัพย์');
                showOption('option_four');
            }

            function hideAllOptions() {
                const options = document.querySelectorAll('.option');
                options.forEach(option => {
                    option.style.display = 'none';
                });
            }

            function showOption(optionId) {
                const optionElement = document.getElementById(optionId);
                if (optionElement) {
                    hideAllOptions();
                    optionElement.style.display = 'flex';
                } else {
                    console.error(`Element with ID ${optionId} not found`);
                }
            }
        });
    </script>
@endpush
