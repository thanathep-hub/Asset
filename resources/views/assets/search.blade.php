@push('style')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
@endpush
<style>
    .modal-content-active {
        /* border-radius: 32px !important; */
    }

    /* tom select */
    .ts-control {
        font-size: unset;
        line-height: unset;
        border: unset;
        padding: unset;
    }

    .ts-dropdown {
        font-size: unset;
        border: 1px solid #dee2e6;
        border-radius: 12px;
    }

    .ts-dropdown [data-selectable].option {
        padding: .75rem;
        border-radius: 0px;
    }

    .form-select {
        height: 40px;
    }

    /* tom select */

    .btn-filter {
        border-radius: 12px;
        border: none;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    }

    .search-input {
        max-width: 400px !important;
        border: none;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        border-radius: 12px;

    }

    /* search-result */
    @media only screen and (min-width: 600px) {
        .search-result {
            padding: 1.5rem;
        }
    }

    .search-result-list:hover {
        border-radius: 12px;
        /* background-color: #fefce8; */
        background-color: #fff2f1;
    }
</style>

<div class="card m-4 mx-0 p-4">
    <div class="search-bar mb-3">
        <div class="d-flex justify-content-end gap-2" role="search">
            {{-- <input class="form-control me-2 shadow-sm" type="search" placeholder="ค้นหาตามชื่อ" aria-label="ค้นหา"
                style="max-width: 400px;"> --}}
            <button class="btn btn-filter" onclick="searchModal()" style="background-color:#fef6f2;color:#f8493b;">
                <i class="fa-solid fa-magnifying-glass"></i>
                ค้นหา
            </button>
            <button class="btn btn-filter" onclick="showFilter()" style="background-color:#f8493b;color:#fff;">
                <i class="fa-solid fa-sliders"></i>
                ตัวกรอง
            </button>
        </div>

    </div>
    <div class="align-items-center justify-content-center">
        @include('assets.assets-m')
    </div>
</div>

<div class="modal fade" id="search-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg " style="height: 95vh; display: flex; flex-direction: column;">
        <div class="modal-content border-0" style="height: 100%; display: flex; flex-direction: column;">
            <div class="modal-header border-0" style="background-color: #fef6f2;">
                <h1 class="modal-title fs-5" style="font-weight: 700; color: #480c07;">
                    <img class="pe-2" src="{{ asset('assets/3d-magnifier.png') }}" height="28px">ค้นหา
                </h1>
                <button type="button" class="btn-close-new-asset" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body" style="flex-grow: 1; overflow-y: auto;">
                <div class="serarch-layout mb-3" style="text-align: -webkit-center;">
                    <div class="search-input">
                        <input type="search" id="search-input" class="form-control border-0"
                            placeholder="ค้นหาด้วยชื่อ เช่น คอมพิวเตอร์...">
                    </div>
                </div>
                <div class="search-result" id="search_result">
                    {{-- <div class="d-flex mb-3 search-result-list p-2">
                        <img src="{{ asset('assets/box.png') }}" class="pe-3" height="44">
                        <div>
                            <label for="">กล่องทดสอบแสดงรายการ</label>
                            <p style="color:#9ca3af;">company</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="search-filter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md"> {{-- modal-dialog-centered --}}
        <div class="modal-content modal-content-active border-0">
            <div class="modal-header border-0" style="background-color: #dbe3fe;">
                <h1 class="modal-title fs-5" style="font-weight: 700;color: #1e378a;"><img class="pe-2"
                        src="{{ asset('assets/filter.png') }}" height="28px">ตัวกรอง</h1>
                <button type="button" class="btn-close-new-asset" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form class="p-4 pt-0">

                    <div class="mb-3">
                        <label class="form-label">ประเภทสินทรัพย์</label>
                        <select class="form-select" id="search-filter-category">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">บริษัท</label>
                        <select class="form-select" id="search-filter-company" placeholder="ค้นหาบริษัท...">

                        </select>
                    </div>
                    <button type="button" class="btn w-full btn-save-asset mt-3" onclick="search_filter_save()"
                        style="height: 44px;color:#fff;background-color:#3b66f6;">
                        <i class="fa-regular fa-circle-check pe-2"></i>ตกลง</button>
                </form>
            </div>
        </div>
    </div>
</div>



@push('script')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        $(document).ready(function() {
            search_filter_category();
            search_filter_company();
        });

        function showFilter() {
            $('#search-filter').modal('show');

        }

        function search_filter_category() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/asset/catagory",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(catagory) {
                    $('#search-filter-category').empty();
                    $('#search-filter-category').append(`
                        <option value="0" selected>ทั้งหมด</option>
                        `);
                    $.each(catagory, function(index, items) {
                        $('#search-filter-category').append(`
                        <option value="${items.idAssType}" >${items.AssTypeName}</option>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function search_filter_company() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/api/company",
                type: 'GET',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                success: function(company) {
                    // $('#search-filter-company').append(`
                //     <option value="0" selected>ทั้งหมด</option>
                //     `);
                    $('#search-filter-company').empty();
                    $.each(company, function(index, items) {
                        let selected = ({{ session('idComp') }} == items.idComp) ? 'selected' : '';
                        $('#search-filter-company').append(`
                            <option value="${items.idComp}" ${selected}>${items.CompName}</option>
                        `);
                    });

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function searchModal() {
            $('#search-modal').modal('show');
        }

        function search_filter_save() {
            $('#search-filter').modal('hide');
        }

        const inputText = document.getElementById("search-input");
        inputText.addEventListener("input", search_query);

        function search_query() {
            let searchInput = document.getElementById('search-input').value;

            if (searchInput != '') {
                let company = document.getElementById('search-filter-company').value;
                let category = document.getElementById('search-filter-category').value;

                $.ajax({
                    url: '/assets/search/input',
                    type: 'GET',
                    data: {
                        company: company,
                        category: category,
                        textQuery: searchInput
                    },
                    success: function(response) {
                        $('#search_result').empty();

                        // Check if response contains a message (e.g., no results)
                        if (response.message) {
                            $('#search_result').append(`
                                <div class="alert alert-info">ไม่พบรายการที่ค้นหา</div>
                            `);
                        } else {
                            // Append search results
                            $.each(response, function(index, items) {
                                $('#search_result').append(`
                                    <div class="d-flex mb-3 search-result-list p-2" onclick="assetDetail(${items.idAsset})">
                                        <img src="{{ asset('assets/box.png') }}" class="pe-3" height="44">
                                        <div>
                                            <label for="result-name">${items.AssetName}</label>
                                            <p style="color:#9ca3af;">${items.CompCode}</p>
                                        </div>
                                    </div>
                                `);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // console.log("Error: " + error);
                        // Optionally, show an error message in the UI
                        $('#search_result').empty().append(`
                            <div class="alert alert-danger">ไม่พบรายการที่ค้นหา</div>
                        `);
                    }
                });

            }
        }
    </script>
@endpush
