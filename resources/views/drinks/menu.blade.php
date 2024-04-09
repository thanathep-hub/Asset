<style>
    .ahove {
        /* font-weight: 600;
        color: #04764e; */
        background-color: #e5f5f0;
        font-weight: 600;
        color: #01643d;
        /* border: 1px solid #d4c594; */
    }

    .ahove:hover,
    .ahove:focus,
    .ahove.active {
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #04764e;
    }

    .color-wsm {
        color: #000;
    }

    .valueCount {
        color: black;
        text-align: center;
        padding: 0 10px;
        height: 100%;
        font-size: 1.125rem;
        font-weight: 500;
        background: transparent;
        border: 0;
        z-index: 3;
        text-align: center;
        position: relative;
        flex: 1 1 auto;
        width: 45px;
        min-width: 0;
    }

    .menu-list {
        border-bottom: 1px solid #D2C6B9;
    }

    #tawanyim {
        background: linear-gradient(0deg, #faf1dd 6%, rgba(255, 255, 255, 1) 100%);
        padding-left: 12px;
        padding-right: 12px;
    }
</style>

<div class="content-main-menu">

    <div id="show_menu_1" class="row container-content" style="display: none;place-content: center; padding: unset;">
        @forelse($getMenus as $items)
            @if ($items->cat_product_drink == 1)
                <div class="row menu-list" style="color: #000">
                    <div class="col-4" style="text-align: center;">
                        <img src="{{ asset('images/tawanyim_menu.png') }}" id="tawanyim" width="100%"
                            style="border-radius: 12px; max-width: fit-content" />
                    </div>

                    <div class="col-8" style="align-content: space-evenly;font-size:14px;">
                        <label for="menu_name" class="fw-900 mt-2">{{ $items->name_product_drink }}</label>
                        <div class="mt-2 row"
                            style="font-size:1rem;
                  margin: 0px;
                  align-items: center;
                  justify-content: space-between;
                ">
                            <label class="col-auto fw-900" for="menu_price"
                                style="padding-left: unset; text-align: start;margin: unset;color: #404140;">฿{{ $items->price_product_drink }}</label>

                            <botton
                                onclick="showProduct({{ $items->id_product_drink }}, '{{ $items->name_product_drink }}', {{ $items->price_product_drink }})"
                                class="btn col-auto ahove"
                                style="
                    gap: 10px;
                    padding: 10px 20px;
                    border-radius: 50px;
                    align-items: center;
                    margin-right: unset;
                  ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" style="margin-bottom: 3px;" class="bi bi-bag-plus"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                </svg>
                                {{-- <label class="col-auto fw-900">สั่ง</label> --}}
                            </botton>
                        </div>
                    </div>
                </div>
            @endif

        @empty
        @endforelse
    </div>
    <div id="show_menu_2" class="row container-content" style="display: none;place-content: center; padding: unset;">

        @forelse($getMenus as $items)
            @if ($items->cat_product_drink == 2)
                <div class="row menu-list" style="color:#000;">
                    <div class="col-4" style="text-align: center;">
                        <img src="{{ asset('images/tawanyim_menu.png') }}" id="tawanyim" height="100px;"
                            style="border-radius: 12px; max-width: fit-content" />
                    </div>

                    <div class="col-8" style="align-content: space-evenly;font-size:14px;">
                        <label for="menu_name" class="fw-900 mt-2">{{ $items->name_product_drink }}</label>
                        <div class="mt-2 row"
                            style="font-size:1rem;
                  margin: 0px;
                  align-items: center;
                  justify-content: space-between;
                ">
                            <label class="col-auto fw-900" for="menu_price"
                                style="padding-left: unset; text-align: start;margin: unset;color: #404140;">฿{{ $items->price_product_drink }}</label>

                            <botton
                                onclick="showProduct({{ $items->id_product_drink }}, '{{ $items->name_product_drink }}', {{ $items->price_product_drink }})"
                                class="btn col-auto ahove" {{-- data-bs-toggle="modal" data-bs-target="#menu-detail" --}}
                                style="
                    gap: 10px;
                    padding: 10px 20px;
                    border-radius: 50px;
                    align-items: center;
                    margin-right: unset;
                  ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" style="margin-bottom: 3px;" class="bi bi-bag-plus"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                </svg>
                                {{-- <label class="col-auto fw-900">สั่ง</label> --}}
                            </botton>
                        </div>
                    </div>
                </div>
            @endif

        @empty
        @endforelse

    </div>
    <div id="show_menu_3" class="row container-content" style="display: none;place-content: center; padding: unset;">

        @forelse($getMenus as $items)
            @if ($items->cat_product_drink == 3)
                <div class="row menu-list" style="color:#000;">
                    <div class="col-4" style="text-align: center;">
                        <img src="{{ asset('images/tawanyim_menu.png') }}" id="tawanyim" height="100px;"
                            style="border-radius: 12px; max-width: fit-content" />
                    </div>

                    <div class="col-8" style="align-content: space-evenly;font-size:14px;">
                        <label for="menu_name" class="fw-900 mt-2">{{ $items->name_product_drink }}</label>
                        <div class="mt-2 row"
                            style="font-size:1rem;
                  margin: 0px;
                  align-items: center;
                  justify-content: space-between;
                ">
                            <label class="col-auto fw-900" for="menu_price"
                                style="padding-left: unset; text-align: start;margin: unset;color: #404140;">฿{{ $items->price_product_drink }}</label>

                            <botton
                                onclick="showProduct({{ $items->id_product_drink }}, '{{ $items->name_product_drink }}', {{ $items->price_product_drink }})"
                                class="btn col-auto ahove" {{-- data-bs-toggle="modal" data-bs-target="#menu-detail" --}}
                                style="
                    gap: 10px;
                    padding: 10px 20px;
                    border-radius: 50px;
                    align-items: center;
                    margin-right: unset;
                  ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" style="margin-bottom: 3px;" class="bi bi-bag-plus"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                </svg>
                                {{-- <label class="col-auto fw-900">สั่ง</label> --}}
                            </botton>
                        </div>
                    </div>
                </div>
            @endif

        @empty
        @endforelse

    </div>
    <div id="show_menu_4" class="row container-content" style="display: none;place-content: center; padding: unset;">
        @forelse($getMenus as $items)
            @if ($items->cat_product_drink == 4)
                <div class="row menu-list" style="color:#000;">
                    <div class="col-4" style="text-align: center;">
                        <img src="{{ asset('images/tawanyim_menu.png') }}" id="tawanyim" height="100px;"
                            style="border-radius: 12px; max-width: fit-content" />
                    </div>

                    <div class="col-8" style="align-content: space-evenly;font-size:14px;">
                        <label for="menu_name" class="fw-900 mt-2">{{ $items->name_product_drink }}</label>
                        <div class="mt-2 row"
                            style="font-size:1rem;
                  margin: 0px;
                  align-items: center;
                  justify-content: space-between;
                ">
                            <label class="col-auto fw-900" for="menu_price"
                                style="padding-left: unset; text-align: start;margin: unset;color: #404140;">฿{{ $items->price_product_drink }}</label>

                            <botton
                                onclick="showProduct({{ $items->id_product_drink }}, '{{ $items->name_product_drink }}', {{ $items->price_product_drink }})"
                                class="btn col-auto ahove" {{-- data-bs-toggle="modal" data-bs-target="#menu-detail" --}}
                                style="
                    gap: 10px;
                    padding: 10px 20px;
                    border-radius: 50px;
                    align-items: center;
                    margin-right: unset;
                  ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" style="margin-bottom: 3px;" class="bi bi-bag-plus"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                </svg>
                                {{-- <label class="col-auto fw-900">สั่ง</label> --}}
                            </botton>
                        </div>
                    </div>
                </div>
            @endif

        @empty
        @endforelse
    </div>
    <div id="show_menu_5" class="row container-content" style="display: none;place-content: center; padding: unset;">
        @forelse($getMenus as $items)
            @if ($items->cat_product_drink == 5)
                <div class="row menu-list" style="color:#000;">
                    <div class="col-4" style="text-align: center;">
                        <img src="{{ asset('images/tawanyim_menu.png') }}" id="tawanyim" height="100px;"
                            style="border-radius: 12px; max-width: fit-content" />
                    </div>

                    <div class="col-8" style="align-content: space-evenly;font-size:14px;">
                        <label for="menu_name" class="fw-900 mt-2">{{ $items->name_product_drink }}</label>
                        <div class="mt-2 row"
                            style="font-size:1rem;
                  margin: 0px;
                  align-items: center;
                  justify-content: space-between;
                ">
                            <label class="col-auto fw-900" for="menu_price"
                                style="padding-left: unset; text-align: start;margin: unset;color: #404140;">฿{{ $items->price_product_drink }}</label>

                            <botton
                                onclick="showProduct({{ $items->id_product_drink }}, '{{ $items->name_product_drink }}', {{ $items->price_product_drink }})"
                                class="btn col-auto ahove" {{-- data-bs-toggle="modal" data-bs-target="#menu-detail" --}}
                                style="
                    gap: 10px;
                    padding: 10px 20px;
                    border-radius: 50px;
                    align-items: center;
                    margin-right: unset;
                  ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" style="margin-bottom: 3px;" class="bi bi-bag-plus"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                </svg>
                                {{-- <label class="col-auto fw-900">สั่ง</label> --}}
                            </botton>
                        </div>
                    </div>
                </div>
            @endif

        @empty
        @endforelse
    </div>
    <div id="show_menu_6" class="row container-content" style="display: none;place-content: center; padding: unset;">
        @forelse($getMenus as $items)
            @if ($items->cat_product_drink == 6)
                <div class="row menu-list" style="color:#000;">
                    <div class="col-4" style="text-align: center;">
                        <img src="{{ asset('images/tawanyim_menu.png') }}" id="tawanyim" height="100px;"
                            style="border-radius: 12px; max-width: fit-content" />
                    </div>

                    <div class="col-8" style="align-content: space-evenly;font-size:14px;">
                        <label for="menu_name" class="fw-900 mt-2">{{ $items->name_product_drink }}</label>
                        <div class="mt-2 row"
                            style="font-size:1rem;
                  margin: 0px;
                  align-items: center;
                  justify-content: space-between;
                ">
                            <label class="col-auto fw-900" for="menu_price"
                                style="padding-left: unset; text-align: start;margin: unset;color: #404140;">฿{{ $items->price_product_drink }}</label>

                            <botton
                                onclick="showProduct({{ $items->id_product_drink }}, '{{ $items->name_product_drink }}', {{ $items->price_product_drink }})"
                                class="btn col-auto ahove" {{-- data-bs-toggle="modal" data-bs-target="#menu-detail" --}}
                                style="
                    gap: 10px;
                    padding: 10px 20px;
                    border-radius: 50px;
                    align-items: center;
                    margin-right: unset;
                  ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" style="margin-bottom: 3px;" class="bi bi-bag-plus"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                </svg>
                                {{-- <label class="col-auto fw-900">สั่ง</label> --}}
                            </botton>
                        </div>
                    </div>
                </div>
            @endif

        @empty
        @endforelse
    </div>
    <div id="show_menu_7" class="row container-content" style="display: none;place-content: center; padding: unset;">
        @forelse($getMenus as $items)
            @if ($items->cat_product_drink == 8)
                <div class="row menu-list" style="color:#000;">
                    <div class="col-4" style="text-align: center;">
                        <img src="{{ asset('images/tawanyim_menu.png') }}" id="tawanyim" height="100px;"
                            style="border-radius: 12px; max-width: fit-content" />
                    </div>

                    <div class="col-8" style="align-content: space-evenly;font-size:14px;">
                        <label for="menu_name" class="fw-900 mt-2">{{ $items->name_product_drink }}</label>
                        <div class="mt-2 row"
                            style="font-size:1rem;
                  margin: 0px;
                  align-items: center;
                  justify-content: space-between;
                ">
                            <label class="col-auto fw-900" for="menu_price"
                                style="padding-left: unset; text-align: start;margin: unset;color: #404140;">฿{{ $items->price_product_drink }}</label>

                            <botton
                                onclick="showProduct({{ $items->id_product_drink }}, '{{ $items->name_product_drink }}', {{ $items->price_product_drink }})"
                                class="btn col-auto ahove" {{-- data-bs-toggle="modal" data-bs-target="#menu-detail" --}}
                                style="
                    gap: 10px;
                    padding: 10px 20px;
                    border-radius: 50px;
                    align-items: center;
                    margin-right: unset;
                  ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" style="margin-bottom: 3px;" class="bi bi-bag-plus"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                </svg>
                                {{-- <label class="col-auto fw-900">สั่ง</label> --}}
                            </botton>
                        </div>
                    </div>
                </div>
            @endif

        @empty
        @endforelse
    </div>
