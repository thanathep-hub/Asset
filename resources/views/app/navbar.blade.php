<style>
    .navbar-bg {
        /* background-color: #d6dce8; */
    }

    .PsNameFS {
        font-size: 15px;
        font-weight: 500;
        color: #4f4f4f;
    }

    #sidebar-toggle {
        /* background-color: #f6f6f6; */
    }

    #sidebar-toggle:hover {
        background-color: #d6f1ea;
    }

    #sidebar-toggle:active {
        border: none;
    }
</style>
<nav class="navbar navbar-expand px-3 navbar-bg">
    <button class="btn" id="sidebar-toggle" type="button">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
        </span>
    </button>
    <div class="navbar-collapse navbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0 PsNameFS"
                    style="text-decoration: none;">
                    <b>{{ session('user')->PsNameFS }}</b>
                </a>
            </li>
        </ul>
    </div>
</nav>
