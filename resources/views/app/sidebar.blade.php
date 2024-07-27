<style>
    .sidebar-link-hover:hover {
        background-color: #e9fff9;
        color: #24615a;
        border-right: 3px solid #2b7f75;
    }

    .sidebar-item a.active {
        background-color: #e9fff9;
        color: #24615a;
        border-right: 3px solid #2b7f75;
    }

    th.gridjs-th {
        border-right: 1px solid #d1d1d1;
    }

    a {
        text-decoration: none;
    }

    .sidebar {
        /* border-right: 1px solid #dee2e6; */
    }

    .active {
        background-color: #d6f1ea;
        color: #24615a;
        border-right: 3px solid #2b7f75;
    }
</style>

<aside id="sidebar" class="js-sidebar">
    <!-- Content For Sidebar -->
    <div class="h-100">
        <div class="sidebar-logo">

            <a href="/">
                <img class="pe-2" src="{{ asset('imges/property.png') }}" alt="" style="width: 40px;">
                สินทรัพย์ (Asset)
            </a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                สินทรัพย์
            </li>
            <li class="sidebar-item">
                <a href="/asset"
                    class="sidebar-link sidebar-link-hover @if (session('routeIs') === 'assets') active @endif">
                    <i class="fa-solid fa-box pe-2"></i>
                    ASSET
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/project-all"
                    class="sidebar-link sidebar-link-hover @if (session('routeIs') === 'project') active @endif">
                    <i class="fa-solid fa-diagram-project pe-2"></i>
                    โครงการ
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#"
                    class="sidebar-link sidebar-link-hover @if (session('routeIs') === 'po') active @endif">
                    <i class="fa-solid fa-cart-shopping pe-2"></i>
                    PO
                </a>
            </li>
            <li class="sidebar-header">
                สมาชิก
            </li>
            <li class="sidebar-item">
                <a href="/logout" class="sidebar-link sidebar-link-hover" style="font-size: 0.875rem;"><i <i
                        class="fa-solid fa-right-from-bracket pe-2"></i>ออกจากระบบ</a>
            </li>
        </ul>
    </div>
</aside>
<script>
    //
</script>
