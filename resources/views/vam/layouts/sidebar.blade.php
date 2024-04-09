<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('imges/asset.png') }}" alt="Asset Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text"><strong>Center</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 pl-2 mb-3 d-flex" style="align-items: center;">
            <div class="image">
                <svg xmlns="http://www.w3.org/2000/svg" height="25" width="20"
                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="#c2c7d0"
                        d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z" />
                </svg>
            </div>
            <div class="info">
                <a href="/" class="d-block"><strong>{{ session('username') }}</strong></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-2xs" style="color: #c2c7d0;">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#c2c7d0"
                                    d="M218.3 8.5c12.3-11.3 31.2-11.3 43.4 0l208 192c6.7 6.2 10.3 14.8 10.3 23.5H336c-19.1 0-36.3 8.4-48 21.7V208c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h64V416H112c-26.5 0-48-21.5-48-48V256H32c-13.2 0-25-8.1-29.8-20.3s-1.6-26.2 8.1-35.2l208-192zM352 304V448H544V304H352zm-48-16c0-17.7 14.3-32 32-32H560c17.7 0 32 14.3 32 32V448h32c8.8 0 16 7.2 16 16c0 26.5-21.5 48-48 48H544 352 304c-26.5 0-48-21.5-48-48c0-8.8 7.2-16 16-16h32V288z" />
                            </svg></i>
                        <p>
                            Asset
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="/vam" class="nav-link">
                        <i class="nav-icon fas fa-car fa-2xs" style="color: #c2c7d0;"></i>
                        <p>
                            VAM
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/vam/car_maintenance/list" class="nav-link">
                        <i class="nav-icon fas fa-hammer fa-2xs" style="color: #c2c7d0;"></i>
                        <p>
                            รายการซ่อมบำรุง
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-2xs" style="color: #c2c7d0;">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#c2c7d0"
                                    d="M218.3 8.5c12.3-11.3 31.2-11.3 43.4 0l208 192c6.7 6.2 10.3 14.8 10.3 23.5H336c-19.1 0-36.3 8.4-48 21.7V208c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h64V416H112c-26.5 0-48-21.5-48-48V256H32c-13.2 0-25-8.1-29.8-20.3s-1.6-26.2 8.1-35.2l208-192zM352 304V448H544V304H352zm-48-16c0-17.7 14.3-32 32-32H560c17.7 0 32 14.3 32 32V448h32c8.8 0 16 7.2 16 16c0 26.5-21.5 48-48 48H544 352 304c-26.5 0-48-21.5-48-48c0-8.8 7.2-16 16-16h32V288z" />
                            </svg></i>
                        <p>
                            ASSET
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <p>สินทรัพย์ทั้งหมด</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/asset_act" class="nav-link">
                                {{-- <i class="fa fa-square-check"></i> --}}
                                <p>สินทรัพย์ทียืนยันแล้ว</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <p>
                                    ประเภทสินทรัพย์
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/asset/type/2" class="nav-link ">

                                        <p>อาคาร</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/3" class="nav-link">

                                        <p>อุปกรณ์สำนักงาน</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/5" class="nav-link">

                                        <p>ยานพาหนะ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/9" class="nav-link">

                                        <p>โกดัง โรงเรือน ลานตากเมล็ด</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/10" class="nav-link">

                                        <p>บ้านพักพนักงาน บ้านพักรับรอง</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/11" class="nav-link">

                                        <p>อุปกรณ์โรงงาน</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/12" class="nav-link">

                                        <p>ระบบไฟฟ้า - ระบบน้ำ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/13" class="nav-link">

                                        <p>เครื่องจักรกล</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/14" class="nav-link">

                                        <p>ทรัพย์สินเครื่องใช้ไฟฟ้า</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/15" class="nav-link">

                                        <p>ทรัพย์สินอุปกรณ์ทางการเกษตร</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/16" class="nav-link">

                                        <p>อุปกรณ์อื่นๆ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/17" class="nav-link">

                                        <p>ที่ดิน</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/27" class="nav-link">

                                        <p>อุปกรณ์ก่อสร้าง</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/28" class="nav-link">

                                        <p>อุปกรณ์คอมพิวเตอร์</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/29" class="nav-link">

                                        <p>โปรแกรมคอมพิวเตอร์</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/asset/type/30" class="nav-link">

                                        <p>สัตว์เลี้ยง</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item" style="border-top: 1px solid #4b545c;">
                    <a class="nav-link logout-swal">
                        <img src="{{ asset('imges/logout.png') }}" alt="Asset Logo" class="nav-icon far">
                        <p>
                            ออกจากระบบ
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