</div>

<div class="modal fade" id="menu-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content animate-bottom">
            <div class="modal-header" style="margin-left: unset;margin-right:unset;">
                <h1 class="modal-title fs-5 fw-900 " style="margin-left: unset;
                margin-right: unset;">
                    เมนู : </h1>
                <h1 class="modal-title fs-5 fw-900" id="menuLabel"
                    style="margin-left: unset;
                margin-right: unset;">
                    {{--                    --}}
                </h1>
                <button type="button" class="btn fw-900" data-bs-dismiss="modal"
                    style="
                    background-color:#e5f5f0;
                  border-radius: 24px;
                ">
                    ✕
                </button>
            </div>
            <div class="modal-body" style="margin-left: unset;margin-right:unset;">
                <label class="fw-900" id="menuLabel"
                    style="
                  margin-bottom: 0.25rem;
                  font-size: small;
                  width: 100%;
                  text-align: start;
                ">เลือกขนาด
                    Size</label>

                <div class="form-group my-2 px-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="size" id="size0"
                            value='{"name":"ขนาดปกติ","val":0}' checked />
                        <label class="form-check-label color-wsm" for="size1">
                            ขนาดปกติ
                        </label>
                        <label class="form-check-label color-wsm" for="price"
                            style="float: inline-end; font-weight: 700">฿0</label>
                    </div>
                </div>

                <div style="border-bottom: 1px solid #8080801f"></div>
                <label class="fw-900" id="menuLabel"
                    style="
                  margin-bottom: 0.25rem;
                  font-size: small;
                  width: 100%;
                  text-align: start;
                ">เลือกชนิด</label>
                <div class="form-group my-2 px-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="typeCold"
                            value='{"name":"ร้อน","val":0}' />
                        <label class="form-check-label color-wsm" for="typeCold">
                            ร้อน
                        </label>
                        <label class="form-check-label color-wsm" for="price"
                            style="float: inline-end; font-weight: 700">฿0</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="typeHot"
                            value='{"name":"เย็น","val":5}' checked />
                        <label class="form-check-label color-wsm" for="typeHot">
                            เย็น
                        </label>
                        <label class="form-check-label color-wsm" for="price"
                            style="float: inline-end; font-weight: 700">฿5</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="typeSmoothie"
                            value='{"name":"ปั่น","val":10}' />
                        <label class="form-check-label color-wsm" for="typeSmoothie">
                            ปั่น
                        </label>
                        <label class="form-check-label color-wsm" for="price"
                            style="float: inline-end; font-weight: 700">฿10</label>
                    </div>
                </div>
                <div style="border-bottom: 1px solid #8080801f"></div>
                <label class="fw-900" id="menuLabel"
                    style="
                  margin-bottom: 0.25rem;
                  font-size: small;
                  width: 100%;
                  text-align: start;
                ">เลือกความหวาน</label>
                <div class="form-group my-2 px-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="syrup" id="Syrup0"
                            value='{"name":"ไม่หวาน","val":0}' />
                        <label class="form-check-label color-wsm" for="Syrup0">
                            ไม่หวาน
                        </label>
                        <label class="form-check-label color-wsm" for="price"
                            style="float: inline-end; font-weight: 700">฿0</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="syrup" id="Syrup25"
                            value='{"name":"หวาน 25","val":0}' />
                        <label class="form-check-label color-wsm" for="Syrup25">
                            หวาน 25%
                        </label>
                        <label class="form-check-label color-wsm" for="price"
                            style="float: inline-end; font-weight: 700">฿0</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="syrup" id="Syrup50"
                            value='{"name":"หวาน 50","val":0}' checked />
                        <label class="form-check-label color-wsm" for="Syrup50">
                            หวาน 50%
                        </label>
                        <label class="form-check-label color-wsm" for="price"
                            style="float: inline-end; font-weight: 700">฿0</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="syrup" id="Syrup75"
                            value='{"name":"หวาน 75","val":0}' />
                        <label class="form-check-label color-wsm" for="Syrup75">
                            หวาน 75%
                        </label>
                        <label class="form-check-label color-wsm" for="price"
                            style="float: inline-end; font-weight: 700">฿0</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="syrup" id="Syrup100"
                            value='{"name":"หวาน 100","val":0}' />
                        <label class="form-check-label color-wsm" for="Syrup100">
                            หวาน 100
                        </label>
                        <label class="form-check-label color-wsm" for="price"
                            style="float: inline-end; font-weight: 700">฿0</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer"
                style="border-top: 1px solid #8080801f;width: 100%;justify-content: space-between;display: flex;align-items: center;">

                <div class="quality" style="display: flex; align-items: center;">

                    <button class="btn btn-decrease" id="decrement"
                        style="border-radius: 25px;background-color: gray;color: white;width:38px;">
                        -
                    </button>

                    <input readonly type="text" id="quantity" class="px-2 fw-400 valueCount" value="1">

                    <button class="btn btn-increase" id="increment"
                        style="border-radius: 25px;background-color: gray;color: white;width:38px;">
                        +
                    </button>

                </div>

                <button onclick="addCart()" type="button" class="btn"
                    style="background-color: #04764e;color: white;font-weight: 700;text-wrap: nowrap;width: 60%;">
                    <label for="" class="ml-4" style="float: inline-start">ใส่ตะกร้า</label><label
                        for="" style="float: inline-end">฿<span id="totalPrice">25</span></label>
                </button>

            </div>

        </div>
    </div>
