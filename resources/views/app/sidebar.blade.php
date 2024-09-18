<style>
    /*  */
    .title-text {
        text-decoration: none;
    }

    .icon-logo {
        border-radius: 24px;
        box-shadow: 0 0 .875rem 0 #222e3c0d;
    }

    .sidebar-header {
        color: #64748b;
    }

    a.sidebar-link {
        text-decoration: none;
        color: #64748b;
        font-weight: 500;
    }

    a.sidebar-link:hover {
        border-radius: 12px;
        background-color: #dbeafe;
        color: #2563eb;
    }

    .sidebar-link-active {
        border-radius: 12px;
        background-color: #dbeafe;
        color: #2563eb !important;
        font-weight: 700 !important;
    }
</style>

<aside id="sidebar" class="js-sidebar">
    <!-- Content For Sidebar -->
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="/" class="title-text">
                <img class="icon-logo" src="{{ asset('icons/asset-logo.png') }}" alt="" style="height:80px;">
                {{-- สินทรัพย์ (Asset) --}}
            </a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                สินทรัพย์
            </li>
            <li class="sidebar-item p-1">
                <a href="/asset" class="sidebar-link {{ request()->is('asset') ? 'sidebar-link-active' : '' }}">
                    <i class="fa-solid fa-box fa-xl pe-2" style="max-width: 32px;"></i>
                    ASSET
                </a>
            </li>
            <li class="sidebar-header">
                โครงการ
            </li>
            <li class="sidebar-item p-1">
                <a href="/project-list"
                    class="sidebar-link  {{ request()->is('project-list') ? 'sidebar-link-active' : '' }}">
                    <i class="fa-solid fa-file-powerpoint fa-xl pe-2" style="max-width: 32px;"></i>
                    โครงการ
                </a>
            </li>
            <li class="sidebar-item p-1">
                <a href="/project-all"
                    class="sidebar-link   {{ request()->is('project-all') ? 'sidebar-link-active' : '' }}">
                    <i class="fa-solid fa-clipboard-check fa-xl pe-2" style="max-width: 32px;"></i>
                    อนุมัติโครงการ
                </a>
            </li>
            <li class="sidebar-header">
                การจัดซื้อ
            </li>
            <li class="sidebar-item p-1">
                <a href="#" class="sidebar-link   {{ request()->is('po') ? 'sidebar-link-active' : '' }}">
                    <i class="fa-solid fa-briefcase fa-xl pe-2" style="max-width: 32px;"></i>
                    PO
                </a>
            </li>
            <div class="border-bottom mt-3 mx-2"></div>
            <li class="sidebar-header">
                สมาชิก
            </li>
            <li class="sidebar-item p-2">
                <a href="/logout" class="sidebar-link " style="font-size: 0.875rem;">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-xl pe-2"></i>
                    ออกจากระบบ</a>
            </li>
        </ul>
    </div>
</aside>
<script>
    //
</script>
