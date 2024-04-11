<style>
    div.scrollmenu {
        overflow: auto;
        white-space: nowrap;
        scrollbar-width: none;
    }

    div.scrollmenu a {
        display: inline-block;
        text-align: center;
        padding: 8px 12px;
        text-decoration: none;
    }

    div.scrollmenu a:hover {
        /* background-color: #058f5e; */
        border-color: #058f5e;
    }

    .bg-menu {
        /* background-color: #04764e; */
        border-radius: 14px;
        /* color: #fff; */
        color: #fff;
        /* box-shadow: 0px 3px 3px 0px #04764e21; */
    }

    .bg-menu:hover {
        background-color: #000;
        color: white;
    }

    .bg-menu:focus {
        background-color: #000;
        color: white;
    }

    .active {
        background-color: #000;
        color: white;
    }

    .bg-menu:active,
    .bg-menu:target {
        background-color: #000;
        /* Background color when active (clicked) or targeted */
        color: white;
        /* Text color when active (clicked) or targeted */
    }

    .container-fluid {
        padding-left: unset;
        padding-right: unset;
        background-color: #fff;
    }

    .bg-cus {
        background-color: #08514c;
        overflow-x: scroll;
    }
</style>

<nav class="navbar" style="top: 0px;
position: sticky;background-color: #08514c;">
    <div class="container-fluid" style="border-bottom:1px solid #0000001a;background-color:#08514c;color: #fff;">
        <div class="header" style="margin-bottom: 0.25rem;">
            <h2 style="font-weight: 900;" style="color: #000;">ตะวันยิ้ม - สกลฯ</h2>
            <div class="cart">
                <a href=""></a>
            </div>
        </div>
    </div>
    <div class="card bg-cus" style="font-weight: 900; border: unset;padding-top:5px;scrollbar-width: none;">
        <div class="scrollmenu">
            <a href="#เมนูแนะนำ" class="bg-menu" onclick="showMenu('show_menu_1')" id="category1">เมนูแนะนำ</a>
            <a href="#หมวดกาแฟ" class="bg-menu active" onclick="showMenu('show_menu_2')" id="category2">หมวดกาแฟ</a>
            <a href="#หมวดชา" class="bg-menu" onclick="showMenu('show_menu_3')" id="category3">หมวดชา</a>
            <a href="#นม/โกโก้" class="bg-menu" onclick="showMenu('show_menu_4')" id="category4">นม/โกโก้</a>
            <a href="#สมูทตี้" class="bg-menu" onclick="showMenu('show_menu_5')" id="category5">สมูทตี้</a>
            <a href="#ผลไม้ปั่น" class="bg-menu" onclick="showMenu('show_menu_6')" id="category6">ผลไม้ปั่น</a>
            <a href="#อิตาเลี่ยนโซดา" class="bg-menu" onclick="showMenu('show_menu_7')"
                id="category7">อิตาเลี่ยนโซดา</a>
        </div>

    </div>
</nav>