</div>


<script>
    let idProduct;
    let nameProduct;
    let priceProduct;

    $(document).ready(function() {
        callMenus();
        hideAllMenu();
        document.getElementById('show_menu_2').style.display = 'flex';

        $('input[name="size"]').on('click', function() {
            calTotal();
        });
        $('input[name="type"]').on('click', function() {
            calTotal();
        });
        $('input[name="syrup"]').on('click', function() {
            calTotal();
        });
    });

    /*  ------------------------------------------------------------------------- */
    let counter = 1;
    const updateCounter = () => $("#quantity").val(counter);

    $("#increment").click(() => {
        counter++;
        updateCounter();
        calTotal();
    });

    $("#decrement").click(() => {
        if (counter > 1) {
            counter--;
            updateCounter();
            calTotal();
        }
    });

    /*  ------------------------------------------------------------------------- */

    async function showMenu(val) {
        var element = document.getElementById("category2");
        element.classList.remove("active");
        await hideAllMenu();
        document.getElementById(val).style.display = 'flex';

    }

    async function hideAllMenu() {
        // console.log('Hiding all menus...');
        for (let i = 1; i < 8; i++) {
            document.getElementById(`show_menu_${i}`).style.display = 'none';
        }
    }

    function callMenus() {
        $.ajax({
            url: "{{ route('getMenus') }}",
            type: "GET",
            // dataType: "json",
            success: function(data) {
                // console.log(data);
                console.log("successfully");
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }

    function showProduct(id, name, price) {
        idProduct = id;
        nameProduct = name;
        priceProduct = price;
        $('#menuLabel').text(name);
        // $('#totalPrice').text(price);
        calTotal();
        $('#menu-detail').modal('show');
    }

    function getSize() {

        let radioSize = document.getElementsByName("size");
        let size = "";
        let sizeValue;
        radioSize.forEach(function(radio) {
            if (radio.checked) {
                sizeValue = JSON.parse(radio.value);
                // size = sizeValue.name;
            }
        });

        return sizeValue;
    }

    function getType() {
        let radioType = document.getElementsByName("type");
        let type = "";
        let typeValue;

        radioType.forEach(function(radio) {
            if (radio.checked) {
                typeValue = JSON.parse(radio.value);
                // type = typeValue.name;
                // typeValue
            }
        });

        return typeValue;
    }

    function getSyrup() {
        let radioSyrup = document.getElementsByName("syrup");
        let syrup = "";
        let syrupValue;

        radioSyrup.forEach(function(radio) {
            if (radio.checked) {
                syrupValue = JSON.parse(radio.value);
                // syrup = syrupValue.name;
            }
        });

        return syrupValue;
    }

    function calTotal() {

        var calsize = getSize();
        var caltype = getType();
        var calsyrup = getSyrup();

        var calquantity = parseInt($("#quantity").val());

        var calprice = priceProduct;

        var total = (calprice + parseInt(calsize.val) + parseInt(caltype.val) + parseInt(calsyrup.val)) * calquantity;
        $("#totalPrice").text(total);

        return total;
    }

    let cart = [];

    function addCart() {

        var size = getSize();
        var type = getType();
        var syrup = getSyrup();

        let product = {
            productid: idProduct,
            nameProduct: nameProduct,
            size: size.name,
            type: type.name,
            syrup: syrup.name,
            price: priceProduct,
            quantity: parseInt($("#quantity").val()),
            totalPrice: calTotal()
        };
        // สั่งสินค้าลงในตะกร้า
        cart.push(product);
        showCart();
        $('#menu-detail').modal('hide');
    }
</script>
