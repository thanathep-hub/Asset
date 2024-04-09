@extends('layouts.master')
@section('title', 'Asset Active')
<style>
    table#active_all {
        font-size: 12px;
    }

    td {
        white-space: nowrap;
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
    <section class="content" style="padding: 0.5rem 0.5rem;">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header py-3 title-assett-active">
                    <h5 class="m-0 font-weight-bold text-primary">ASSET ที่ยืนยันแล้ว</h5>
                </div>
                <div class="card-body">
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
                                @foreach ($query_active as $item)
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
                                @endforeach
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
        // Call the dataTables jQuery plugin
        // $(document).ready(function() {
        //     $('#active_all').DataTable({
        //         language: {
        //             url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/th.json',
        //         },
        //     });
        // });
    </script>
@endpush
