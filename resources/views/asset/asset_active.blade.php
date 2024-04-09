@extends('layouts.master')
@section('title', 'Asset Active')
<style>
    table#active_all {
        font-size: 12px;
    }

    td {
        white-space: nowrap;
    }

    .brr {
        border-right: 1px solid #dee2e6;
    }

    .text {
        max-width: 160px;
        /* กำหนดความยาวสูงสุดที่ text จะถูกแสดง */
        overflow: hidden;
        /* ซ่อนเนื้อหาที่เกินขอบตัวอักษร */
        text-overflow: ellipsis;
        /* แสดงเครื่องหมาย ... ถ้าเนื้อหาเกินขอบตัวอักษร */
        white-space: nowrap;
        /* ไม่ให้ข้อความขึ้นบรรทัดใหม่ */
    }

    @media only screen and (max-width: 576px) {
        .title-assett-active {
            text-align: center;
        }
    }

    .card {
        box-shadow: 8px 25px 60px 5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        background-color: #fff;
    }
</style>

@section('content')
    <!-- Main content -->
    {{-- <section class="content-header">
        <div class="container-fluid">
        </div>
    </section> --}}
    <section class="content" style="padding: 0.5rem 0.5rem;">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header py-3 title-assett-active">
                    <h5 class="m-0 font-weight-bold text-primary">ASSET ที่ยืนยันแล้ว</h5>
                </div>
                <div class="card-tools col-lg-4 my-2" style="align-self: center;">
                    <div class="input-group input-group-md">
                        <input type="text" id="searchInput" class="form-control" placeholder="ค้นหารหัสหรือชื่อ"
                            required>
                        <div class="input-group-append">
                            <div class="btn" id="searchButton"
                                style="background-color:#21b5ae;border-color:#21b5ae;color:#ffffff;padding-top:10px;">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0.25rem;">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="active_all" width="100%" cellspacing="0">
                            <thead style="background-color: #343a40;color:#fff;">
                                <tr style="text-align: center;white-space:nowrap;">
                                    <th>ดูข้อมูล</th>
                                    <th>รหัส</th>
                                    <th>สินทรัพย์</th>
                                    <th>บริษัท</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล
                                    </td>
                                </tr>
                                {{-- @foreach ($query_active as $item)
                                    <tr>
                                        <td style="text-align: center;padding: 0px;vertical-align: middle;">
                                            <a href="/asset/{{ $item->idAsset }}"><img
                                                    src="https://cdn-icons-png.flaticon.com/128/3767/3767084.png"
                                                    alt="" style="height: 26px;"></a>
                                        </td>
                                        <td style="text-align: center;">{{ $item->AssetCode }}</td>
                                        <td>{{ $item->AssetName }}</td>
                                        <td style="text-align: center;">{{ $item->compName }}</td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')
    <script>
        $('#searchButton').click(function() {
            var searchInput = $('#searchInput').val();
            if (searchInput == "") {
                console.log("null");
            } else {
                $.ajax({
                    url: '{{ route('asset_act_search') }}',
                    type: 'GET',
                    data: {
                        searchInput: searchInput
                    },
                    success: function(response) {
                        assetCall(response);
                    },
                    error: function(error) {
                        console.error('Error fetching chart data', error);
                    }
                });
            }

        });

        function assetCall(data) {
            console.log(data);
            var tbody = $('#active_all tbody');

            tbody.empty();

            if (data.length === 0) {
                // หากไม่มีข้อมูล
                var row =
                    '<tr><td colspan="4" style="text-align: center;background-color: lightgray;">ไม่มีข้อมูล</td></tr>';
                tbody.append(row);
            } else {
                data.forEach(function(item) {
                    var row = '<tr>';
                    row += '<td class="brr" style="text-align: center; padding: 0px; vertical-align: middle;">' +
                        '<a href="/asset/' + item.idAsset + '">' +
                        '<img src="https://cdn-icons-png.flaticon.com/128/3767/3767084.png" alt="" style="height: 26px;">' +
                        '</a>' +
                        '</td>';

                    row += '<td class="brr" style="text-align: center;">' + item.AssetCode + '</td>';

                    row += '<td class="text brr">' + item.AssetName + '</td>';

                    row += '<td class="brr" style="text-align: center;">' + item.compName + '</td>';

                    row += '</tr>';
                    tbody.append(row);
                });
            }
        }

        function asset_act_ex() {
            $.ajax({
                url: '/asset_act_ex',
                method: 'GET',
                success: function(response) {

                    assetCall(response);
                },
                error: function(error) {
                    console.error('Error fetching chart data', error);
                }
            });
        }
        $(document).ready(function() {
            asset_act_ex();
        });
    </script>
@endpush
