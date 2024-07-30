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
            max-width: 150px;
            max-height: 150px;
        }
    </style>
@endpush
@section('content')
    <div class="mt-4 mb-3 search-bar d-md-none">
        <div class="card" style="padding: .75rem 0rem 1.5rem 0rem;">
            <div class="row d-flex justify-content-center align-items-center m-0">
                <div class="col-12 mb-3 text-end">
                    <img class="" src="{{ asset('assets/unsuccess.png') }}" height="24px">
                    <span class="form-label" style="font-weight: 500;color:#262c40a8;">รอยืนยัน</span>
                </div>
                <div class="col-md-8">
                    <div class="align-items-center" style="text-align: -webkit-center;">
                        <div class="asset-box-img mb-3">
                            <img class="asset-img"
                                src="https://seedsgroup.dyndns.org/spm/Asset/PicAsset/{{ $idAsset }}_1.jpg"
                                style="width: 100%;border-radius:12px;">
                        </div>
                        <div class="text-center">
                            <h6 id="AssetName">เครื่องพ่นยา ฮอนด้า(HONDA) พร้อมเครื่องยนต์ 3 สูบพร้อมเครื่องยนต์</h6>
                        </div>
                    </div>
                </div>
                <div class="border-bottom mb-3" style="width: 95%;"></div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">จำนวน</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="AssetAmount"></label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">Serial Number</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="SerialNumber">mz62347-er2</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">สถานะสินทรัพย์</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="AssetStatus">ใช้งานอยู่</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">ประเภทสินทรัพย์</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="AssetType">อุปกรณ์อื่นๆ</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">วันที่ซื้อ</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="PurchaseDate">29/06/2567</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">วันที่เริ่มใช้งาน</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="StartDate">29/06/2567</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">สถานที่จัดเก็บ</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="Location">บริษัท กรีนซีดส์ จำกัด</label>
                </div>

                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">ผู้รับผิดชอบ</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="ResponsiblePerson">เพชรินทร์ ชลูด</label>
                </div>

                <div class="border-bottom mb-3" style="width: 95%;"></div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">อายุการใช้งาน</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="AssetYear">5 ปี</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">มูลค่าต้นทุน</label>
                    <label class="col-7 text-end" style="font-weight: 500;" id="Cost">3,000 บาท</label>
                </div>
                <div class="col-12 row mb-2">
                    <label class="col-5 text-start" style="color: #262c40a8;font-weight: 500;">มูลค่าคงเหลือ</label>
                    <label class="col-7 text-end" style="font-weight: 500;color:#f8493b;" id="Value">1,000 บาท</label>
                </div>
            </div>

        </div>

    </div>




@endsection
@push('script')
    <script>
        $(document).ready(function() {
            callAssetDetail({{ $idAsset }})
        });

        function callAssetDetail(id) {
            console.log(id);

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/asset/item/" + id,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(data) {
                    console.log(data);
                    setData(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function setData(data) {
            document.getElementById("AssetName").innerText = data.AssetName;
            document.getElementById("AssetAmount").innerText = (parseInt(data.AssAmount, 10));;
            document.getElementById("AssetType").innerText = data.AssTypeName;
            document.getElementById("PurchaseDate").innerText = data.AssDateT;
            document.getElementById("StartDate").innerText = data.AssDateT;
            document.getElementById("Location").innerText = data.CompName;
            document.getElementById("ResponsiblePerson").innerText = "รอการอัพเดต";
            document.getElementById("SerialNumber").innerText = "#AS000x";
            document.getElementById("Cost").innerText = parseFloat(data.Price).toFixed(2) + " บาท";
            document.getElementById("Value").innerText = "รอการอัพเดต";
        }
    </script>
@endpush
